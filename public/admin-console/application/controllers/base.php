<?php defined('SYSPATH') or die('No direct script access.');
class Base_Controller extends Controller {	

// the fields are to be overriden in descendants
	public $fields = array();
	public $objectName = '';
	public $title = '';
	
	protected $db;
	
	public function renderView(){
		$view = new View('admin');
		$view->header  = new View('header');
		$view->content = new View( $this->objectName );
		$view->footer  = new View('footer');
		$view->header->title     = $this->title;
		$view->render(TRUE);		
	}
	
	public function colModel(){
		$colModel = array();
		foreach($this->tableCols as $column){
			$col = "{label:'".$this->fields[$column]['title']."', name:'$column', align:'left'";
			//if (isset($this->fields[$column]['index'])) $col .= ", index:'".$this->fields[$column]['index']."'";
			if (isset($this->fields[$column]['width'])) $col .= ", width:'".$this->fields[$column]['width']."'";
			if (isset($this->fields[$column]['align'])) $col .= ", align:'".$this->fields[$column]['align']."'";

			if (isset($this->fields[$column]['stype'])) $col .= ", stype:'".$this->fields[$column]['stype']."'";
			if (isset($this->fields[$column]['options'])) $col .= ", editoptions: { value:".$this->getJSList( $this->fields[$column]['options'] )."}";
			
			$col .= "}\n";
			$colModel[] = $col;
		}
		return '['.join(',', $colModel).']';
	}
	
	public function index(){
		$this->msg = (isset($_GET['msg'])) ? $_GET['msg'] : false;
		$this->renderView();
	}
	
	public function getQuery(){
		$db = new Database();
		return $db->select('id,'.join(',', $this->tableCols))->from($this->objectName);	
	}
	
	public function getWhere(){
		return array();
	}
	
	public function view(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		
		$query = $this->getQuery();
		$where = $this->getWhere();
		
		if (isset($_GET['_search']) && $_GET['_search']=='true'){
			$fields = array_intersect(array_keys($this->fields), array_keys($_GET));
			foreach ($fields as $field){
				$index = (isset($this->fields[$field]['index'])) ? $this->fields[$field]['index'] : $field;
				$type = (isset($this->fields[$field]['type'])) ? $this->fields[$field]['type'] : 'text';
				switch ($type){
					case 'select':
						if ($_GET[$field] != 0){
							$where[] = $index . ' = "' . $_GET[$field] . '"';
						}
					break;
					case 'date':
						$where[] = 'FROM_UNIXTIME( '.$index.', "%m-%d-%Y" ) LIKE "' . $_GET[$field] . '%"';
					break;
					default:
						$where[] = $index . ' LIKE "' . $_GET[$field] . '%"';
				}
			}
		}
		
		if (count($where)) {
			$query->where( join(' AND ', $where) );
		}
		
		//$rows = $query->limit($limit)->offset(($page-1)*$limit)->orderby(array($sidx => $sord))->find_all();
		$rows = $query->limit($limit)->offset(($page-1)*$limit)->orderby(array($sidx => $sord))->get();
		
//die($query->last_query());

		$count = $query->count_last_query();
		$responce->page = $page;
		$responce->total = ( $count >0 )  ? ceil($count/$limit) : 1;
		$responce->records = $count;
		
		$i = 0; 
		foreach ($rows as $row) { 
			$responce->rows[$i]['id']=$row->id; 
			$ceil = array();
			foreach ($this->tableCols as $field){
			
				if (isset($this->fields[$field]['date'])) 
					$row->$field = date("m-d-Y", ($row->$field));
				if (isset($this->fields[$field]['price'])) 
					$row->$field = number_format($row->$field, 2);	

				$ceil[] = $row->$field;
			}
			$responce->rows[$i]['cell'] = $ceil;
			$i++; 
		}
		echo json_encode($responce); 		
	}

	public function getForm(){
		$out = '<form name="'.$this->objectName.'" id="'.$this->objectName.'" style="display:none;">
			<table border="0" width="100%">'."\n";
		$js = false;
		foreach ($this->fields as $name => $element){
			switch ($element['type']){
				case 'text': 
					$html = '<input type="text" name="'.$name.'" id="'.$name.'">';
					break;
				case 'textarea':
					$html = '<textarea name="'.$name.'" id="'.$name.'"></textarea>';
					break;
				case 'select':
					$selection = $this->getList($element['options']);
					$html = form::dropdown($element['index'], $selection);
					break;
				case 'enum':
					$options = array();
					foreach ($element['enum']['options'] as $key => $value) {
						if (FALSE == is_int($key))
							$options[$key] = $value;
						else
							$options[ $value ] = ucfirst($value);
					}
					$default = FALSE;
					if (isset($element['enum']['default']))
						$default = $element['enum']['default'];
					
					$html = form::dropdown($name, $options, $default);
					break;
				case 'wysiwyg':
					$html = '<textarea class="ckeditor" cols="80" id="'.$name.'" name="'.$name.'" rows="10"></textarea>';
					$html .= "
					<script> 
						$(function(){ 
							var oFCKeditor = new FCKeditor( '$name' ) ;
							oFCKeditor.Width = '100%' ;
							oFCKeditor.Height = '400' ; 
							oFCKeditor.BasePath	= '".url::base()."media/js/fckeditor/' ;
							oFCKeditor.ReplaceTextarea() ;
							fckEditors.push('$name');
						}); 
					</script>\n";
					break;
				case 'date':
					$html = '<input type="text" name="'.$name.'" id="'.$name.'">';
					$js .= "$('#$name').datepicker({dateFormat: 'yy-mm-dd'});\n";
					break;
				default:
					$html = false;
			}
			$required = (isset($element['required']) && $element['required']===true) ? '*' : '';
			$desc = (isset($element['description'])) ? '<br/><small>'.$element['description'].'</small>' : '';
			if ($html) $out .= "<tr><td>".$element['title']."$required $desc</td><td width=\"70%\">$html</td></tr>\n";
		}
		$out .= "</table>
		<input type=\"hidden\" name=\"id\" value=\"\" id=\"id\">
		<button onClick=\"submitForm(); return false;\">Save</button>
		<button onClick=\"toggleForm(); return false;\">Cancel</button>
		</form>\n";
		if ($js) $out .= "\n<script>\n$js\n</script>\n";
		return $out;
	}
	
	public function save(){
		$tableName = inflector::singular($this->objectName);
		$row = (isset($_POST['id']) && $_POST['id']!='') ? ORM::factory($tableName, (int)$_POST['id']) : ORM::factory($tableName);
		$errors = array();
		foreach ($this->fields as $name => $element){
			$error = false;
			if(isset($element['index'])) $name = $element['index'];			
			// check if the field is required
			if (isset($element['required']) && $element['required']===true && (!isset($_POST[$name]) || $_POST[$name]=='')){
				$error = $element['title'].' required';
			}

			// check by mask
			if (!$error && $_POST[$name]!='' && isset($element['mask']) && !preg_match ( '/' . $element['mask'] . '/', $_POST[$name] )){
				$error = $element['title'].' has wrong format';
			}
			
			if (!$error){
				$row->$name = $_POST[$name];
			}else{
				$errors[] = $error;
			}
		}
		if (count($errors)>0){
			echo(join(', ', $errors));
		}else{
			try{
			// call custom method to let descandent classes do something when saving
				$this->customBeforeSave($row);
				$row->save();
				$this->customAfterSave($row);
			}catch (Exception $e){
				die($e->getMessage());
			}
			echo 'OK';
		}
	}
	
	public function edit(){
		if (!isset($_GET['id'])){
			throw new Exception('Id required');
		}
		$tableName = inflector::singular($this->objectName);
		$row = ORM::factory($tableName, (int)$_GET['id']);
		header('Content-type: application/json');
		echo json_encode($row->as_array());
	}
	
	public function delete(){
		if (!isset($_GET['id'])){
			throw new Exception('Id required');
		}
		$tableName = inflector::singular($this->objectName);
		$row = ORM::factory($tableName, (int)$_GET['id']);
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($row);		
		$row->delete();
		$this->customAfterDelete($row);
		
		url::redirect('/'.$this->objectName);
	}
	
	public function customBeforeSave(&$row){
	
	}

	public function customAfterSave(&$row){
	
	}
	
	public function customBeforeDelete($row){
	
	}	

	public function customAfterDelete($row){
	
	}	
	
	protected function getList($table, $index = 'id', $value = 'name'){
		if (is_array($table)){
			list($table, $index, $value) = $table;
		}
		$db = new Database();
		$query = $db->select($index.' AS id', $value.' AS value')->from($table)->orderby('id');
		$out = array();
		$rows = $query->get();
		foreach ($rows as $row){
			$out[ $row->id ]  = $row->value;
		}
		return $out;
	}
	
	protected function getJSList($table, $index = 'id', $value = 'name', $where = false){
		if (is_array($table)){
			list($table, $index, $value) = $table;
		}
		$db = new Database();
		$query = $db->select($index.' AS id', $value.' AS value')->from($table);
		if ($where) $query->where($where);
		$out = array("0:'All'");
		$rows = $query->get();
		foreach ($rows as $row){
			$out[] = $row->id.":'".$row->value."'";
		}
		return '{'.join(',', $out).'}';
	}
}
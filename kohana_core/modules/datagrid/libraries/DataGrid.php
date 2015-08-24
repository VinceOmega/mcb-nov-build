<?php defined('SYSPATH') or die('No direct script access.');

class DataGrid  {

	public $table; 
	public $filter;
	public $num_per_page = 100;
	public $fields;
	public $db;
	public $actions;
	public $where;
	public $order_by;
	public $like;
	
	
	public function __construct($table, $fields){
		$this->fields = $fields;
		$this->table = $table;
		$this->where = array();
		$this->like = array();
		
		
		$this->db = new Database();
		$this->input = new Input();

	}
	
	public function convertDatatime($date){
		list($year, $month, $day) = explode('-', $date);
		return mktime(0, 0, 0, $month, $day, $year);
	}
	
	public function setAction($action_name, $action_callback_func){
		$this->actions[$action_name] = $action_callback_func;
	}
	
	public function where($key, $value){
		$this->where[$key] = $value;
	}
	
	public function order_by($key, $value){
		$this->order_by[$key] = $value;

	}

	public function render($page_no, &$_rows = false){

		//action managment
		if ($this->input->post('action') && ($this->input->post('chk'))){	 //if an action was submitted and there were checkboxes selected
			foreach ($this->input->post('chk') as $id){	
				$action_ids[] = $id;
			}
			foreach ($this->input->post('action') as $action){
				if (array_key_exists($action, $this->actions)){
					 $call_back = $this->actions[$action];
					 $f = $call_back($action_ids);
				}				
			}
		}
	
						
		
		
		//sort managment - sanatize here
		$this->order_by = array();
		if ($this->input->get('order')){
			list($key, $value) = explode(':', $this->input->get('order'));
			$this->order_by[$key] = $value;
			
		}
		if(empty($this->order_by))
			$this->order_by['id'] = 'asc'; //by default


			
			
		
		//filter managemnt
		$filter = ($this->input->post('filter')) ? $this->input->post('filter') : '';

		if (is_array($filter))
			foreach($filter as $key => $f)
				if (!is_array($filter[$key]))
					$filter[$key] = trim(rtrim($filter[$key]));
		//$_SESSION['dataGrid']['filter'] = $filter;	//this is wrong (should be changed)
			
		if ($this->input->post('btnClearFilter')){
			$filter = array();
			//$_SESSION['dataGrid']['filter'] = '';
		}
	

		//$filter = array('id'=> 2, 'status'=>'yes', 'date_added'=>array('before'=>'2010-04-10', 'after'=>'2009-05-10'));
		//$filter = array('last_name'=> 'Smith', 'status'=>'1');
		$ext_table = '';
		$yes = false;
		if (!empty($filter)){			
			foreach($filter as $key => $value) {	
				if (($value) != '') {
					if(!array_key_exists('external', $this->fields[$key])){	//maybe use http://php.net/manual/en/function.key.php instead	
					
						$data_type = $this->fields[$key]['filter']['input']; //text, drop, date
								
						if ($data_type == 'text'){
							$this->like[$key] = $filter[$key]; //like $value;
						}elseif ($data_type == 'drop') {
							$this->where[$key] = $filter[$key]; //where $value;
						}elseif ($data_type == 'date'){
							if (!empty($filter[$key]['before'])){
								$this->where[$key.' >='] = $this->convertDatatime($filter[$key]['before']);
							}
							if(!empty($filter[$key]['after'])) {
								$this->where[$key.' <='] = $this->convertDatatime($filter[$key]['after']);
							}
						} else { //this shouldn't happen anytime
							$this->where[$key] = $filter[$key]; //$value
						}
					}else{
						//clean this up						
						$ext_table = ORM::factory(inflector::singular($key), $value); //->with($key)->where($key.'.'.$this->fields[$key]['external'], $value);
						$yes = true;	
					}
				}
			}
		}	

//var_dump($this->where); die();		

		
		//$field_names = array_keys($this->fields);
		$ex_field_names = array();
		foreach($this->fields as $key=>$value){
			if(!array_key_exists('external', $value))
				$field_names[] = $key;
			else
				$ex_field_names[$key] = $value['external'];
		}
			
		
		
		$offset = ($page_no - 1) * $this->num_per_page;	
			
		if ($_rows){
			$data = $_rows
						->where('1=1')
						->where($this->where) //filters
						->like($this->like)
						->orderby($this->order_by)
						->limit($this->num_per_page, $offset);
		}else{
			if($yes){ 						//if an external table is involved in the filtering
				$data = $ext_table
							->where('1=1')
							->where($this->where) //filters
							->like($this->like)
							->orderby($this->order_by)
							->limit($this->num_per_page, $offset)
							->find_related(inflector::plural($this->table));//->find_related('products');
							
			}else{ 							//otherwise do it normally
				$data = ORM::factory($this->table)
						->select($field_names)
						->where('1=1')
						->where($this->where) //filters
						->like($this->like)
						->orderby($this->order_by)
						->limit($this->num_per_page, $offset);
			}
		}	
	
		$found_data = $data->find_all()->as_array('id');	
	//	print_r($found_data);  //same as compile		

			
		
		//Pagination configuration
		$total = $data->count_last_query();
		$pagination = new Pagination(array(
			'uri_segment' => 'page',
			'total_items'=> $total,
			'style' => "Extended",
			'items_per_page' => $this->num_per_page,
			'auto_hide' => false
		));
		


		
		
		$transformed_data = array();
		foreach ($found_data as $key=>$row){
			foreach($field_names as $field){
				if (array_key_exists('callback', $this->fields[$field])) {
					if (array_key_exists('on_value', $this->fields[$field]['callback'])) {
						$callback_func = $this->fields[$field]['callback']['on_value'];
						$transformed_data[$key][$field] = $callback_func($row->$field);	
					}	
				}else{
					$transformed_data[$key][$field] = $row->$field;	
				}
			}				
		}

		
		//get external data	
		foreach($found_data as $key=>$value){
			$data = ORM::factory($this->table, $value->id);
			
			foreach($ex_field_names as $ex_table=>$field){
				$relate = $data->find_related($ex_table)->select($field)->find_all()->as_array();
				
				$m = '';
				foreach($relate as $r){
					$m .= $r->{$field} .' ';
				}
				
				$transformed_data[$key][$ex_table] = $m;	
				
			}
		}
		
		$field_names = array_keys($this->fields);
		
		foreach ($this->fields as $key => $value){
			foreach ($value as $a => $b){

				if ($a == 'filter'){
					
					$filters['type'][$key] = $b['input'];
					
					if ($b['input'] == 'drop') {
						$filters['data'][$key] = $b['values'];
					}
					
					if (array_key_exists('size', $b))
						$filter_size[$key] = $b['size'];

				}
				$filters = isset($filters) ? $filters : array();
				$filter_size = isset($filter_size) ? $filter_size : array();
				
				
				if ($a == 'format'){
					if (array_key_exists('align', $b))
						$align[$key] = $b['align'];
				}
				$align = isset($align) ? $align : array();			
			}	
		}
	
		$table_filter = '';
		foreach($field_names as $index => $column){ 
			//if ($column == 'id')                           //this is so the ID column does not show
			//	continue;
			$table_filter .= '<th>';
				$default_value = '';
				$default_value_b ='';
				$default_value_a ='';
				$sel = '';
				
				if (is_array($filter)){
					if (array_key_exists($column, $filter)){
						$default_value =  $filter[$column];
					
						if (is_array($filter[$column])){
							if (array_key_exists('before', $filter[$column])){
								$default_value_b = $filter[$column]['before'];
							}
							if (array_key_exists('after', $filter[$column])){
								$default_value_a = $filter[$column]['after'];
							}
						}
					}
				}
				
				if(array_key_exists('filter', $this->fields[$column])){
				
					if ($filters['type'][$column] == 'text')
						$table_filter .= '<input type="text" name="filter['. $column. ']" size="'. $filter_size[$column]. '" value="'. $default_value .'"  />';

					else if ($filters['type'][$column] == 'drop'){						
						$table_filter .=  '<select name="filter['.$column.']"><option value=""> </option>';						
						foreach ($filters['data'][$column] as $key=>$value){
							$sel = '';
								if ($default_value ==(string)$key)
									$sel = 'selected=selected';
							$table_filter .=  '<option value="'.$key .'" '.$sel.'> ' .$value. '</option>';		
						}
						$table_filter .=  '</select>';
					}
					
					else if ($filters['type'][$column] == 'date') {
						$table_filter .=  '<input type="text" name="filter['. $column. '][before]" class="date" size="10" value="'. $default_value_b .'" /><br/>';
						$table_filter .=  '<input type="text" name="filter['. $column. '][after]" class="date" size="10" value="'. $default_value_a .'" />';
					}
				}
			
			$table_filter .=  '</th>';	
		}
	
		 $table_headings = '';
		 foreach ($field_names as $index => $column){
			//if ($column == 'id')                           //this is so the ID column does not show
			//	continue;
			if(!array_key_exists('external', $this->fields[$column])){
				$table_headings .= '<th><a href="' ;
				$table_headings .= url::base() . url::current(); 
				$table_headings .= '/?order=';
				$table_headings .= $column;
				$table_headings .= ':';
				
				if(array_key_exists($column, $this->order_by)){
					$table_headings .= ($this->order_by[$column] == 'asc') ? 'desc' : 'asc';
				}else{
					$table_headings .= 'asc';
				}
				
				//$table_headings .= ($this->order_by[$column] == 'asc') ? 'desc' : 'asc';
				$table_headings .= '" >';
				$table_headings .= tableColumnNames($column); 
				$table_headings .= ($this->order_by == $column) ? (($this->order == 'asc') ? '<sup>^</sup>' : '<sup> v</sup>') : ''; 					
				$table_headings .='</a></th>';
			}else{
				$table_headings .= '<th>' ;
				$table_headings .= tableColumnNames($column) .'\' '. tableColumnNames($this->fields[$column]['external']); 
				//$table_headings .= tableColumnNames($this->fields[$column]['external']); 
				$table_headings .='</th>';
			}
		}
				
		$this->view = new View('admin');
		
		$this->view->header  = new View('header');
		$this->view->content = new View('grid_table_content');	
		$this->view->footer  = new View('footer');
	
		$this->view->header->title = 'All ';  
		
		$this->view->content->table_headings = $table_headings;
		$this->view->content->align = $align;
		$this->view->content->fields = $field_names;
		$this->view->content->table_filter = $table_filter;
		$this->view->content->result = $transformed_data;				
		$this->view->content->pagination = $pagination;
		$this->view->content->actions = $this->actions;
		
		$this->view->footer->copyright = 'Copyright';  
		$this->view->render(true);	
	}

}

function tableColumnNames($column_name){
	//replace underscores, dashes, apostrophes from the column names with an empty space
	$column_name = preg_replace('/[-_\']/', ' ', $column_name);
	$column_name = ucwords(strtolower($column_name));
	return $column_name;
}

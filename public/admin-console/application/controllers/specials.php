<?php defined('SYSPATH') or die('No direct script access.');
class Specials_Controller extends Controller {

	public $path = '/env/specials/';
	public $msg = array();
	public $config;
	
	private function uploadBanner($name, $path){
		if($_FILES[$name]['name']!=''){
			if (move_uploaded_file($_FILES[$name]['tmp_name'], $path.$_FILES[$name]['name'])){
				$this->msg[] = $_FILES[$name]['name'].' successufully uploaded';
				$this->config["specials.$name"] = $_FILES[$name]['name'];
			}else{
				$this->msg[] = 'Error uploading file '.$_FILES[$name]['name'];
			}
		}
	}
	
	public function index(){
		$this->config = Kohana::config('specials');
//die(APPPATH.'../..'.$this->path);
		if (isset($_POST['submit'])){
			$this->uploadBanner('banner1', APPPATH.'../../..'.$this->path);
			$this->uploadBanner('banner2', APPPATH.'../../..'.$this->path);

			$this->config['description'] = addslashes($_POST['description']);
			
			$path = SYSPATH.'../modules/cart/config/specials.php';
			$f = fopen($path, 'w+');
			fputs($f, "<?php\n");
			foreach ($this->config as $index => $value){
				fputs($f, "\$config['$index'] = '$value';\n");
			}
			fclose($f);

			url::redirect('/specials');
		}

		$view = new View('admin');
		$view->header  = new View('header');
		$view->content = new View('specials');
		$view->footer  = new View('footer');
		$view->header->title     = 'Specials';
		$view->render(TRUE);
	}
}
?>
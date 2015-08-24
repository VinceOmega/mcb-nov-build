<?php
class Session extends Session_Core{

	public function getContent($object){
		$bin = get_class($object);		
		$content = $this->get($bin);
		$data = unserialize($content);
		
		if (!isset($data) || !is_array($data)) {
      		$data = array();
    	}
		
		return $data;
	}
	
	public function saveContent($object){
		$bin = get_class($object);
		$content = serialize($object->session);
		$this->set($bin, $content);
	}
}
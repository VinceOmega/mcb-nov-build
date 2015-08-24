<?php
class ORM extends ORM_Core{

	//betters than kohana's many<>many's automatic find_all, cause it doesn't return an iterator, ie: lets you do count_all, filter, etc.
	public function find_related($key){

		$model = ORM::factory(inflector::singular($key)); // Load the "end" model
			
		if(in_array($key, $this->has_one)){ // one<>many relationship
			return $model
				->where($model->primary_key, $this->object[$this->foreign_key($model->object_name)]);		
		
		}else{ // many<>many relationship
	
			$through = ORM::factory(inflector::singular($this->has_many[$key])); // Load the "middle" model

			// Join ON target model's primary key set to 'through' model's foreign key
			// User-defined foreign keys must be defined in the 'through' model
			$join_table = $through->table_name;
			$join_col1  = $through->foreign_key($model->object_name, $join_table);
			$join_col2  = $model->table_name.'.'.$model->primary_key;

			return $model
				->join($join_table, $join_col1, $join_col2)
				->where($through->foreign_key($this->object_name, $join_table), $this->object[$this->primary_key]);
		}
	
	}
	
	public function cloneThis() {
		$clone = ORM::factory($this->object_name);
		$values = $this->as_array();
		foreach ($values as $key => $value) {
			if ($key == 'id') continue;
			$clone->{$key} = $value;
		}
		return $clone;
	}
}
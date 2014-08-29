<?php

/*
 * Field class
 * @author Jake Josol
 * @description Class for creating fields
 */

class Field
{
	protected $model;
	protected $name;
		
	public function __construct($model, $name)
	{
		$this->model = $model;
		$this->name = $name;
	}
	
	public function Increment($value=true)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "increment", $value);
		
		return $this;
	}
	
	public function Type($fieldType)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "type", $fieldType);
		
		return $this;
	}
	
	public function Label($label)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "label", $label);
		
		return $this;
	}
	
	public function Input($input)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "input", $input);
		
		return $this;
	}
	
	public function Lookup($list)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "lookup", $list);
		
		return $this;
	}
	
	public function Relation($model, $key)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "relation", $model . "Model");
		$modelName::SetOption($this->field, "key", $key);
		
		return $this;
	}

	public function Pointer($model, $key)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "pointer", $model . "Model");
		$modelName::SetOption($this->field, "key", $key);
		
		return $this;
	}
	
	public function Translate($model, $key)
	{
		$modelName = $this->model;
		$modelName::SetOption($this->field, "translate", $model . "Model");
		$modelName::SetOption($this->field, "key", $key);
		
		return $this;
	}
}

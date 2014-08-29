<?php

/*
 * Field class
 * @author Jake Josol
 * @description Class for creating fields
 */

class Field
{
	protected $name;
	protected $type;
	protected $label;
		
	public function __construct($fieldName)
	{
		$this->name = $fieldName;
	}
	
	public function Type($fieldType)
	{
		$this->type = $fieldType;
		
		return $this;
	}
	
	public function Label($label)
	{
		$this->label = $label;
		
		return $this;
	}
}
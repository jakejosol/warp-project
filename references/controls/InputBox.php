<?php

/*
 * Button control
 * @author Jake Josol
 * @description Button
 */

use Warp\Control;

class InputBox extends Control
{
	const INPUT_PREFIX = "input-";
	protected $type = "input";
	protected $classes = array("warp-input", "form-control");
	protected $properties = array("type" => "text");
	protected static $name = "Input";
	protected static $INPUT_SIZE = array(
		"LARGE" => "lg",
		"SMALL" => "sm",
		"EXTRA_SMALL" => "xs"
	);
	
	public function SetName($name)
	{
		$this->SetProperty("name", $name);
		return $this;
	}
	
	public function SetValue($value)
	{
		$this->SetProperty("value", $value);
		return $this;
	}
	
	public function SetPlaceholder($placeholder)
	{
		$this->SetProperty("placeholder", $placeholder);
		return $this;
	}
	
	public function SetInputType($type)
	{
		$this->SetProperty("type", $type);
		return $this;
	}
	
	public function SetInputSize($size)
	{
		foreach(static::$INPUT_SIZE as $inputSize => $value) 
			$this->RemoveClass(self::INPUT_PREFIX.static::$INPUT_SIZE[$inputSize]);
		$this->AddClass(self::INPUT_PREFIX.static::$INPUT_SIZE[$size]);
		return $this;
	}
}
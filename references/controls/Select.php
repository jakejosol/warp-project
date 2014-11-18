<?php

/*
 * Select control
 * @author Jake Josol
 * @description Select
 */

use Warp\UI\Control;

class Select extends Control
{
	protected $type = "select";
	protected $isParent = true;
	protected static $name = "Select";
	
	public function AddOption($content)
	{
		$option = Option::Create("");
		$option->SetText($content);
		$this->children[] = $option;
		
		return $this;
	}
	
	public function SetName($name)
	{
		$this->SetProperty("name", $name);
		return $this;
	}
}

?>
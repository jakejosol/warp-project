<?php

/*
 * Form control
 * @author Jake Josol
 * @description Formm
 */
 
class Form extends Control
{
	protected $type = "form";
	protected $isParent = true;
	protected static $name = "Form";
		
	public function SetFormType($type)
	{
		$this->AddClass("form-{$type}");
	}
	
	public function SetMethod($method)
	{
		$this->SetProperty("method", $method);
		
		return $this;
	}
	
	public function SetAction($action)
	{
		$this->SetProperty("action", $action);
		
		return $this;
	}	
}

?>
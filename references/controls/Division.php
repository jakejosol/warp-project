<?php

/*
 * Division control
 * @author Jake Josol
 * @description Division
 */
 
class Division extends Control
{
	protected $type = "div";
	protected $isParent = true;
	protected static $name = "Division";
	
	public function SetText($content)
	{
		$controlText = new Text($content);
		$this->children = array($controlText);
		
		return $this;
	}
}

?>
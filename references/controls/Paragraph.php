<?php

/*
 * Paragraph control
 * @author Jake Josol
 * @description Paragraph
 */
 
use Warp\UI\Control;

class Paragraph extends Control
{
	protected $type = "p";
	protected $isParent = true;
	protected static $name = "Paragraph";
	
	public function SetText($content)
	{
		$controlText = new Text($content);
		$this->children = array($controlText);
		
		return $this;
	}
}

?>
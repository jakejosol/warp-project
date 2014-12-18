<?php

/*
 * Small Text control
 * @author Jake Josol
 * @description Small Text
 */
 
use Warp\UI\Control;

class SmallText extends Control
{
	protected $type = "small";
	protected $isParent = true;
	protected static $name = "SmallText";
	
	public function SetText($content)
	{
		$controlText = new Text($content);
		$this->children = array($controlText);
		
		return $this;
	}
}

?>
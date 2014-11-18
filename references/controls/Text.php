<?php

/*
 * Text control
 * @author Jake Josol
 * @description Text
 */

use Warp\UI\Control;

class Text extends Control
{
	protected $content;
	protected static $name = "Text";
	
	public function __construct($content="")
	{
		$this->SetContent($content);
	}
	
	public function SetContent($content)
	{
		$this->content = $content;
	}
	
	public function Render()
	{
		return $this->content;
	}

}
 
?>
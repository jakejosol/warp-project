<?php

/*
 * HeaderText control
 * @author Jake Josol
 * @description HeaderText
 */

use Warp\UI\Control;

class HeaderText extends Control
{
	protected $type = "h";
	protected $isParent = true;
	protected static $name = "HeaderText";

	public function SetLevel($level)
	{
		$this->type = $this->type . $level;

		return $this;
	}
	
	public function SetText($content)
	{
		$controlText = new Text($content);
		$this->children = array($controlText);
		
		return $this;
	}
}

?>
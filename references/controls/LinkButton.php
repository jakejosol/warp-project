<?php

/*
 * Button control
 * @author Jake Josol
 * @description Button
 */
 
class LinkButton extends Button
{
	protected $type = "a";
	protected static $name = "LinkButton";
	
	public function SetLink($link)
	{
		$this->SetProperty("href", $link);
		return $this;
	}
}

?>
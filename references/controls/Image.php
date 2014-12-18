<?php

/*
 * Image control
 * @author Jake Josol
 * @description Image
 */
 
class Image extends Control
{
	protected $type = "img";
	protected static $name = "Image";

	public function SetSource($source)
	{
		$this->SetProperty("src", $source);
		
		return $this;
	}
}

?>
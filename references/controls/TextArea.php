<?php

/*
 * TextArea control
 * @author Jake Josol
 * @description TextArea
 */

class TextArea extends Division
{
	protected $type = "textarea";
	protected $isParent = true;
	protected static $name = "TextArea";
		
	public function SetName($name)
	{
		$this->SetProperty("name", $name);
		return $this;
	}
	
	public function SetPlaceholder($name)
	{
		$this->SetProperty("placeholder", $name);
		return $this;
	}
}

?>
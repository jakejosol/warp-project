<?php

/*
 * Label control
 * @author Jake Josol
 * @description Label
 */
 
class Label extends Division
{
	const FOR_PROPERTY = "for";
	protected $type = "label";
	protected static $name = "Label";
	
	public function SetFor($for)
	{
		$this->SetProperty(self::FOR_PROPERTY, $for);
		
		return $this;
	}
}

?>
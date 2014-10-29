<?php

/*
 * Source control
 * @author Jake Josol
 * @description Source
 */

use Warp\Control;
 
class Source extends Control
{
	protected $type = "source";
	protected $isParent = true;
	protected static $name = "Source";
	
	public function __construct($source, $type=null)
	{
		$this->AddProperty("src", $source);
		if($type) $this->AddProperty("type", $type);
		
		return $this;
	}
}

?>
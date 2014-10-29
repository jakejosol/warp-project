<?php

/*
 * Audio control
 * @author Jake Josol
 * @description Audio
 */

use Warp\Control;

class Audio extends Control
{
	protected $type = "video";
	protected $isParent = true;
	protected static $name = "Video";
	
	public function AddSource($source, $type=null)
	{
		$sourceElement = new Source($source, $type);
		$this->children[] = $sourceElement;
		
		return $this;
	}
}

?>
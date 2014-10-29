<?php

/*
 * Meta control
 * @author Jake Josol
 * @description Meta
 */

class Meta extends Division
{
	protected $type = "meta";
	protected static $name = "Meta";

	public function SetName($name)
	{
		$this->SetProperty("name", $name);
		return $this;
	}

	public function SetContent($content)
	{
		$this->SetProperty("content", $content);
		return $this;
	}
}

?>
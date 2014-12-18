<?php

/*
 * Link control
 * @author Jake Josol
 * @description Link
 */
 
class Link extends Division
{
	protected $type = "a";
	protected static $name = "Link";
	
	public function SetLink($link, $external=false)
	{
		if(!$external) $link = Resource::Local($link);
		$this->SetProperty("href", $link);
		return $this;
	}
}

?>
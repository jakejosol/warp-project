<?php

/*
 * Layout class
 * @author Jake Josol
 * @description Base class for all layout
 */
 
class Layout extends Page
{
	protected $page;
	
	public function SetPage($page)
	{
		$this->page = $page;
		
		return $this;
	}
	
	public function GetPage()
	{
		return $this->page;
	}

	public function Render()
	{
		$data = $this->data;
		$data->Page = $this->page;
		include self::VIEW_FILE_DIRECTORY . "{$this->file}";
	}
}

?>
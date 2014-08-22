<?php

/*
 * Page class
 * @author Jake Josol
 * @description Base class for all pages
 */
 
class Page extends Fragment
{
	protected $fragment;
	
	public function SetFragment($fragment)
	{
		$this->fragment = $fragment;
		
		return $this;
	}
	
	public function GetFragment()
	{
		return $this->fragment;
	}

	public function Render()
	{
		$data = $this->data;
		$data->Fragment = $this->fragment;
		include self::VIEW_FILE_DIRECTORY . $this->file;
	}
}

?>
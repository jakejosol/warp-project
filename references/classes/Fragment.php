<?php

/*
 * Fragment class
 * @author Jake Josol
 * @description Base class for all fragments
 */
 
class Fragment implements IElement
{
	const VIEW_FILE_DIRECTORY = "application/design/";
	protected $file;
	protected $data;
		
	public function SetFile($file)
	{
		$this->file = $file;	
		
		return $this;
	}
	
	public function SetData($data)
	{
		$this->data = $data;
		
		return $this;
	}
		
	public function Initialize($id, $parameters=array())
	{
		$this->path = $parameters["path"];
		$this->file = $parameters["file"];
		$this->data = $parameters["data"];
	}
	
	public function Render()
	{
		$data = $this->data;
		include self::VIEW_FILE_DIRECTORY . $this->file;
	}
}

?>
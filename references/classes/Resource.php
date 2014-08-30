<?php

/*
 * Resource class
 * @author Jake Josol
 * @description Responsible for the application resources
 */

class Resource
{
	private static $resources = array();
	
	private static function setResource($name, $resource)
	{
		static::$resources[$name] = $resource;
	}

	public static function Local($resource)
	{
		$path = Application::GetInstance()->GetPath();
		if($path) $path = "/".$path."/";
		else $path = "";

		return $path.$resource;
	}
	
	public static function ImportStyle($name, $external=false)
	{
		$path = static::Local("resources/styles/{$name}");
		if($external) $path = "/resources/styles/{$name}";
		static::setResource($name, "<link rel='stylesheet' href='{$path}'>");
	}
	
	public static function ImportScript($name, $external=false)
	{
		$path = static::Local("resources/scripts/{$name}");		
		if($external) $path = "/resources/styles/{$name}";
		static::setResource($name,"<script src='{$path}'></script>");
	}
	
	public static function Render()
	{
		$list = func_get_args();
		$resources = array();

		if($list)
		{
			foreach($list as $name) 
				$resources[] = static::$resources($name);

			return implode("", $resources);
		}
		else return implode("", static::$resources);
	}
}

?>
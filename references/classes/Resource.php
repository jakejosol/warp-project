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
	
	public static function ImportStyle($name)
	{
		$path = Application::GetInstance()->GetPath();
		if($path) $path = "/".$path;
		static::setResource($name, "<link rel='stylesheet' href='{$path}/resources/styles/{$name}'>");
	}
	
	public static function ImportScript($name)
	{
		$path = Application::GetInstance()->GetPath();
		if($path) $path = "/".$path;
		static::setResource($name,"<script src='{$path}/resources/scripts/{$name}'></script>");
	}
	
	public static function Render($name)
	{
		if($name) return static::$resources[$name];
		else return implode("", static::$resources);
	}
}

?>
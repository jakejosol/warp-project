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
		static::setResource($name, "<link rel='stylesheet' href='/resources/styles/{$name}'>");
	}
	
	public static function ImportScript($name)
	{
		static::setResource($name,"<script src='/resources/scripts/{$name}'></script>");
	}
	
	public static function Render($name)
	{
		if($name) return static::$resources[$name];
		else return implode("", static::$resources);
	}
}

?>
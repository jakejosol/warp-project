<?php

/*
 * Reference Manager
 * @author Jake Josol
 * @description Determines the references used by the app
 */
 
/****************************************
CLASSES - Utility classes
****************************************/
Reference::Autoload();

/****************************************
VENDORS - Third party libraries
****************************************/
//Reference::ImportVendor("vendor_folder/autoloader.php");
									
/****************************************
CLASS DEFINITION
****************************************/
class Reference
{
	const CLASS_DIRECTORY = getcwd()."/references/classes/";
	const MODEL_DIRECTORY = getcwd()."/application/build/models/";
	const CONTROLLER_DIRECTORY = getcwd()."/application/build/controllers/";
	const VIEW_DIRECTORY = getcwd()."/application/build/views/";
	const ENUMERATION_DIRECTORY = getcwd()."/references/enumerations/";
	const CONTROL_DIRECTORY = getcwd()."/references/controls/";
	const INTERFACE_DIRECTORY = getcwd()."/references/interfaces/";
	const VENDOR_DIRECTORY = getcwd()."/references/vendors/";
	const ERROR_REFERENCE = "Sorry, the reference does not exist.";
	
	private static function Import($name)
	{
		require_once $name;
	}
	
	public static function ImportClass($name)
	{
		static::Import(self::CLASS_DIRECTORY."{$name}.php");
	}
	
	public static function ImportModel($name)
	{
		static::Import(self::MODEL_DIRECTORY."{$name}.php");
	}
	
	public static function ImportController($name)
	{
		static::Import(self::CONTROLLER_DIRECTORY."{$name}.php");
	}
	
	public static function ImportView($name)
	{
		static::Import(self::VIEW_DIRECTORY."{$name}.php");
	}
		
	public static function ImportEnumeration($name)
	{
		static::Import(self::ENUMERATION_DIRECTORY."{$name}.php");
	}
	
	public static function ImportControl($name)
	{
		static::Import(self::CONTROL_DIRECTORY."{$name}.php");
	}
	
	public static function ImportInterface($name)
	{
		static::Import(self::INTERFACE_DIRECTORY."{$name}.php");
	}
	
	public static function ImportReference($name)
	{
		$classExists = file_exists(self::CLASS_DIRECTORY."{$name}.php");
		$modelExists = file_exists(self::MODEL_DIRECTORY."{$name}.php");
		$controllerExists = file_exists(self::CONTROLLER_DIRECTORY."{$name}.php");
		$viewExists = file_exists(self::VIEW_DIRECTORY."{$name}.php");
		$enumerationExists = file_exists(self::ENUMERATION_DIRECTORY."{$name}.php");
		$controlExists = file_exists(self::CONTROL_DIRECTORY."{$name}.php");
		$interfaceExists = file_exists(self::INTERFACE_DIRECTORY."{$name}.php");
		
		if($classExists) static::ImportClass($name);
		else if($modelExists) static::ImportModel($name);
		else if($controllerExists) static::ImportController($name);
		else if($viewExists) static::ImportView($name);
		else if($enumerationExists) static::ImportEnumeration($name);
		else if($controlExists) static::ImportControl($name);
		else if($interfaceExists) static::ImportInterface($name);
		else Debugger::WriteError(self::ERROR_REFERENCE . " ({$name})");
	}
	
	public static function ImportVendor($name)
	{
		static::Import(self::VENDOR_DIRECTORY.$name);
	}
	
	public static function ImportAutoloader($name)
	{
		spl_autoload_register($name);
	}
	
	public static function Autoload()
	{
		static::ImportAutoloader("Reference::ImportReference");
	}
}  
 
?>
<?php

/*
 * Application class
 * @author Jake Josol
 * @description Class that is responsible for the entire application
 */
 
class Application
{
	protected static $instance;
	protected $title;
	protected $subtitle;
	protected $description;
	protected $keywords;
	protected $debugMode;
	const REFERENCE_MANAGER = "references/ReferenceManager.php";
	const RESOURCE_MANAGER = "resources/ResourceManager.php";
	
	public static function GetInstance()
	{
		return static::$instance;
	}
	
	public static function Initialize()
	{
		require_once self::REFERENCE_MANAGER;
		require_once self::RESOURCE_MANAGER;
		
		static::$instance = new Application();		
		return static::$instance;
	}
	
	public function SetTitle($title)
	{
		$this->title = $title;
		return $this;
	}
	
	public function GetTitle()
	{
		return $this->title;
	}
	
	public function SetSubtitle($subtitle)
	{
		$this->subtitle = $subtitle;
		return $this;
	}
	
	public function GetSubtitle()
	{
		return $this->subtitle;
	}
	
	public function SetDescription($description)
	{
		$this->description = $description;
		return $this;
	}
	
	public function GetDescription()
	{	
		return $this->description;
	}
	
	public function SetKeywords($keywords)
	{
		$this->keywords = implode(",", $keywords);
		return $this;
	}
	
	public function GetKeywords()
	{
		return $this->keywords;
	}
	
	public function GetKeywordsList()
	{
		return explode(",", $this->keywords);
	}
	
	public function SetDebugMode($debugMode)
	{
		$this->debugMode = $debugMode;
		
		switch($this->debugMode)
		{
			case DebugMode::DEVELOPMENT:
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
			break;
			
			case DebugMode::PRODUCTION:
				error_reporting(E_ERROR);
			break;
		}
		
		return $this;
	}
	
	public function AddPage($name, $class)
	{
		Router::AddPath("/^\/{$name}(?=\/|\b)/", $class);
		return $this;
	}
	
	public function AddEngine($name, $title, $type, $file)
	{
		Engine::AddEngine($name, $title, $type, $file);
		return $this;
	}
	
	public function SetDefaultPage($class)
	{
		Router::SetDefaultPath($class);
		return $this;
	}
	
	public function SetDatabase($name)
	{
		Database::Set($name);
		return $this;
	}
	
	public function Start()
	{
		echo Router::Fetch();
	}
}

?>
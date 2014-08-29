<?php

/*
 * Router class
 * @author Jake Josol
 * @description File that routes all URL requests
 */

class Router
{
	private static $path;
	private static $patterns;
	private static $elementDelimiter = "/";
	private static $home;
	public static $ACTION_TYPE = array(
		"GET" => array(
			"view" => "View"
		),
		"POST" => array(
			"add" => "Add",
			"edit" => "Edit",
			"delete" => "Delete",
			"fetch" => "Fetch",
			"notify" => "Notify",
			"receive" => "Receive"
		)
	);
	
	public static function GetServer()
	{
		return $_SERVER['SERVER_NAME'];
	}
	
	public static function GetURL()
	{
		$URL = $_SERVER['REQUEST_URI'];
		if(static::$path) $URL = str_replace(static::$path."/", "", $_SERVER['REQUEST_URI']);
		
		return $URL;
	}
	
	public static function GetURLElements()
	{
		$URL = array(); 
		$requestURI = static::GetURL();
		
		$URL = explode(static::$elementDelimiter, $requestURI); 
		
		array_shift($URL);
		
		$lastItemIndex = count($URL) - 1;
		if($lastItemIndex >= 0 && $URL[$lastItemIndex] == "") unset($URL[$lastItemIndex]);
		
		return $URL;
	}
	
	public static function GetURLElementAt($index)
	{
		$urlElements = static::GetURLElements();
		return $urlElements[$index];
	}
	
	public static function GetVerb()
	{
		return $_SERVER['REQUEST_METHOD']; 
	}

	public static function GetAction()
	{
		$action = "";
		if(count(static::GetURLElements()) >= 3) $action = static::GetURLElementAt(2);
		
		return $action;
	}
	
	public static function SetPath($path)
	{
		static::$path = $path;
	}
	
	public static function GetPath()
	{
		return static::$path;
	}
	
	public static function AddVerb($verb)
	{
		if(static::$ACTION_TYPE[$verb]) return;
		static::$ACTION_TYPE[$verb] = array();
	}
	
	public static function AddAction($verb, $action)
	{
		static::AddVerb($verb);
		static::$ACTION_TYPE[$verb][] = $action;
	}
	
	public static function GetParameters()
	{
		$parameters = array();
		
		switch (static::GetVerb()) 
		{  
			case 'GET':    
				$parameters = $_GET;    
			break;  
			
			case 'POST':  
				$parameters = $_POST;
			break;  
						
			case 'PUT':  
				$parameters = fopen("php://input", "r");
			break;  
			
			case 'DELETE':  
			default:    
				$parameters = array(); 
			break;
		}
		
		return $parameters;
	}
	
	public static function AddPath($name, $class)
	{
		if(!static::$patterns) static::$patterns = new PatternList();
	
		static::$patterns->AddPattern($name, function() use ($class)
		{
			$name = $class."Controller";
			$page = new $name();
			return $page->IndexAction(Router::GetURL(), Router::GetParameters());
		});
	}
	
	public static function SetDefaultPath($class)
	{
		static::$patterns->SetDefault(function() use ($class)
		{
			$name = $class."Controller";
			$page = new $name();
			return $page->IndexAction(Router::GetURL(), Router::GetParameters());
		});
	}
	
	public static function SetHome($class)
	{
		static::$home = function() use ($class)
		{
			$name = $class."Controller";
			$page = new $name();
			return $page->IndexAction(Router::GetURL(), Router::GetParameters());
		};
	}
	
	public static function Fetch()
	{
		$homePage = static::$home;
		if(count(static::GetURLElements()) == 0) return $homePage();
		
		if(!static::$patterns) static::$patterns = new PatternList();
	
		static::$patterns
			->AddPattern("/^\/api\//", function()
			{
				$verb = Router::GetVerb();
				$action = Router::GetAction();
				
				$requestParams = array(
					"class" => Router::GetURLElementAt(1),
					"action" => Router::$ACTION_TYPE[$verb][$action],
					"parameters" => Router::GetParameters()					
				);
					
				return API::Request($requestParams);
			})
			->AddPattern("/^\/engines\//", function()
			{
				$verb = Router::GetVerb();
				if($verb != "POST") return;
				
				$engineName = Router::GetURLElementAt(1);
				$runParams = Router::GetParameters();
				
				$engine = Engine::Load($engineName);
					
				return ($engine) ? $engine->Run($runParams) : Engine::ShowError(404, "Unknown request");
			})
			->SetDefault(function()
			{
				$viewNotFound = new NotFoundView();
				return $viewNotFound->Render();
			});
		
		return static::$patterns->FindMatch(static::GetURL())->Execute();
	}
}
 
?>
<?php

/*
 * View class
 * @author Jake Josol
 * @description Base class for all views
 */

class View
{	
	const VIEW_FILE_DIRECTORY = "/application/design/";
	const DEFAULT_FILE = "default.php";
	protected static $layout;
	protected static $path;
	protected static $patterns;
		
	protected static function GetLayout()
	{
		return static::$layout;
	}
	
	protected static function GetPath()
	{
		return static::$path;
	}
	
	public static function AddPattern($pattern, $action)
	{
		if(static::$patterns == null) static::$patterns = new PatternList();
		static::$patterns->AddPattern($pattern, $action);
	}
	
	public function Render($url="")
	{
		if(static::$patterns == null) static::$patterns = new PatternList();
		
		$root = Router::GetURLElementAt(1);
		$layout = static::GetLayout();
		$path = static::GetPath();
		
		static::$patterns
			->AddPattern("/{$root}$/", function() use ($layout, $path) {
				$view = static::GetDefaultViewFile($layout, $path);	
				return $view;
			})
			->SetDefault(function(){
				$viewNotFound = new NotFoundView();
				return $viewNotFound->Render();
			});
			
		return static::$patterns->FindMatch($url)->Execute();
	}
	
	protected static function GetViewFile($layout, $path, $page, $fragment=null, $data=null)
	{			 	
		$viewFragment = new Fragment();
		$viewFragment->SetFile($path."/".$fragment)
					 ->SetData($data);
					 
		$viewPage = new Page();
		$viewPage->SetFile($path."/".$page)
				 ->SetData($data)
				 ->SetFragment($viewFragment);
		
		$viewLayout = new Layout();
		$viewLayout->SetFile($layout)
				   ->SetData($data)
				   ->SetPage($viewPage);
		
		if($layout) return $viewLayout->Render();
		else $viewPage->Render();
	}
	
	protected static function GetDefaultViewFile($layout, $path)
	{
		return static::GetViewFile($layout, $path, self::DEFAULT_FILE);
	}
}

?>
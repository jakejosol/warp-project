<?php

/*
 * Crud view
 * @author Jake Josol
 * @description Base class for Create, Read, Update and Delete views
 */

class CrudView extends View
{	 
	const CREATE_FILE = "_add.php";
	const READ_FILE = "_view.php";
	const UPDATE_FILE = "_edit.php";
	const DELETE_FILE = "_delete.php";
	const CREATE_PATH = "add";
	const READ_PATH = "view";
	const UPDATE_PATH = "edit";
	const DELETE_PATH = "delete";
	const PAGE_FILE = "default.php";
	const NUMBER_PATTERN = "[1-9][0-9]*";
	protected static $model;
		
	public function Render($url)
	{
		$root = Router::GetURLElementAt(0);
		$layout = static::GetLayout();
		$path = static::GetPath();
				
		$createPath = self::CREATE_PATH;
		$readPath = self::READ_PATH;
		$updatePath = self::UPDATE_PATH;
		$deletePath = self::DELETE_PATH;
		
		$numberPattern = self::NUMBER_PATTERN;
		
		static::AddPattern("/{$root}\/{$createPath}$/", function() use ($layout, $path)
		{
						
			$viewData = new ViewData();
			
			return static::GetViewFile($layout, $path, self::PAGE_FILE, self::CREATE_FILE, $viewData);
		});
		static::AddPattern("/{$root}\/{$readPath}\/{$numberPattern}$/", function() use ($layout, $path)
		{
			
			$key = Router::GetURLElementAt(3);
			
			$model = new static::$model();
			$model->SetKeyValue($key);
			$model->Fetch();			
		
			$viewData = new ViewData();
			$viewData->Model = $model;
						
			return static::GetViewFile($layout, $path, self::PAGE_FILE, self::READ_FILE, $viewData);
		});
		static::AddPattern("/{$root}\/{$updatePath}\/{$numberPattern}$/", function() use ($layout, $path)
		{
		 
			$key = Router::GetURLElementAt(3);
			
			$model = new static::$model();
			$model->SetKeyValue($key);
			$model->Fetch();
			
			$viewData = new ViewData();
			$viewData->Model = $model;
						
			return static::GetViewFile($layout, $path, self::PAGE_FILE, self::UPDATE_FILE, $viewData);
		});
		static::AddPattern("/{$root}\/{$deletePath}\/{$numberPattern}$/", function() use ($layout, $path)
		{
					 
			$key = Router::GetURLElementAt(3);
			
			$model = new static::$model();
			$model->SetKeyValue($key);
			$model->Fetch();
			
			$viewData = new ViewData();
			$viewData->Model = $model;
			
			return static::GetViewFile($layout, $path, self::PAGE_FILE, self::DELETE_FILE, $viewData);
		});
		
		return parent::Render($url);
	}
}

?>
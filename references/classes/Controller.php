<?php

/*
 * Controller class
 * @author Jake Josol
 * @description Base class for all controllers
 */
 
class Controller
{
	protected static $model = null;
	protected static $view = null;
	protected static $patterns;
	
	public static function GetModel()
	{
		$modelName = static::$model;
		if(!$modelName) $modelName = str_replace("Controller", "Model", get_called_class());
		return new $modelName();
	}
	
	public static function GetClass()
	{
		$modelName = static::$model;
		if(!$modelName) $modelName = str_replace("Controller", "Model", get_called_class());
		return $modelName;
	}
	
	public static function GetView()
	{
		$viewName = static::$view;
		if(!$viewName) $viewName = str_replace("Controller", "View", get_called_class());
		return new $viewName();
	}
	
	public function IndexAction($url, $parameters)
	{
		return static::GetView()->Render($url);
	}
	
	public function ViewAction($url, $parameters)
	{
		$controllerPath = Router::GetURLElementAt(1);
		if(!static::$patterns) static::$patterns = new PatternList();
		
		static::$patterns
			->AddPattern("/^\/api\/{$controllerPath}\/view$/", function()
			{
				$query = static::GetModel()->GetQuery();
				$query->OrderByDescending(static::GetModel()->GetKey());
				$results = $query->Find();
				
				$listRelations = array();
				foreach(static::GetModel()->GetFields() as $field => $details)
					if($details["type"] == FieldType::RELATION)
						$listRelations[] = $field;
			
																
				foreach($results as $key => $result)
					foreach($listRelations as $itemRelation)
					{
						$model = static::GetModel();
						$model->SetKeyValue($result[static::GetModel()->GetKey()]);
						
						$results[$key][$itemRelation] = $model->GetRelation($itemRelation)->Find();
					}	

				return json_encode($results);			
			})
			->AddPattern("/^\/api\/{$controllerPath}\/view\/\d/", function() use ($url)
			{
				$listUrl = explode("/", $url);
				$model = static::GetModel();
				$model->SetKeyValue($listUrl[2]);
				$model->Fetch();
				$result = array();
				
				foreach($model->GetValues() as $key => $value) $result[$key] = $value;
				return json_encode($result);				
			})
			->SetDefault(function()
			{			
				return null;
			});
		
		return static::$patterns->FindMatch($url)->Execute();
	}
	
	public function AddAction($url, $parameters)
	{
		$model = static::GetModel();
		foreach($parameters as $parameter => $value) $model->Set($parameter, $value);

		$model->Save();
		return json_encode(array("key" => $model->GetKeyValue()));
	}
	
	public function EditAction($url, $parameters)
	{
		$model = static::GetModel();
		foreach($parameters as $parameter => $value) $model->Set($parameter, $value);
		if(!$model->GetKeyValue()) return;
		
		$model->Save();
		return json_encode(array("key" => $model->GetKeyValue()));
	}
	
	public function DeletAction($url, $parameters)
	{
		$model = static::GetModel();
		$key = static::GetModel()->GetKey();
		if(!isset($parameters[$key])) return;
		$model->SetKeyValue($parameters[$key]);
		
		$model->Delete();
		return json_encode(array("key" => $model->GetKeyValue()));
	}	
}
 
?>
<?php

/*
 * Model class
 * @author Jake Josol
 * @description Base class for all models
 */

class Model
{
	protected static $source;
	protected static $key;
	protected static $fields = array();
	protected $values = array();
	protected $scopes = array();
	
	/**
	 * Class construct
	 * @params string key
	 */
	public function __construct($key=null)
	{
		static::initialize();
		foreach(static::$fields as $field => $value) $this->values[$field] = null;
		static::SetKeyValue($key);
	}
	
	/**
	 * Model initializer
	 */
	protected static function initialize() {}
	
	/**
	 * Getter
	 * @params string name
	 * @return string value
	 */
	public function __get($name)
	{
		if(!isset(static::$fields[$name])) return null;
		return $this->values[$name];		
	}
	
	public function GetFieldType($name)
	{
		return static::$fields[$name]["type"];
	}
	
	public function GetFieldInput($name)
	{
		$input = static::$fields[$name]["input"];
		if(!$input) $input = "text";
		
		return $input;
	}
	
	public function GetFieldLabel($name)
	{
		return static::$fields[$name]["label"];
	}
	
	/**
	 * Setter
	 * @params string name, string value
	 */
	public function __set($name,$value)
	{
		if(!isset(static::$fields[$name])) return;
		$this->Set($name, $value);
	}
	
	public function Set($name,$value)
	{
		switch(static::$fields[$name]["type"])
		{
			case FieldType::INTEGER:
				$value = (int) $value;
			break;
			
			case FieldType::FLOAT:
				$value = (float) $value;
			break;
			
			case FieldType::PASSWORD:
				$value = Security::EncryptPassword($value);
			break;
		}
		
		$this->values[$name] = $value;
	}
	
	public static function GetSource()
	{
		return static::$source;
	}
	
	public static function GetKey()
	{
		return static::$key;
	}
	
	public function GetKeyValue()
	{
		return $this->values[static::GetKey()];
	}
	
	public function SetKeyValue($value)
	{
		$this->Set(static::GetKey(), $value);
	}
	
	public function GetRelation($field)
	{
		$relation = static::$fields[$field]["relation"];
		$key = static::$fields[$field]["key"];
		$modelName = $relation . "Model";
		$query = $modelName::GetQuery();
		$query->WhereEqualTo($key, $this->values[static::GetKey()]);
		
		return $query;
	}
	
	public function GetFields()
	{
		return static::$fields;
	}
	
	public function GetValues()
	{
		return $this->values;
	}
	
	public static function GetQuery($scope=null)
	{		
		$query =  new Query(static::GetSource());
		foreach(static::$fields as $field => $details) 
			if($details["type"] != FieldType::RELATION)
				$query->IncludeField($field);

		if(is_array($scope))
		{
			foreach($scope as $scopeItem)
			{
				$scopeAction = static::$scopes[$scopeItem];
				$query = $scopeAction($query);
			}
		}
		else if ($scope)
		{
			$scopeAction = static::$scopes[$scope];
			$query = $scopeAction($query);
		}
		
		return $query;
	}
	
	public function Fetch()
	{
		$query = static::GetQuery();
		$query->WhereEqualTo(static::GetKey(), static::GetKeyValue());
		
		$result = $query->Find();
				
		foreach($result[0] as $key => $item) $this->values[$key] = $item;
		
		return $result;
	}
	
	public function Save()
	{
		$command = new CommandQuery(static::GetSource(), static::GetKey());
		
		foreach(static::$fields as $field => $details)
			if(!isset($details["increment"]) && $details["type"] != FieldType::RELATION)
				$command->BindParameter($field, $this->values[$field], $details["type"]);

		if(static::GetKeyValue() == null)
		{
			$command->SetType("ADD");
		}
		else
		{
			$command->SetType("EDIT");
			$command->WhereEqualTo(static::GetKey(), static::GetKeyValue());
		}
		
		$command->Execute();
		
		$query = new Query(static::GetSource());
		$query->OrderByDescending(static::GetKey());
		$results = $query->Find();
		
		$this->SetKeyValue($results[0]["objectID"]);
	}
	
	public function Delete()
	{
		$command = new CommandQuery(static::GetSource(), static::GetKey());
		$command->WhereEqualTo(static::GetKey(), static::GetKeyValue());
		$command->SetType("DELETE");
		$command->Execute();
	}


	public function SoftDelete()
	{
		// SoftDelete only works on tables with "deletedAt" column.
		$command = new CommandQuery(static::$GetSource(), static::GetKey());
		$command->WhereEqualTo(static::GetKey() ,static::GetKeyValue());
		$command->SetType("EDIT");
		$command->BindParameter("deletedAt", date("Y-m-d h:i:s"), null);
		$command->Execute();
	}
	
	public static function Has($field)
	{
		static::$fields[$field] = array();
		$fieldObject = new Field(get_called_class(), $field);
		return $fieldObject;
	}
	
	public static function HasMany($model, $key=null)
	{
		static::Has($field)
			->Relation($model, $key);
		return $fieldObject;
	}
	
	public static function BelongsTo($model, $key=null)
	{
		static::Has($field)
			->Pointer($model, $key);
		return $fieldObject;
	}
	
	public static function Translates($model, $key=null)
	{
		static::Has($field)
			->Translate($model, $key);
		return $fieldObject;
	}
	
	public static function SetOption($field, $option, $value)
	{
		static::$fields[$field][$option] = $value;
	}
	
	public static function Scope($name, $action)
	{
		static::$scopes[$name] = $action;
	}
}

?>
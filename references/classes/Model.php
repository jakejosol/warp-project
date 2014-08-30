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
	protected static $scopes = array();
	protected static $systemFields = true;
	protected $values = array();
	
	/**
	 * Class construct
	 * @param string key
	 */
	public function __construct($key=null)
	{
		static::build();
		if(static::$systemFields) static::addSystemFields();
		foreach(static::$fields as $field => $value) $this->values[$field] = null;
		static::SetKeyValue($key);
	}
	
	/**
	 * Model builder
	 */
	protected static function build() {}
	
	protected static function addSystemFields()
	{
		static::Has(SystemField::CREATED_AT)->DateTime()->Guarded();
		static::Has(SystemField::UPDATED_AT)->DateTime()->Guarded();
		static::Has(SystemField::DELETED_AT)->DateTime()->Guarded();
	}
	
	/**
	 * Getter
	 * @param string name
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

	public function GetFieldRequired($name)
	{
		return static::$fields[$name]["required"];
	}

	public function GetFieldGuarded($name)
	{
		return static::$fields[$name]["guarded"];
	}
	
	/**
	 * Setter
	 * @param string name, string value
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
	
	public function GetCreatedAt()
	{
		return $this->fields[SystemField::CREATED_AT];
	}
	
	public function GetUpdatedAt()
	{
		return $this->fields[SystemField::UPDATED_AT];
	}
	
	public function GetDeletedAt()
	{
		return $this->fields[SystemField::DELETED_AT];
	}
	
	public static function GetQuery()
	{		
		$query =  new Query(static::GetSource());
		foreach(static::$fields as $field => $details) 
			if($details["type"] != FieldType::RELATION)
				$query->IncludeField($field);

		$scopes = func_get_args();		
				
		foreach($scopes as $scope)
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
		
		$result = $query->First();
				
		if($result) foreach($result as $key => $item) $this->values[$key] = $item;
		
		return $result;
	}
	
	public function Save()
	{
		$command = new CommandQuery(static::GetSource(), static::GetKey());
		
		if(static::GetKeyValue() == null)
		{
			$command->SetType(CommandType::ADD);
			$this->values[SystemField::CREATED_AT] = date("Y-m-d H:i:s");
			$this->values[SystemField::UPDATED_AT] = date("Y-m-d H:i:s");
		}
		else
		{
			$command->SetType(CommandType::EDIT);
			$command->WhereEqualTo(static::GetKey(), static::GetKeyValue());
			$this->values[SystemField::UPDATED_AT] = date("Y-m-d H:i:s");
		}
		
		foreach(static::$fields as $field => $details)
		{
			switch($this->GetFieldType[$field])
			{
				case FieldType::POINTER:
					$command->BindParameter($field, $this->values[$field]->GetKeyValue(), $details["type"]);
				break;

				default:
					$command->BindParameter($field, $this->values[$field], $details["type"]);
				break;
			}
		}

		
		$commandReturn = $command->Execute();
		
		if(static::GetKeyValue() == null) $this->SetKeyValue($commandReturn->lastInsertID);
		return $commandReturn->rowsAffected;
	}
	
	public function Delete()
	{
		$command = new CommandQuery(static::GetSource(), static::GetKey());
		$command->WhereEqualTo(static::GetKey(), static::GetKeyValue());
		$command->SetType(CommandType::DELETE);
		$command->Execute();
	}

	public function SoftDelete()
	{
		// SoftDelete only works on tables with "deletedAt" column.
		$command = new CommandQuery(static::$GetSource(), static::GetKey());
		$command->WhereEqualTo(static::GetKey() ,static::GetKeyValue());
		$command->SetType(CommandType::EDIT);
		$command->BindParameter(SystemField::DELETED_AT, date("Y-m-d H:i:s"), null);
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
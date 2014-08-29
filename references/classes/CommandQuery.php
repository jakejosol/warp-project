<?php

/*
 * Command Query class
 * @author Jake Josol
 * @description Command query class for all models
 */
 
 class CommandQuery extends Query
 {
	protected $target;
	protected $key;
	protected $type;
	protected $bindings = array();
	protected static $COMMAND_TYPE = array(
		"ADD" => "INSERT INTO",
		"EDIT" => "UPDATE",
		"DELETE" => "DELETE FROM"
	);
	
	public function __construct($target, $key=null)
	{
		$this->target = $target;
		$this->key = $key;
	}
	
	public function BindParameter($field, $value, $type)
	{
		$this->bindings[$field] = array(
			"value" => $value,
			"type" => $type
		);
	}
	
	public function SetType($type)
	{
		$this->type = static::$COMMAND_TYPE[$type];
	}
	
	public function GetQueryObject()
	{
		$type = $this->type;
		$target = $this->target;
		
		$listParameters = array();
		$uniqueBinding = "BIND".substr(uniqid(),0, rand(7,10))."CMD";
		$counterParameters = 0;
		$bindings = "";
		
		$where = "";
		
		switch($type)
		{
			case static::$COMMAND_TYPE["ADD"]:
				$listBindingFields = array();
				$listBindingValues = array();
				foreach($this->bindings as $field => $details) 
				{
					$listBindingFields[] = $field;
					$listBindingValues[] = ":{$uniqueBinding}{$counterParameters}";
					$listParameters[":{$uniqueBinding}{$counterParameters}"] = array("value" => $details["value"]);
					$counterParameters++;
				}
				$bindings = "(" . implode(",", $listBindingFields) . ") VALUES (" . implode(",", $listBindingValues) . ")";
			break;
			
			case static::$COMMAND_TYPE["EDIT"]:
				$listBindings = array();
				foreach($this->bindings as $field => $details) 
				{
					$listBindings[] = "{$field} = :{$uniqueBinding}{$counterParameters}";					
					$listParameters[":{$uniqueBinding}{$counterParameters}"] = array("value" => $details["value"]);
					$counterParameters++;
				}
				$bindings = "SET " . implode(",", $listBindings);
			
			case static::$COMMAND_TYPE["DELETE"]:	
				$whereObject = $this->getWhereObject();
				$where = $whereObject->QueryString;
				foreach($whereObject->Parameters as $binding => $parameter) $listParameters[$binding] = $parameter;
			break;
		}
		
		$commandString = "{$type} {$target} {$bindings} {$where}";
		$queryObject = new QueryObject();
		$queryObject->QueryString = $commandString;
		$queryObject->Parameters = $listParameters;
		
		return $queryObject;
	}
	
	public function Execute()
	{
		$queryObject = $this->GetQueryObject();
		return Database::Execute($queryObject->QueryString, $queryObject->Parameters, true);
	}
 }
 
?>
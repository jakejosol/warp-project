<?php

/*
 * Database class
 * @author Jake Josol
 * @description Utility class for all database transactions
 */
 
class Database
{
	private static $currentDatabase;
	
	/**
	 * Set Database Configurations
	 */
	private static $configurations = array();
	
	/**
	 * Set the Database to be used
	 */
	public static function Set($name)
	{
		static::$currentDatabase = $name;
	}
	
	public static function AddConfiguration($key, $configuration)
	{		
		static::$configurations[$key] = $configuration;
	}
	
	/**
	 * Connect to the Database
	 */
	private static function connect()
	{
		try 
		{			
			$configuration = static::$configurations[static::$currentDatabase];
			if(static::$currentDatabase == null) $configuration = static::$configurations[0];
			if(!$configuration) throw new Exception("Sorry, could not find the database configuration.");
			
			$db = null;
			
			switch($configuration->GetVendor())
			{								
				case DatabaseVendor::MYSQL:
				$db = new PDO("mysql:host={$configuration->GetServer()};dbname=".$configuration->GetDatabase(),
						$configuration->GetUsername(),
						$configuration->GetPassword());
				break;
				
				case DatabaseVendor::SQL_SERVER:
				default:
				$db = new PDO("sqlsrv:server={$configuration->GetServer()};database=".$configuration->GetDatabase(),
						$configuration->GetUsername()."@".$configuration->GetServer(),
						$configuration->GetPassword());
				break;			
			}
			
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (PDOException $e)
		{
			echo Debugger::WriteError("Sorry, could not connect to the database. Please try again. " . $e->getMessage());
		}
	
		return $db;
	}
	
	/**
	 * Create and execute query for a single row
	 * @output Array Row
	 */
	public static function Fetch($statement, $parameters = array(), $fetchMode = PDO::FETCH_BOTH)
	{
		$db = self::connect($fetchMode);
		
		try
		{
			$query = $db->prepare($statement);
			
			if($query)
			{
				foreach($parameters as $key => $parameter)
				{
					if(!isset($parameter["type"]))
					{
						$parameter["type"] = PDO::PARAM_STR;
					}
	
					$query->bindParam($key,$parameter["value"],$parameter["type"]);
				}
				
				$query->execute();
			}
			else
			{
				echo Debugger::WriteError("Sorry, there was a problem with the query statement.");
			}
		}
		catch (PDOException $e)
		{
			echo Debugger::WriteError("Sorry, there was a problem with the query. ({$e->getMessage()})");
		}
		
		return $query->fetch($fetchMode);
	}
	
	/**
	 * Create and execute query for multiple rows
	 * @output Array Table
	 */
	public static function FetchAll($statement, $parameters = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$db = self::connect($fetchMode);

		try
		{
			$query = $db->prepare($statement);
			
			if($query)
			{
				foreach($parameters as $key => $parameter)
				{
					if(!isset($parameter["type"]))
					{
						$parameter["type"] = PDO::PARAM_STR;
					}
					
					$query->bindParam($key,$parameter["value"],$parameter["type"]);
				}
				
				$query->execute();
			}
			else
			{
				echo Debugger::WriteError("Sorry, there was a problem with the query statement.");
			}
		}
		catch (PDOException $e)
		{
			echo Debugger::WriteError("Sorry, there was a problem with the query. ({$e->getMessage()}, $statement)");
		}
		
		return $query->fetchAll($fetchMode);
	}
	
	/**
	 * Execute a Create, Insert, Update or Delete Query
	 * @output String Rows affected
	 */
	public static function Execute($statement, $parameters = array(), $return=false)
	{
		$db = self::connect();
		$rowsAffected = 0;
		$lastID = 0;
		
		try
		{
			$query = $db->prepare($statement);
			
			foreach($parameters as $key => $parameter)
			{
				if(!isset($parameter["type"]))
				{
					$parameter["type"] = PDO::PARAM_STR;
				}
				
				$query->bindParam($key,$parameter["value"],$parameter["type"]);
			}
			
			$db->beginTransaction();
			$query->execute();
			$rowsAffected += $query->rowCount();
			$lastID = $db->lastInsertId();
			$db->commit();
		}
		catch (PDOException $e)
		{
			echo Debugger::WriteError("Sorry, there was a problem with query execution. ({$e->getMessage()}) $statement");
		}
		
		$returnObject = (object) array(
			DatabaseReturn::ROWS_AFFECTED => $rowsAffected,
			DatabaseReturn::LAST_INSERT_ID => $lastID
		);
		
		if($return) return $returnObject;
		else return $rowsAffected;
	}
	
	/** 
	 * Execute multiple queries
	 * @output String Rows affected
	 */
	public static function ExecuteAll($executeQueries)
	{
		$db = self::connect();
	
		$db->beginTransaction();
		$rowsAffected = 0;
		
		try
		{
			foreach($executeQueries as $executeQuery)
			{
				$query = $db->prepare($executeQuery["statement"]);
			
				foreach($executeQuery["parameters"] as $key => $parameter)
				{
					if(!isset($parameter["type"]))
					{
						$parameter["type"] = PDO::PARAM_STR;
					}
						
					$query->bindParam($key,$parameter["value"],$parameter["type"]);
				}
					
				$query->execute();
				$rowsAffected += $query->rowCount();	
			}
		}
		catch (PDOException $e)
		{
				$db->rollBack();
				echo Debugger::WriteError("Sorry, there was a problem with query execution. ({$e->getMessage()})");
		}
		
		$db->commit();
		return $rowsAffected;
	}
}

?>
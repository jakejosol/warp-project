<?php

/*
 * Configuration class
 * @author Jake Josol
 * @description Base class that is used to bulk-set configurations
 */
 
class Configuration
{
	public function SetDebugMode($debugMode)
	{
		Application::GetInstance()->SetDebugMode($debugMode);
	}
	
	public function SetTimezone($timezone)
	{
		Application::GetInstance()->SetTimezone($timezone);
	}

	public function AddDatabase($name, $databaseConfig)
	{
		Database::AddConfiguration($name, $databaseConfig);
	}

	public function SetDatabase($database)
	{
		Application::GetInstance()->SetDatabase($database);
	}
}

?>
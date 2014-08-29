<?php

/*
 * Configuration class
 * @author Jake Josol
 * @description Base class that is used to bulk-set configurations
 */
 
class Configuration
{
	public function Prepare()
	{
		$this->SetTimezone("UTC");
	}

	public function SetPath($path)
	{
		Application::GetInstance()->SetPath($path);
	}

	public function SetTimezone($timezone)
	{
		Application::GetInstance()->SetTimezone($timezone);
	}

	public function AddDatabase($databaseConfig)
	{
		Database::AddConfiguration($databaseConfig);
	}	
}

?>
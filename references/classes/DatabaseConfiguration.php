<?php

class DatabaseConfiguration
{
	private $vendor;
	private $server;
	private $username;
	private $password;
	private $database;
	
	public function __construct($vendor, $server, $username, $password, $database)
	{
		$this->vendor = $vendor;
		$this->server = $server;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
	}

	public function GetVendor()
	{
		return $this->vendor;
	}
	
	public function GetServer()
	{
		return $this->server;
	}
	
	public function GetUsername()
	{
		return $this->username;
	}
	
	public function GetPassword()
	{
		return $this->password;
	}
	
	public function GetDatabase()
	{
		return $this->database;
	}
}

?>
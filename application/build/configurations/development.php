<?php

/*
 * Development Configuration
 * @author Jake Josol
 * @description Development Configuration
 */
 
use Warp\Data\DatabaseConfiguration;
use Warp\Utils\Enumerations\DebugMode;
use Warp\Utils\Enumerations\DatabaseVendor;

class DevelopmentConfiguration extends Configuration
{
	public function Apply()
	{
		$this->SetPath("warp");
		$this->SetTimezone("UTC");
		$this->SetDebugMode(DebugMode::Development);
		$this->AddDatabase("main", new DatabaseConfiguration(DatabaseVendor::MYSQL, "127.0.0.1", "root", "", "warp"));
		$this->SetDatabase("main");
	}
}
<?php

/*
 * Production Configuration
 * @author Jake Josol
 * @description Production Configuration
 */
 
use Warp\Data\DatabaseConfiguration;
use Warp\Utils\Enumerations\DebugMode;
use Warp\Utils\Enumerations\DatabaseVendor;

class ProductionConfiguration extends Configuration
{
	public function Apply()
	{
		$this->SetTimezone("UTC");
		$this->SetDebugMode(DebugMode::Production);
		$this->AddDatabase("main", new DatabaseConfiguration(DatabaseVendor::MYSQL, "127.0.0.1", "root", "", "warp"));
		$this->SetDatabase("main");
	}
}
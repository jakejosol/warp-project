<?php

/*
 * Development Configuration
 * @author Jake Josol
 * @description Development Configuration
 */
 
class DevConfig extends Configuration implements IConfiguration
{
	public function Apply()
	{
		$this->SetTimezone("UTC");
		$this->SetDebugMode(DebugMode::DEVELOPMENT);
		$this->AddDatabase("main", new DatabaseConfiguration(DatabaseVendor::MYSQL, "127.0.0.1", "root", "", "mcsrxdev"));
		$this->SetDatabase("main");
	}
}

?>
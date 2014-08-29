<?php

/*
 * Production Configuration
 * @author Jake Josol
 * @description Production Configuration
 */
 
class ProdConfiguration extends Configuration
{
	public function Apply()
	{
		$this->SetTimezone("UTC");
		$this->SetDebugMode(DebugMode::PRODUCTION);
		$this->AddDatabase("main", new DatabaseConfiguration(
											DatabaseVendor::MYSQL,
											"127.0.0.1",
											"root",
											"",
											"mcsrx"));
		$this->SetDatabase("main");
	}
}

?>
<?php

/*
 * Base migration
 * @author Jake Josol
 * @description Base migration
 */

use Warp\Utils\Interfaces\IMigration;

class base_migration implements IMigration
{
	public function Up()
	{
		Schema::Table("_user")
			->ID()
			->String("secretKey", 100)
			->String("username")
			->Password()
			->String("firstName", 50)
			->String("lastName", 50)
			->String("email")
			->SessionToken()
			->Timestamps()
			->Create();

		Schema::Table("_engine")
			->ID()
			->Integer("userID")
			->String("uniqueID")
			->Integer("processInstance")
			->String("title")
			->String("type")
			->String("status")
			->Timestamps()
			->Create();
	}

	public function Down()
	{
		Schema::Table("_user")->Drop();
		Schema::Table("_engine")->Drop();
	}
}

?>
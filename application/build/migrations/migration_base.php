<?php

/*
 * Base migration
 * @author Jake Josol
 * @description Base migration
 */

use Warp\Utils\Interfaces\IMigration;

class migration_base implements IMigration
{
	public function Up()
	{
		Schema::Table("_User")
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

		Schema::Table("_Engine")
			->ID()
			->Integer("userID")
			->String("uniqueID")
			->Integer("processInstance")
			->String("title")
			->String("type")
			->String("status")
			->Timestamps()
			->Create();

		Schema::Table("_Engine")
			->Unique("uniqueID")
			->Alter();
	}

	public function Down()
	{
		Schema::Table("_User")
			->Drop();

		Schema::Table("_Engine")
			->Drop();
	}
}

?>
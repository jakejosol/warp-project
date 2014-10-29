<?php

/*
 * Migration installation
 * @author Jake Josol
 * @description Migration installation
 */

use Warp\Utils\Interfaces\IMigration;

class migration_install implements IMigration
{
	public function Up()
	{
		Schema::Table("_Migration")
			->ID()
			->String("name")
			->String("type")
			->Timestamps()
			->Create();
	}

	public function Down()
	{
		Schema::Table("_Migration")
			->Drop();
	}
}

?>
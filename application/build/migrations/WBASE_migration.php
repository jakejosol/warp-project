<?php

/*
 * Base migration
 * @author Jake Josol
 * @description Base migration
 */

use Warp\Utils\Interfaces\IMigration;

class WBASE_migration implements IMigration
{
	public function Up()
	{
		Schema::Table("_user")
			->ID()
			->String("secret_key", 100)
			->String("username")
			->Password()
			->String("first_name", 50)
			->String("last_name", 50)
			->String("email")
			->SessionToken()
			->Timestamps()
			->Create();

		Schema::Table("_job")
			->ID()
			->Text("handler")
			->DateTime("run_at")
			->Integer("priority")
			->Integer("attempts")
			->Text("last_error")
			->DateTime("locked_at")
			->DateTime("failed_at")
			->String("queue")
			->Timestamps()
			->Create();

		Schema::Table("_engine")
			->ID()
			->Integer("user_id")
			->String("unique_id")
			->Integer("process_instance")
			->String("title")
			->String("type")
			->String("status")
			->Timestamps()
			->Create();
	}

	public function Down()
	{
		Schema::Table("_user")->Drop();
		Schema::Table("_job")->Drop();
		Schema::Table("_engine")->Drop();
	}
}

?>
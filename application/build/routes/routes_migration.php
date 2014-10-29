<?php

/****************************************
MIGRATION ROUTES - Development Mode Only
****************************************/

use Warp\Utils\Enumerations\DebugMode;

if(Application::GetInstance()->GetDebugMode() == DebugMode::Development)
{
	Router::Get("migrate/install", "MigrationController@Install");
	Router::Get("migrate/uninstall", "MigrationController@Uninstall");
	Router::Get("migrate/make/alphanum:name", "MigrationController@Make");
	Router::Get("migrate/destroy/alphanum:name", "MigrationController@Destroy");
	Router::Get("migrate/revert", "MigrationController@Revert");
	Router::Get("migrate/reset", "MigrationController@Reset");
	Router::Get("migrate/base", "MigrationController@Base");
	Router::Get("migrate/all", "MigrationController");
}

?>
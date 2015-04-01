<?php

/**
 * Reference Manager
 * @author Jake Josol
 * @description Determines the references used by the app
 */

require_once __DIR__."/../vendor/autoload.php";

/****************************************
BASE - Base reference class
****************************************/
class Reference extends Warp\Core\Reference {}

/****************************************
PATHS - Directory paths
****************************************/
Reference::Path("class", 			__DIR__."/classes/");
Reference::Path("control",	 		__DIR__."/controls/");
Reference::Path("vendor", 			__DIR__."/../vendor/");
Reference::Path("model", 			__DIR__."/../application/build/models/");
Reference::Path("controller", 		__DIR__."/../application/build/controllers/");
Reference::Path("view", 			__DIR__."/../application/build/views/");
Reference::Path("configuration",	__DIR__."/../application/build/configurations/");
Reference::Path("migration", 		__DIR__."/../application/build/migrations/");
Reference::Path("route",			__DIR__."/../application/build/routes/");
Reference::Path("layout",			__DIR__."/../application/design/layouts/");
Reference::Path("page",				__DIR__."/../application/design/pages/");
Reference::Path("partial",			__DIR__."/../application/design/partials/");
Reference::Path("store",			__DIR__."/../application/store/");
Reference::Path("resource",			__DIR__."/../resources/");

/****************************************
CLASSES - Register Utility classes
****************************************/
Reference::Register();

/****************************************
VENDORS - Register Third party libraries
****************************************/
//Reference::Vendor("Vendor/autoload");

?>
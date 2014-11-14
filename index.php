<?php

/**
 * Warp Framework
 * @author Jake Josol
 * @copyright MIT License
 */

require_once "references/references.php";

/****************************************
INITIALIZE - Prepare the application
****************************************/
App::Meta()
	->Title("Warp")
	->Subtitle("The Warp Framework")
	->Description("A PHP framework for creating apps in warp speed")
	->Keywords(array("API-based", "Design-centered", "Controls-extensible"));

App::Environment()
	->Add("localhost:811", "development");

/****************************************
START - Start the application
****************************************/
App::Start();

?>
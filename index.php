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
Application::Initialize()
	->SetPath("warp")
	->SetTitle("Warp")
	->SetSubtitle("The Warp Framework")
	->SetDescription("A PHP framework for creating API-based, Design-centered and Controls-extensible applications")
	->SetKeywords(array("API-based", "Design-centered", "Controls-extensible"));

Application::GetInstance()
	->AddEnvironment("localhost:811", "Dev");

/****************************************
START - Start the application
****************************************/
Application::GetInstance()->Start();

?>
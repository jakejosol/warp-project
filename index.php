<?php

/*
 * WARP (Web Apps Ready-to-Publish) Framework
 * @url http://bitbucket.org/jakejosol/warp.git
 */

require_once "references/classes/Application.php";

/****************************************
INITIALIZE THE APPLICATION
****************************************/
Application::Initialize("warp")
	->SetConfiguration(new ProdConfig);
	
// Set Application details
Application::GetInstance()
	->SetTitle("WARP")
	->SetSubtitle("Web App Ready-to-Publish")
	->SetDescription("A PHP framework for creating API-based, Design-centered and Controls-extensible applications")
	->SetKeywords(array("API-based", "Design-centered", "Controls-extensible"));

// Set Application Pages
Application::GetInstance()
	->SetHomePage("Home")
	->AddPage("user","User");

// Start the application	
Application::GetInstance()
	->Start();
?>
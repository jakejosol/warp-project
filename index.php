<?php

/*
 * WARP (Web Apps Ready-to-Publish) Framework
 * @url http://github.com/jakejosol/warp.git
 */

require_once "references/classes/Application.php";

/****************************************
INITIALIZE THE APPLICATION
****************************************/
Application::Initialize()
	->SetDebugMode(DebugMode::PRODUCTION)
	->SetDatabase("main");
	
// Set Application details
Application::GetInstance()
	->SetTitle("WARP")
	->SetSubtitle("Web App Ready-to-Publish")
	->SetDescription("A PHP framework for creating API-based, Design-centered and Controls-extensible applications")
	->SetKeywords(array("API-based", "Design-centered", "Controls-extensible"));

// Set Application Pages
Application::GetInstance()
	->AddPage("user", "User")
	->SetDefault("NotFound");
	
Application::GetInstance()
	->Start();	

?>
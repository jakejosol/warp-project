<?php

/*
 * Routes
 * @author Jake Josol
 * @description Determines the routes used by the app
 */

/****************************************
IMPORTED ROUTES
****************************************/

Router::Import("api");
Router::Import("engine");
Router::Import("migration");

/****************************************
GENERAL ROUTES
****************************************/

Router::Home(function()
{
	return HomeView::Make()->Render();
});

Router::None(function()
{
	return NotFoundView::Make()->Render();
});

/****************************************
USER-DEFINED ROUTES
****************************************/

Router::Get("hello/alpha:name/int:digits", function($parameters)
{
	return "Hello " .$parameters["name"]. ", is it me you're looking for? I'll call you at {$parameters["digits"]}";
});

Router::Crud("user","User");

?>
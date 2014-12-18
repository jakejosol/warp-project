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

Router::Home("HomeController");
Router::None("NotFoundController");
Router::Crud("user","User");

/****************************************
USER-DEFINED ROUTES
****************************************/

// Alias Demo
Router::Get("hello/alpha:name/int:digits", function($parameters)
{
	return "Hello {$parameters["name"]}, is it me you're looking for? I'll call you at {$parameters["digits"]}";
});

// Protected Demo
Router::Get("dashboard", function($parameters)
{
	echo "Hello " . Auth::User()->username;
}, 
array("before" => "auth.active", "failed" => "login"));

/****************************************
ACCESS ROUTES
****************************************/

// Login Demo
Router::Get("login", function()
{
	try
	{
		Auth::LogIn(array("username" => Input::FromGet("username"), "password" => Input::FromGet("password")));
		Navigate::Within("dashboard");
	}
	catch(Warp\Utils\Exceptions\AuthenticationException $e)
	{
		if($e instanceof Warp\Utils\Exceptions\PasswordNotFoundException)
			return "Password is required.";
		else if($e instanceof Warp\Utils\Exceptions\InvalidCredentialsException)
			return "Invalid login credentials.";
	}
});

Router::Get("logout", function()
{
	Auth::LogOut();
	Navigate::Within("hello/jack/5320101");
});

?>
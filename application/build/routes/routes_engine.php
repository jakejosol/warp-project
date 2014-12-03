<?php

/****************************************
ENGINE ROUTES
****************************************/

// Engine route
Router::Post("engines/alpha:name", function($parameters)
{	
	$engineName = $parameters["name"];
	$runParams = Input::All();
	
	$engine = Engine::Load($engineName);
		
	return $engine? $engine->Run($runParams) : "Unknown engine";
});

?>
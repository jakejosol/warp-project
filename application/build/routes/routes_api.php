<?php

/****************************************
API ROUTES
****************************************/
use Warp\Http\API;
use Warp\Http\Response;

Router::Group("api/1/alpha:class/", function(){

	Router::Any("view", function($parameters)
	{
		return API::Request(array(
			"class" => $parameters["class"],
			"action" => "View",
			"parameters" => $parameters				
		));
	});

	Router::Get("view/int:id", function($parameters)
	{
		return API::Request(array(
			"class" => $parameters["class"],
			"action" => "View",
			"parameters" => $parameters				
		));	
	});

	Router::Post("add", function($parameters)
	{
		return API::Request(array(
			"class" => $parameters["class"],
			"action" => "Add",
			"parameters" => $parameters				
		));
	});

	Router::Post("edit/int:id", function($parameters)
	{
		return API::Request(array(
			"class" => $parameters["class"],
			"action" => "Edit",
			"parameters" => $parameters				
		));
	});

	Router::Post("delete", function($parameters)
	{
		return API::Request(array(
			"class" => $parameters["class"],
			"action" => "Delete",
			"parameters" => $parameters				
		));
	});

});

?>
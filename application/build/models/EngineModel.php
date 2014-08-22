<?php

/*
 * Engine model
 * @author Jake Josol
 * @description Engine model
 */
 
class EngineModel extends Model
{
	protected static $source = "_Engine";
	protected static $key = "objectID";
	protected static $fields = array(
		"objectID" => array(
			"label" => "ID",
			"type" => FieldType::INTEGER,
			"increment" => true,
			"input" => InputType::DISPLAY
		),
		"ownerID" => array(
			"label" => "Owner",
			"type" => FieldType::INTEGER,
			"input" => InputType::DISPLAY
		),
		"uniqueID" => array(
			"label" => "Unique ID",
			"type" => FieldType::STRING,
			"input" => InputType::DISPLAY
		),
		"processInstance" => array(
			"label" => "Process Instance",
			"type" => FieldType::INTEGER,
			"input" => InputType::DISPLAY
		),
		"title" => array(
			"label" => "Title",
			"type" => FieldType::STRING,
			"input" => InputType::DISPLAY
		),
		"type" => array(
			"label" => "Type",
			"type" => FieldType::STRING,
			"input" => InputType::DISPLAY
		),		
		"status" => array(
			"label" => "Status",
			"type" => FieldType::STRING,
			"input" => InputType::TEXT
		)
 	);
}

?>
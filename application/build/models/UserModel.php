<?php

/*
 * User model
 * @author Jake Josol
 * @description User model
 */
 
class UserModel extends Model
{
	protected static $source = "_User";
	protected static $key = "objectID";
	protected static $fields = array(
		"objectID" => array(
			"label" => "ID",
			"type" => FieldType::INTEGER,
			"increment" => true,
			"input" => InputType::DISPLAY
		),
		"apiKey" => array(
			"label" => "API Key",
			"type" => FieldType::INTEGER,
			"input" => InputType::INTEGER
		),
		"username" => array(
			"label" => "Username",
			"type" => FieldType::STRING
		),
		"password" => array(
			"label" => "Password",
			"type" => FieldType::STRING
		),
		"firstName" => array(
			"label" => "First Name",
			"type" => FieldType::STRING
		),
		"lastName" => array(
			"label" => "Last Name",
			"type" => FieldType::STRING
		),
		"email" => array(
			"label" => "Email",
			"type" => FieldType::STRING,
			"input" => InputType::EMAIL
		)
	);
}

?>
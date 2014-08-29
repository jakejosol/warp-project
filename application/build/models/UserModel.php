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

	protected static function initialize()
	{
		self::Has("objectID")->Label("ID")->Type(FieldType::INTEGER)->Input(InputType::DISPLAY);
		self::Has("apiKey")->Label("API Key");
		self::Has("username")->Label("Username");
		self::Has("password")->Label("Password")->Type(FieldType::PASSWORD);
		self::Has("firstName")->Label("First Name");
		self::Has("lastName")->Label("Last Name");
		self::Has("email")->Label("Email")->Input(InputType::EMAIL);

		self::Scope("apiUsers", function($query)
		{
			$query->WhereIsNotNull("apiKey");
		});
	}
}

?>
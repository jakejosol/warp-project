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

	protected static function build()
	{
		self::Has("objectID")->Label("ID")
			->Increment();
		 
		self::Has("apiKey")->Label("API Key")
			->String(30);
		
		self::Has("username")->Label("Username")
			->String(30);
		
		self::Has("password")->Label("Password")
			->Password();
		
		self::Has("firstName")->Label("First Name")
			->String(50);
		
		self::Has("lastName")->Label("Last Name")
			->String(50);
		
		self::Has("email")->Label("Email")
			->Input(InputType::EMAIL);

		self::Scope("apiUsers", function($query)
		{
			$query->WhereIsNotNull("apiKey");
			return $query;
		});
	}
}

?>
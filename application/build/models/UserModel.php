<?php

/*
 * User model
 * @author Jake Josol
 * @description User model
 */
 
use Warp\Enumerations\SystemField;

class UserModel extends Model
{
	protected static $source = "_User";
	protected static $key = "id";

	protected static function build()
	{
		self::Has(SystemField::ID)->Increment();
		self::Has("secretKey")->String(30);		
		self::Has("username")->String(30);		
		self::Has("password")->Password();		
		self::Has("firstName")->String(50);		
		self::Has("lastName")->String(50);		
		self::Has("email")->Input(InputType::EMAIL);

		self::Scope("apiUsers", function($query)
		{
			$query->WhereIsNotNull("secretKey");
			return $query;
		});
	}
}

?>
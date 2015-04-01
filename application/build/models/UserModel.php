<?php

/*
 * User model
 * @author Jake Josol
 * @description User model
 */
 
use Warp\Utils\Enumerations\SystemField;
use Warp\Utils\Enumerations\InputType;

class UserModel extends Model
{
	protected static $source = "_User";
	protected static $key = "id";
	protected static $fields = array();

	protected static function build()
	{
		self::Has(SystemField::ID)->Increment();
		self::Has("secretKey")->String(30);		
		self::Has("username")->String(30);		
		self::Has("password")->Password();		
		self::Has("firstName")->String(50);		
		self::Has("lastName")->String(50);		
		self::Has("email")->Input(InputType::Email);
	}
}

?>
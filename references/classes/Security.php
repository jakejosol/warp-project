<?php

/*
 * Security class
 * @author Jake Josol
 * @description Utility class for all security tiers
 */
 
class Security
{
	const HASH_COST_LOG2 = 8;
	const HASH_PORTABLE = false;
	
	public static function EncryptPassword($password)
	{
		$hasher = new PasswordHash(self::HASH_COST_LOG2, self::HASH_PORTABLE);
		$spassword = $hasher->HashPassword($password);
		if(strlen($spassword) < 20) fail("Failed to secure the password.");
		unset($hasher);
		
		return $spassword;
	}
	
	public static function ComparePassword($password, $hash)
	{
		$hasher = new PasswordHash(self::HASH_COST_LOG2, self::HASH_PORTABLE);
		return $hasher->CheckPassword($password,$hash);
	}
}

?>
<?php

/*
 * Engine model
 * @author Jake Josol
 * @description Engine model
 */

use Warp\Enumerations\SystemField;
 
class EngineModel extends Model
{
	protected static $source = "_Engine";
	protected static $key = "id";

	protected static function build()
	{
		self::Has(SystemField::ID)->Increment();	
		self::BelongsTo("User");
		self::Has("uniqueID")->Unique();
		self::Has("processInstance")->Integer();
		self::Has("title")->String(30);
		self::Has("type")->String(30);
		self::Has("status")->Lookup("queued","processing","succeeded","failed","cancelled");
	}
}

?>
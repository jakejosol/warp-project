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

	protected static function build()
	{
		self::Has("objectID")->Label("ID")
			->Increment();	

		self::BelongsTo("User")->Label("Owner");
		
		self::Has("uniqueID")->Label("Unique ID")
			->Unique();
		
		self::Has("processInstance")->Label("Process Instance")
			->Integer();		
		
		self::Has("title")->Label("Title")
			->String(30);
		
		self::Has("type")->Label("Type")
			->String(30);
		
		self::Has("status")->Label("Status")
			->Lookup("queued","processing","succeeded","failed","cancelled");
	}
}

?>
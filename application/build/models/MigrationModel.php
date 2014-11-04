<?php

/*
 * Migration model
 * @author Jake Josol
 * @description Migration model
 */

use Warp\Utils\Enumerations\SystemField;

class MigrationModel extends Model
{
	protected static $source = "_Migration";
	protected static $key = "id";
	protected static $fields = array();

	protected static function build()
	{
		self::Has(SystemField::ID)->Increment();
		self::Has("name")->String(30);		
		self::Has("type")->String(30);

		self::Scope("pending", function($query)
		{
			$query->WhereIsNull(SystemField::DeletedAt);
			$query->OrderBy(SystemField::CreatedAt);
			return $query;
		});
		self::Scope("migrated", function($query)
		{
			$query->WhereIsNotNull(SystemField::DeletedAt);
			$query->OrderByDescending(SystemField::CreatedAt);
			return $query;
		});

	}
}

?>
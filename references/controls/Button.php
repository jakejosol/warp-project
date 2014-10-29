<?php

/*
 * Button control
 * @author Jake Josol
 * @description Button
 */

class Button extends Division
{
	const BUTTON_PREFIX = "btn-";
	const BUTTON_PRIMARY = "primary";
	const BUTTON_DEFAULT = "default";
	protected $type = "button";
	protected $classes = array("warp-button","btn");
	protected static $name = "Button";
	protected static $BUTTON_TYPE = array(
		"PRIMARY" => "primary",
		"DEFAULT" => "default",
		"SUCCESS" => "success",
		"INFO" => "info",
		"WARNING" => "warning",
		"DANGER" => "danger"
	);
	protected static $BUTTON_SIZE = array(
		"LARGE" => "lg",
		"SMALL" => "sm",
		"EXTRA_SMALL" => "xs"
	);
	
	public function SetButtonType($type)
	{
		foreach(static::$BUTTON_TYPE as $btnType => $value) 
			$this->RemoveClass(self::BUTTON_PREFIX.static::$BUTTON_TYPE[$btnType]);
		$this->AddClass(self::BUTTON_PREFIX.static::$BUTTON_TYPE[$type]);
		return $this;
	}
	
	public function SetButtonSize($size)
	{
		foreach(static::$BUTTON_SIZE as $btnSize => $value) 
			$this->RemoveClass(self::BUTTON_PREFIX.static::$BUTTON_SIZE[$btnSize]);
		$this->AddClass(self::BUTTON_PREFIX.static::$BUTTON_SIZE[$size]);
		return $this;
	}
}

?>
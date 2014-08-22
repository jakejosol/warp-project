<?php

/*
 * Alert Box control
 * @author Jake Josol
 * @description Alert Box
 */
 
class AlertBox extends Division
{
	const ALERT_PREFIX = "alert-";
	protected $classes = array("warp-alertbox","alert");
	protected static $name = "AlertBox";
	protected static $ALERT_TYPE = array(
		"SUCCESS" => "success",
		"INFO" => "info",
		"WARNING" => "warning",
		"DANGER" => "danger",
		"DISMISSABLE" => "dismissable"	
	);
	
	public function SetAlertType($type)
	{
		$this->AddClass(self::ALERT_PREFIX.static::$ALERT_TYPE[$type]);
		return $this;
	}
	
	public function SetDismissability($isDismissable)
	{
		if($isDismissable) 
		{
			$this->AddClass(self::ALERT_PREFIX.static::$ALERT_TYPE["DISMISSABLE"]);
			$this->AddChild(
				Button::Create($this->GetID()."-dismiss-button")
				->AddClass("close")
				->SetProperty("data-dismiss", "alert")
				->SetText("&times;")
			);
		}
		else
		{
			$this->RemoveClass(self::ALERT_PREFIX.static::$ALERT_TYPE["DISMISSABLE"]);
			$this->RemoveChild($this->GetID()."-dismiss-button");
		}
		
		return $this;
	}
}

?>
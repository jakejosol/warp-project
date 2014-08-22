<?php

/*
 * Form group control
 * @author Jake Josol
 * @description Form group
 */
 
class FormGroup extends Control
{
	const CONTROL_LABEL = "control-label";
	const FORM_CONTROL = "form-control";
	const LABEL_INDEX = 0;
	const INPUT_INDEX = 1;
	protected $type = "div";	
	protected $classes = array("warp-form-group", "form-group");
	protected static $name = "FormGroup";
	
	public function AddLabel($label, $id=null)
	{
		if($id) $label->FindChildByID($id)->AddClass(self::CONTROL_LABEL);
		else $label->AddClass(self::CONTROL_LABEL);
		
		$this->AddChild($label);
		return $this;
	}
	
	public function AddInput($input, $id=null)
	{
		if($id) $input->FindChildByID($id)->AddClass(self::FORM_CONTROL);
		else $input->AddClass(self::FORM_CONTROL);
		
		$this->AddChild($input);
		return $this;
	}
	
	public function AddButton($button)
	{
		$this->AddChild($button);
		return $this;
	}		
}
 
?>
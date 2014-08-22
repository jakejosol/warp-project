<?php

/*
 * Crud Form control
 * @author Jake Josol
 * @description Crud Formm
 */
 
class CrudForm extends Form
{
	protected static $name = "CRUDForm";
	protected $LABEL_COLUMN_SPAN = 1;
	protected $INPUT_COLUMN_SPAN = 11;
		
	public function SetModel($model)
	{	
		$this->children = array();
			
		foreach($model->GetValues() as $field => $value)
		{
			$this->AddChild(
				FormGroup::Create("form-group-{$field}")
					->AddClass("row")
					->AddLabel(Label::Create($field."-label")
									->SetText($model->GetFieldLabel($field))
									->SetColumnSpan($this->LABEL_COLUMN_SPAN)
									->SetFor($field))
					->AddInput(Division::Create($field."-div")
									->SetColumnSpan($this->INPUT_COLUMN_SPAN)
									->AddChild(Input::Create($field)
												->SetName($field)
												->SetValue($value)
												->SetInputType($model->GetFieldInput($field))
												->SetPlaceholder($field)), 
					$field)
			);
		}
		
		return $this;
	}
	
	public function SetLabelColumnSpan($span, $offset=null, $size=null)
	{
		$this->LABEL_COLUMN_SPAN = $span;
		
		return $this;
	}
	
	public function SetInputColumnSpan($span, $offset=null, $size=null)
	{
		$this->INPUT_COLUMN_SPAN = $span;
		
		return $this;
	}
}

?>
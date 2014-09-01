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
			if($model->GetFieldGuarded($field)) 
			{
				$input = Input::Create($field)
						->SetName($field)
						->SetValue($value)
						->SetInputType(InputType::HIDDEN);

				$this->AddChild($input);
				continue;
			}

			$input = Input::Create($field)
					->SetName($field)
					->SetValue($value)
					->SetInputType($model->GetFieldInput($field))
					->SetPlaceholder($model->GetFieldLabel($field));
			
			switch($model->GetFieldInput($field))
			{
				case InputType::SELECT:
					$input = Select::Create($field)
							->SetName($field);
						
					foreach($model->GetFieldLookup($field) as $lookupValue)
						$input->AddOption($lookupValue);
				break;
				
				case InputType::TEXTAREA:
					$input = TextArea::Create($field)
							->SetName($field)
							->SetPlaceholder($model->GetFieldLabel($field));
				break;
			}			
			
			$label = Label::Create($field."-label")
										->SetText($model->GetFieldLabel($field))
										->SetColumnSpan($this->LABEL_COLUMN_SPAN)
										->SetFor($field);
			
			if($model->GetFieldRequired($field))
			{
				$input->SetProperty("required", true);
				$input->AddClass("required");
				$label->SetText($model->GetFieldLabel($field) . "*");
			}
						
			if($model->GetKey() != $field)
				$this->AddChild(
					FormGroup::Create("form-group-{$field}")
						->AddClass("row")
						->AddLabel($label)
						->AddInput(Division::Create($field."-div")
										->SetColumnSpan($this->INPUT_COLUMN_SPAN)
										->AddChild($input),
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
<?=CrudForm::Create("form-1")
	->SetAction(Resource::Local("/api/user/edit"))
	->SetMethod(FormMethod::POST)
	->SetInputColumnSpan(9)
	->SetModel($data->Model)
	->AddChild(HorizontalRule::Create())
	->AddChild(
		LinkButton::Create("link-back")
		->SetLink("user/view/{$data->Model->GetKeyValue()}")
		->SetButtonType(ButtonType::BTN_PRIMARY)
		->SetButtonSize(ControlSize::LARGE)
		->SetText("Back")
	)
	->AddChild(
		Button::Create("btn-save")
		->SetButtonType(ButtonType::BTN_PRIMARY)
		->SetButtonSize(ControlSize::LARGE)
		->SetText("Save")
	)
	->Render()?>

<control:CrudForm 
	id="form-1"
	action="/api/user/edit"
	method="POST"
	inputColumnSpan="9"
	model="Model">
	<hr>
	<control:LinkButton
		id="link-backk"
		link="user/view/{Model->GetKeyValue()}"
		buttonType="primary"
		buttonSize="large"
		text="Back" />
	<control:Button
		id="btn-save"
		buttonType="primary"
		buttonSize="large"
		text="Save" />
</control:CrudForm>

<script>
	$(document).ready(function(){
		$("#form-1").on("submit", function(e){
			e.preventDefault();
		});
		
		$("input[type=display]").prop("readonly",true);
		$("input[type=date]").prop("type","text").datepicker();
	});
</script>
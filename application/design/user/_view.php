<?php foreach($data->Model->GetValues() as $field => $value): ?>
	<div class="row">
		<label class="col-md-1"><?=$data->Model->GetFieldLabel($field)?></label>
		<div class="col-md-11"><?=$value?></div>
	</div>				
<?php endforeach; ?>
<hr>
<?=LinkButton::Create()
	->SetLink("user/edit/{$data->Model->GetKeyValue()}")
	->SetText("Edit")
	->AddClass("btn-lg btn-primary")
	->Render()?>
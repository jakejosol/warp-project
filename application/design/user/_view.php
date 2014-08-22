<?php foreach($data->Model->GetValues() as $field => $value): ?>
	<div class="row">
		<label class="col-md-1"><?=$data->Model->GetFieldLabel($field)?></label>
		<div class="col-md-11"><?=$value?></div>
	</div>				
<?php endforeach; ?>
<hr>
<a href="/user/edit/<?=$data->Model->USERID?>" class="btn btn-primary btn-lg">Edit</a>
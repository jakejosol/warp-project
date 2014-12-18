<html>
	<head>
		<?=Resource::Render()?>
		<style>
			body { color:#ffffff; }
			header { margin-top:100px; font-size:24pt; padding:40px; }
		</style>
	</head>
	<body>
		<section class="col-md-8 col-md-offset-2">
			<header class="lead">
				<?=$data->Page->Render()?>
			</header>
		</section>
	</body>
</html>
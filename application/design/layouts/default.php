<html>
	<?=Head::Create()->Bootstrap()->Render()?>
	<body>
		<section class="col-md-10 col-md-offset-1">
			<article class="content">
				<?=$data->Page->Render()?>
			</article>
		</section>
	</body>
</html>
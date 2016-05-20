<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>Transcenda - Corte sua foto!</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css" />
	<link rel="stylesheet" href="css/transcenda.css" />
	<link rel="stylesheet" href="css/t.css"/>
	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
</head>
<body class="corte">
	<?php require ('widesize/WideImage.php'); 
	$image = wideImage::load($imagem);
	list($x, $y) = getimagesize($imagem);
	$x = $x/2;
	$y = $y/2;
	$image = $image->resize($x, $y);
	$image->saveToFile($imagem);
	?>      
	<div class="container ">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Quase la...</h2>
			    <hr class="star-light">
				<h4>Antes disso, corte sua foto de perfil!</h4>
	
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<p align="center"><img src=<?php echo "\"".$imagem."\""; ?> id="cropimage"></p>
			</div>
		</div>
		<?= Form::open() ?>
		<?= Form::hidden('imagem', $imagem) ?>
		<?= Form::hidden('x', '', array('id' => 'x')) ?>
		<?= Form::hidden('y', '', array('id' => 'y')) ?>
		<?= Form::hidden('w', '', array('id' => 'w')) ?>
		<?= Form::hidden('h', '', array('id' => 'h')) ?>
		<br>
		<?= Form::submit('Corte aqui!', $attributes = ['class'=> 'btn btn-default btn-lg']) ?>
		<?= Form::close() ?>

	</div>
	<script type="text/javascript">

		$(function() {
			$('#cropimage').Jcrop({
				onSelect: updateCoords,

				aspectRatio: 1
			});
		});
		function updateCoords(c) {
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
		};
	</script>
</body>
</html>
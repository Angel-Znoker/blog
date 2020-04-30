<?php include_once 'app/config.inc.php'; ?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php
		if (!isset($titulo) || empty($titulo)) {
			$titulo = 'Blog (Proyecto web)';
		}
		echo "<title>$titulo</title>";
		?>

		<link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo RUTA_CSS ?>estilos.css">
	</head>

	<body>
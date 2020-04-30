<!--
	Página que se mostrará cuando haya el error 404
-->

<?php

	header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);
	echo "La página no existe.";
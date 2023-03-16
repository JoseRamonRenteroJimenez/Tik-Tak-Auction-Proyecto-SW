<?php

    session_start();

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Perfil</title>
</head>

<body>
<div id="contenedor">

	<?php
		include 'cabecera.php';
	?>
	
	<main>
		<article>
        <?php
        if(!isset($_SESSION["login"])){

            echo "Usuario no identificado. Por favor, identifíquese";
        
        } else {

            <H1>Vista General de Subastas en Mi tiktak</H1>



			if($_SESSION["login"]==true){
				echo "<h2> Texto </h2>";
				
            }
        }
        ?>
		</article>
	</main>
	
	<?php
		include 'pie.php';
	?>
</div> <!-- Fin del contenedor -->

</body>
</html>
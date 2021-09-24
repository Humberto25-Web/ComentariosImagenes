<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<style>
    body{
        background: rgba(0, 217, 255, 0.219);
    }
    .conteiner {
        
        /*IMPORTANTE*/
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .comentarios {
        
        /*IMPORTANTE*/
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form{
        border: 2px solid rgba(0, 81, 255, 0.658);
        border-radius: 25px;
        text-align: center;
        margin: 2em;
        padding: 1em;
    }
    .caja{
        border: 2px solid rgba(0, 81, 255, 0.658);
        border-radius: 25px;
        text-align: center;
        margin: 2em;
        padding: 1em;
    }
</style>
<body>
	<?php
	if (isset($_POST['publicar'])) {
	   //Recogemos el archivo enviado por el formulario
	   $archivo = $_FILES['archivo']['name'];
	   //Si el archivo contiene algo y es diferente de vacio
	   if (isset($archivo) && $archivo != "") {
	      //Obtenemos algunos datos necesarios sobre el archivo
	      $tipo = $_FILES['archivo']['type'];
	      $tamano = $_FILES['archivo']['size'];
	      $temp = $_FILES['archivo']['tmp_name'];
	      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
	     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
	        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
	        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
	     }
	     else {
	        //Si la imagen es correcta en tamaño y tipo
	        //Se intenta subir al servidor
	        if (move_uploaded_file($temp, $archivo)) {
	            chmod($archivo, 0777);
	        }
	        else {
	           //Si no se ha podido subir la imagen, mostramos un mensaje de error
	           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
	        }
	      }
	   }
	   if(isset($_REQUEST["usuario"], $_REQUEST["comentario"])){
		$usuario=$_REQUEST["usuario"];
		$comentario=$_REQUEST["comentario"];
		$guardar=fopen("publicaciones.txt", "a");
		fwrite($guardar, $usuario."\n");
		fwrite($guardar, $comentario."\n");
		fwrite($guardar, $archivo."\n");
		fclose($guardar);
		}
	}
	?>
	<div class="conteiner">
		<div class="form">
			<form action="index.php" method="post" enctype="multipart/form-data">
				<h3>Usuario:</h3>
				<input type="text" name="usuario" required class="form-control my-4" placeholder="Nombre de usuario">
                <h3>Comentario:</h3>
                <textarea name="comentario" required class="form-control my-4" placeholder="Comentario"></textarea>
                <input name="archivo" id="archivo" type="file"/><br>
                <input type="submit" name="publicar" class="btn btn-primary" value="Publicar">
			</form>
			<?php
				$mostrar=fopen('publicaciones.txt','r');
				while(!feof($mostrar)){
					$user=fgets($mostrar);
					$post=fgets($mostrar);
					$archivo=fgets($mostrar);
					echo "<table class='table table-striped'>";
					echo "<tr><td>".$user."</td></tr>";
					echo "<tr><td>Comento: ".$post."</td></tr>";
					echo "<tr><td><img src='".$archivo."'></td></tr>";
					echo "</table>";
					echo "<br>";
				}
			?> 
		</div>
	</div>
</body>
</html>
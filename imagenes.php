<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/8700b1bcd8.js" crossorigin="anonymous"></script>
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
    <div class="conteiner">
        
        <div class="form">
            <h3>Agrega tu comentario:</h3>
            <form action="imagenes.php" method="POST" enctype="multipart/form-data"/>
Añadir imagen: <input name="archivo" id="archivo" type="file"/><br>
<input type="submit" name="subir" value="Subir imagen"/>
</form>
<?php
//Si se quiere subir una imagen
if (isset($_POST['subir'])) {
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
        if (move_uploaded_file($temp,$archivo)) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod("imagenes/".$archivo, 0777);
            //Mostramos el mensaje de que se ha subido co éxito
            echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
            //Mostramos la imagen subida
            echo '<p><img src="imagenes/'.$archivo.'"></p>';
        }
        else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
   }
}
?>
</body>

</html>
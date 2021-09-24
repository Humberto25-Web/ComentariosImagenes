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
            <form action="index.php" name="f1" method="request">
                <input type="text" name="usuario" required class="form-control my-4" placeholder="Usuario">
                <textarea type="text" name="mensaje" cols="30" rows="5"></textarea><br>
                <input type="submit" class="btn btn-outline-success" value="Comentar" onclick="guardar()">
              
                 <?php   

                        $user="$_REQUEST[usuario]";
                        $mensaje="$_REQUEST[mensaje]";
                        $flag= true;
                        if($flag){
                            $guardar=fopen('comentarios.txt','a+');
                            fputs($guardar,$user."\n");
                            fputs($guardar,$mensaje."\n");
                            fclose($guardar);
                            //echo"Comentario enviado <br> <br>";
                        }

                        $mostrar=fopen('comentarios.txt','r');
                        //Se crea una tabla para mostrar los datos
                        echo "<table class='table table-striped' bgcolor='white'>";
                        echo "<thead>";
                        echo "<th>Comentarios</th>";
                        echo "</thead>";
                        while(!feof($mostrar))
                        {
                            $user=fgets($mostrar);
                            $mensaje=fgets($mostrar);
                            echo "<tr aling='left'>";
                            echo "<td><b>".$user++."</b></td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>".$mensaje."</td>";
                            echo "</tr>";

                        }
                            echo "</table>";

                 ?>
            </form>

        </div>
    </div>
    <?php
        
?>
</body>

</html>
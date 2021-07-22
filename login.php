<?php
    include 'resources/conexionBD.php';
    
    if(isset($_POST['btnLogin']))
    {
    
        $sql = "BEGIN INICIO_SESION(:username, :password, :resultado); END;";
        $parse = oci_parse($conn, $sql);
        oci_bind_by_name($parse, ':username', $username, 32);
        oci_bind_by_name($parse, ':password', $password, 32);
        oci_bind_by_name($parse, ':resultado', $resultado, 32);
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        oci_execute($parse);

        if($resultado == 1)
        {
            header('Location: index.php');
        }
        else if($resultado == 0)
        {
            echo "<script> loginInvalido=true </script>";
        }
        CloseCon($conn);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gualmarsh</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="resources/styles/styles.css">
  <link rel="stylesheet" href="resources/css/font.css">

</head>

<body>
<form action="" method="post">
        <div class="header" style="background-color: #0071CE">
            <div class="container">
               <div class="header_logo">
                    <img src="resources/imgs/logo/Logo.png" class="center" id="logo" alt>
                </div>
            </div>
        </div>
        <br>
        <div class="container col-md-5" style="font-family: 'Bogle';">
        <p hidden id = "errorLogin" style="color: red;">La combinación de correo/contraseña es incorrecta. Por favor revisar los datos e intentar nuevamente.</p>
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <fieldset class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="text"
                                   class="form-control"
                                   name="username" 
                                   required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Contraseña</label>
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   required="required">
                        </fieldset>
                        <button type="submit" class="btn btn-success" name = "btnLogin" style="background-color: #FFC223; border: #FFC223; color: black">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
</form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    var loginInvalido;
    if(loginInvalido==true)
    {
        document.getElementById('errorLogin').removeAttribute("hidden");
    }
</script>
</html>

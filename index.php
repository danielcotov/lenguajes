<?php

    include 'conexionBD.php';
    $abrirCon = OpenCon();

    if(isset($_POST['btnConsultar']))
    {
        $queryVentas = "call ConsultarVentas()";
        $listaVentas = $abrirCon -> query($queryVentas);
    }

    
    
    CloseCon($abrirCon);

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
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/estilosSitio.css" rel="stylesheet">
  <link rel="stylesheet" href="resources/styles/styles.css">

</head>

<body>
<form action="" method="post">
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Lenguajes de Base de Datos</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action bg-light">Consulta</a>
                <a href="compra.php" class="list-group-item list-group-item-action bg-light">Compra</a>
            </div>
        </div>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Menu</button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Salir <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="header" style="background-color: #0071CE">
            <div class="container">
               <div class="header_logo">
                    <img src="resources/imgs/logo/Logo.png" class="center" id="logo" alt>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <input type="submit" class="btn btn-success btn-block" id="btnConsultar" name="btnConsultar" value="Consultar Casas Vendidas"/>
                </div>
                <div class="col-4"></div>
            </div>
            <br/>
            <table class="table table-bordered">
                <thead>
                    <th>ID Venta</th>
                    <th>Nombre Vendedor</th>
                    <th>Descripción Casa</th>
                    <th>Precio</th>
                    <th>Fecha Venta</th>
                </thead>
                <tbody>
                    <?php
                        if(empty($listaVentas))
                        {
                            echo '<tr>';
                            echo '<td colspan="7">Sin Resultados</td>';
                            echo '</tr>';
                        }
                        else
                        {
                            While($row = mysqli_fetch_array($listaVentas))
                            {
                                echo '<tr>';
                                echo '<td>'. $row["IdVenta"] .'</td>';
                                echo '<td>'. $row["NombreVendedor"] .'</td>';
                                echo '<td>'. $row["DescripcionCasa"] .'</td>';
                                echo '<td>'. $row["PrecioCasa"] .'</td>';
                                echo '<td>'. $row["FechaVenta"] .'</td>';
                                
                            }
                        }
                    ?>
            </table>
            
        </div>
    </div>

  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/funcionesSitio.js"></script>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
      

        
  </script>
</form>
</body>

</html>

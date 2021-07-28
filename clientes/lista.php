<?php
    include '../resources/conexionBD.php';
    
    $sql = "BEGIN LISTAR_CLIENTES(:cur); END;";
    $parse = oci_parse($conn, $sql);
    $cur = oci_new_cursor($conn);
    oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
    
    oci_execute($parse);
    oci_execute($cur);

    // Cantidad total de Clientes
    $sqlFClientes = "SELECT CANTIDAD_CLIENTES FROM DUAL";
    $sqlLisClientes = oci_parse($conn, $sqlFClientes);

    oci_execute($sqlLisClientes);

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Clientes</title>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/font.css">
    </head>
    <body>
        <div class="wrapper d-flex align-items-stretch" style="font-family: 'Bogle';">
        <nav id="sidebar">
                <div class="custom-menu">
                </div>
                <div class="p-4">
                    <img src="../resources/images/logo.png" width="275" height="65" alt="Logo"/> 
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a href="../index.php"><span class="fa fa-home mr-3"></span> Inicio</a>
                        </li>
                        <li>
                            <a href="../empleados/lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                        </li>
                        <li>
                            <a href="../productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                        </li>
                        <li class="active">
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span>Clientes</a>
                        </li>
                        <li>
                            <a href="../reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Reportes</a>
                        </li>
                    </ul>
                    <div class="footer">
                        <p>GADAFA &copy;
                            <script>document.write(new Date().getFullYear());</script>
                        </p>
                    </div>
                </div>
            </nav>
            <div id="content" class="p-4 p-md-5 pt-5">
                <div class="row">
                    <div class="container">
                        <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Lista de Clientes</h3>
                        <hr style="height: 5px; background-color: #007DC6;">
                        <div class="container text-left">
                            <a href="formulario.php" class="btn btn-success">Agregar Cliente</a>                    
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cantidad Total de Clientes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $row = oci_fetch_object($sqlLisClientes);
                                    $row->CANTIDAD_CLIENTES;
                                    echo '<tr>';
                                    echo '<td>'. $row->CANTIDAD_CLIENTES . "<br>\n";
                                    echo '</tr>';
                                    ?>
                            </tbody>
                        </table>
                        <br>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Direccion</th>
                                    <th>Canton</th>
                                    <th>Provincia</th>
                                    <th>Pais</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Genero</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                        {
                                            echo '<tr>';
                                            echo '<td>'. $row['ID'] .'</td>';
                                            echo '<td>'. $row['NOMBRE'] .'</td>';
                                            echo '<td>'. $row['APELLIDO'] .'</td>';
                                            echo '<td>'. $row['DIRECCION'].'</td>';
                                            echo '<td>'. $row['CANTON'].'</td>';
                                            echo '<td>'. $row['PROVINCIA'].'</td>';
                                            echo '<td>'. $row['PAIS'].'</td>';
                                            echo '<td>'. $row['CORREO'] .'</td>';
                                            echo '<td>'. $row['TELEFONO'] .'</td>';
                                            echo '<td>'. $row['GENERO'] .'</td>';
                                            echo '<td>'. $row['FECHA_NACIMIENTO'] .'</td>';
                                            echo '<td><a href="formulario.php?id='. $row["ID"] .'">Actualizar</a></td>';
                                            echo '</tr>';
                                        }               
                                    ?>
                                </c:forEach>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </body>
</html>

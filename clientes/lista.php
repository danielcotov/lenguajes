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
        <style>
            .dropdown {
            position: relative;
            display: inline-block;
            }

            .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            }

            .dropdown-content a:hover {background-color: #007bff;}

            .dropdown:hover .dropdown-content {display: block;}

            .dropdown:hover .dropbtn {background-color: #007bff;}
        </style>
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
                            <a href="lista.php"><span class="fa fa-users mr-3"></span>Clientes</a>
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
                        <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Customer List</h3>
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
                        <div class="dropdown">
                            <button class="btn btn-success">Opciones</button>
                                <div class="dropdown-content">
                                    <a href="#">Cliente mas viejo</a>
                                </div>
                            </div>
                        <br>
                        <br>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Direccion</th>
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

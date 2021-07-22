<?php
    include '../resources/conexionBD.php';
    
    $sql = "BEGIN LISTAR_USUARIOS(:cur); END;";
    $parse = oci_parse($conn, $sql);
    $cur = oci_new_cursor($conn);
    oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
    
    oci_execute($parse);
    oci_execute($cur);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Empleados</title>
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
                        <li class="active">
                            <a href="lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                        </li>
                        <li>
                            <a href="../productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                        </li>
                        <li>
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
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
                        <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Lista Empleados</h3>
                        <hr style="height: 5px; background-color: #007DC6;">
                        <div class="container text-left">
                            <a href="<%=request.getContextPath()%>/employee-new" id="add-employee" class="btn btn-success">Agregar Usuario</a>  
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>CORREO</th>
                                    <th>TELÉFONO</th>
                                    <th>CANTÓN</th>
                                    <th>PROVINCIA</th>
                                    <th>GÉNERO</th>
                                    <th>FECHA NACIMIENTO</th>
                                    <th>FECHA INGRESO</th>
                                    <th>SALARIO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                    {
                                        echo '<tr>';
                                        echo '<td>'. $row['NOMBRE'] .'</td>';
                                        echo '<td>'. $row['APELLIDO'] .'</td>';
                                        echo '<td>'. $row['CORREO'] .'</td>';
                                        echo '<td>'. $row['TELEFONO'] .'</td>';
                                        echo '<td>'. $row['CANTON'] .'</td>';
                                        echo '<td>'. $row['PROVINCIA'] .'</td>';
                                        echo '<td>'. $row['GENERO'] .'</td>';
                                        echo '<td>'. $row['FECHA_NACIMIENTO'] .'</td>';
                                        echo '<td>'. $row['FECHA_INGRESO'] .'</td>';
                                        echo '<td>'. $row['SALARIO'] .'</td>';
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
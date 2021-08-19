<?php
    include '../resources/conexionBD.php';

    $sql = "BEGIN LISTAR_EMPLEADOS(:cur); END;";
    $parse = oci_parse($conn, $sql);
    $cur = oci_new_cursor($conn);
    oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
    
    oci_execute($parse);
    oci_execute($cur);
    oci_free_statement($parse);

    if (isset($_GET['id']))
    {
        $sqlEliminar = "BEGIN ELIMINAR_EMPLEADO(:id); END;";
        $parseEliminar = oci_parse($conn, $sqlEliminar);
        oci_bind_by_name($parseEliminar, ':id', $id, 32);
        $id = $_GET['id'];
        oci_execute($parseEliminar);
        oci_free_statement($parseEliminar);
        header('Location: lista.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Empleados</title>
        <link rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/styles/styles.css">
        <link rel="stylesheet" href="../resources/css/font.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <div class="p-4">
                <img src="../resources/images/logo.png" width="275" height="65" alt="Logo"/> 
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a href="../index.php"><span class="fa fa-home mr-3"></span> Inicio</a>
                        </li>
                        <li class="active">
                            <a href="../empleados/lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                        </li>
                        <li>
                            <a href="../productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                        </li>
                        <li>
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                        </li>
                        <li>
                            <a href="../reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Administración</a>
                        </li>
                    </ul>
                    <div class="footer">
                        <p>GADAFA &copy;
                            <script>document.write(new Date().getFullYear());</script>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="p-4 p-md-5 pt-5" style="margin-left: 7.5%">
            <div class="row">
                <div class="container" style="center">
                    <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Lista de Empleados</h3>
                    <hr style="height: 5px; background-color: #007DC6;">
                    <div class="container text-left" style="margin-top: 2%">
                        <a href="formulario.php" id="add-employee" class="btn btn-success" style="font-size: 1.5rem">Agregar Empleado</a>  
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>CORREO</th>
                                <th>TELÉFONO</th>
                                <th>DIRECCIÓN</th>
                                <th>CANTÓN</th>
                                <th>PROVINCIA</th>
                                <th>PAIS</th>
                                <th>GÉNERO</th>
                                <th>FECHA NACIMIENTO</th>
                                <th>FECHA INGRESO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>SALARIO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                {
                                    echo '<tr>';
                                    echo '<td name="nombre'.$row["ID"].'">'. $row['NOMBRE'] .'</td>';
                                    echo '<td>'. $row['APELLIDO'] .'</td>';
                                    echo '<td>'. $row['CORREO'] .'</td>';
                                    echo '<td>'. $row['TELEFONO'] .'</td>';
                                    echo '<td>'. $row['DIRECCION'] .'</td>';
                                    echo '<td>'. $row['CANTON'] .'</td>';
                                    echo '<td>'. $row['PROVINCIA'] .'</td>';
                                    echo '<td>'. $row['PAIS'] .'</td>';
                                    echo '<td>'. $row['GENERO'] .'</td>';
                                    //$newBirthDate = date("d-m-Y", strtotime($row['FECHA_NACIMIENTO']));
                                    echo '<td>'. $row['FECHA_NACIMIENTO'] .'</td>';
                                    //echo '<td>'. $newBirthDate .'</td>';
                                    //$newHireDate = date("d-m-Y", strtotime($row['FECHA_INGRESO']));
                                    echo '<td>'. $row['FECHA_INGRESO'] .'</td>';
                                    //echo '<td>'. $newHireDate .'</td>';
                                    echo '<td>'. $row['SALARIO'] .'</td>';
                                    echo '<td><a name = "btnActualizar" href="formulario.php?id='. $row["ID"] .'">Actualizar </a>
                                                <a name = "btnEliminar" href="lista.php?id='. $row["ID"] .'">Eliminar</a></td>';
                                    echo '</tr>';
                                }               
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

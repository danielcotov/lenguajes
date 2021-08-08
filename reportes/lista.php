<?php
    
    include '../resources/conexionBD.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_POST['btn-PMV']))
    {
        $sql = "BEGIN PRODUCTOS_MAS_VENDIDOS(:cur,:fecha); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
    
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_bind_by_name($parse, ':fecha', $fecha, 32);
        //$newDate = date("d-m-y", strtotime($_POST['fecha']));
        $fecha = $_POST['fecha'];
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-EMR']))
    {
        $sql = "BEGIN EMPLEADOS_MAS_RECIENTES(:cur); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
    
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-AS']))
    {
        $sql = "BEGIN AUMENTAR_SALARIOS(:cur, :porcentaje); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_bind_by_name($parse, ':porcentaje', $porcentaje, 32);
        $porcentaje = $_POST['porcentaje'];
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-CA']))
    {
        $sql = "BEGIN CALCULAR_AGUINALDOS(:cur); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-RA']))
    {
        $sql = "BEGIN REPORTE_ACCESO(:cur); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-CP']))
    {
        $sql = "BEGIN REPORTE_CAMBIOS_PRODUCTO(:cur); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-AG']))
    {
        $sql = "BEGIN AUDITORIA_GENERAL(:cur); END;";
        $parse = oci_parse($conn, $sql);
        $cur = oci_new_cursor($conn);
        oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_execute($parse);
        oci_execute($cur);
        oci_free_statement($parse);
    }
    if(isset($_POST['btn-CS']))
    {
        $sql = "BEGIN CIERRE_SESION(:usuario); END;";
        $parse = oci_parse($conn, $sql);
        oci_bind_by_name($parse, ':usuario', $usuario, 32);
        $usuario = $_SESSION['username'];
        oci_execute($parse);
        oci_free_statement($parse);
        header('Location: ../login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Admin</title>
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
                        <li>
                            <a href="../empleados/lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                        </li>
                        <li>
                            <a href="../productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                        </li>
                        <li>
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                        </li>
                        <li class="active">
                            <a href="../reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Admin</a>
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
                    <div class="container">
                        <form method="post">
                            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Reportes</h3>
                            <?php
                            include 'cantidades.php';
                            ?>
                            <hr style="height: 5px; background-color: #007DC6;">
                            <div class="container text-left" style="margin-top: 2%">
                                <button style="margin:10px 10px 10px 1px;" type="submit" name="btn-PMV" class="btn btn-success" >Productos Más Vendidos</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-EMR" class="btn btn-success" >Empleados Más Recientes</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-AS" class="btn btn-success" >Aumentar Salarios</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-CA" class="btn btn-success" >Calcular Aguinaldos</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-RA" class="btn btn-success" >Reporte De Accesos</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-CP" class="btn btn-success" >Cambios Productos</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-AG" class="btn btn-success" >Auditoría General</button>
                                <button style="margin:10px 10px 10px 10px;" type="submit" name="btn-CS" class="btn btn-success" >Cerrar Sesión</button>      
                            </div>
                            </br>
                            <div class="container text-left">
                                <input style="margin:10px 10px 10px 10px;" type="text" name="fecha" placeholder="dd-mm-yyyy">
                                <input style="margin:10px 10px 10px 348px;" type="text" name="porcentaje" placeholder="%">

                            </div>
                            <br>
                            <?php
                                if(isset($_POST['btn-PMV']))
                                {

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>PRODUCTO</th>
                                        <th>CANTIDAD</th>
                                        <th>FECHA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                        {
                                            echo '<tr>';
                                            echo '<td>'. $row['NOMBRE'] .'</td>';
                                            echo '<td>'. $row['CANTIDAD'] .'</td>';
                                            //$newDate = date("d-m-Y", strtotime($row['FECHA']));
                                            echo '<td>'. $row['FECHA'] .'</td>';
                                            //echo '<td>'. $newDate .'</td>';
                                            echo '</tr>';
                                        }                      
                                    ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                
                                if(isset($_POST['btn-EMR']))
                                {

                            ?>
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
                                        //$newDate = date("d-m-Y", strtotime($row['FECHA_NACIMIENTO']));
                                        //echo '<td>'. $newDate .'</td>';
                                        echo '<td>'. $row['FECHA_NACIMIENTO'] .'</td>';
                                        //$newDate = date("d-m-Y", strtotime($row['FECHA_INGRESO']));
                                        //echo '<td>'. $newDate .'</td>';
                                        echo '<td>'. $row['FECHA_INGRESO'] .'</td>';
                                        echo '<td>'. $row['SALARIO'] .'</td>';
                                        echo '</tr>';
                                    }                     
                                ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                if(isset($_POST['btn-AS']))
                                {

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th>APELLIDO</th>
                                        <th>FECHA INGRESO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>SALARIO ANTERIOR</th>
                                        <th>SALARIO NUEVO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                    {
                                        echo '<tr>';
                                        echo '<td>'. $row['NOMBRE'] .'</td>';
                                        echo '<td>'. $row['APELLIDO'] .'</td>';
                                        //$newDate = date("d-m-Y", strtotime($row['FECHA_INGRESO']));
                                        //echo '<td>'. $newDate .'</td>';
                                        echo '<td>'. $row['FECHA_INGRESO'] .'</td>';
                                        echo '<td>'. $row['SALARIO ANTERIOR'] .'</td>';
                                        echo '<td>'. $row['SALARIO'] .'</td>';
                                        echo '</tr>';
                                    }

                                ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                if(isset($_POST['btn-CA']))
                                {

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th>APELLIDO</th>
                                        <th>FECHA INGRESO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>SALARIO</th>
                                        <th>AGUINALDO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                    {
                                        echo '<tr>';
                                        echo '<td>'. $row['NOMBRE'] .'</td>';
                                        echo '<td>'. $row['APELLIDO'] .'</td>';
                                        echo '<td>'. $row['FECHA_INGRESO'] .'</td>';
                                        echo '<td>'. $row['SALARIO'] .'</td>';
                                        echo '<td>'. $row['AGUINALDO'] .'</td>';
                                        echo '</tr>';
                                    }

                                ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                if(isset($_POST['btn-RA']))
                                {

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>FECHA Y HORA</th>
                                        <th>USUARIO</th>
                                        <th>MENSAJE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                    {
                                        echo '<tr>';
                                        echo '<td>'. $row['FECHA'] .'</td>';
                                        echo '<td>'. $row['USUARIO'] .'</td>';
                                        echo '<td>'. $row['MENSAJE'] .'</td>';
                                        echo '</tr>';
                                    }

                                ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                if(isset($_POST['btn-AG']))
                                {

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>FECHA Y HORA</th>
                                        <th>USUARIO</th>
                                        <th>MENSAJE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                    {
                                        echo '<tr>';
                                        echo '<td>'. $row['FECHA'] .'</td>';
                                        echo '<td>'. $row['USUARIO'] .'</td>';
                                        echo '<td>'. $row['MENSAJE'] .'</td>';
                                        echo '</tr>';
                                    }

                                ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                if(isset($_POST['btn-CP']))
                                {

                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>FECHA Y HORA</th>
                                        <th>USUARIO</th>
                                        <th>ESTADO</th>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCION</th>
                                        <th>CANTIDAD</th>
                                        <th>CATEGORIA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                    {
                                        echo '<tr>';
                                        echo '<td>'. $row['FECHA'] .'</td>';
                                        echo '<td>'. $row['USUARIO'] .'</td>';
                                        echo '<td>'. $row['ESTADO'] .'</td>';
                                        echo '<td>'. $row['ID_PRODUCTO'] .'</td>';
                                        echo '<td>'. $row['NOMBRE'] .'</td>';
                                        echo '<td>'. $row['DESCRIPCION'] .'</td>';
                                        echo '<td>'. $row['CANTIDAD_INV'] .'</td>';
                                        echo '<td>'. $row['ID_CATEGORIA'] .'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
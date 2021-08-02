<?php
    
    include '../resources/conexionBD.php';
        
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
    
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Reportes</title>
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
                        <li>
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                        </li>
                        <li class="active">
                            <a href="lista.php"><span class="fa fa-file-text mr-3"></span> Reportes</a>
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
                        <form method="post">
                            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Reportes</h3>
                            <hr style="height: 5px; background-color: #007DC6;">
                            <div class="container text-left">
                                <button style="margin:10px 10px 10px 1px;" type="submit" name="btn-PMV" class="btn btn-success">Productos Más Vendidos</button>
                                <button style="margin:10px 10px 10px 50px;" type="submit" name="btn-EMR" class="btn btn-success">Empleados Más Recientes</button>
                                <button style="margin:10px 10px 10px 50px;" type="submit" name="btn-AS" class="btn btn-success">Aumentar Salarios</button>
                                <button style="margin:10px 10px 10px 50px;" type="submit" name="btn-CA" class="btn btn-success">Calcular Aguinaldos</button>      
                            </div>
                            </br>
                            <div class="container text-left">
                                <input style="margin:10px 10px 10px 10px;" type="text" name = "fecha" placeholder="dd-mm-yyyy">
                                <input style="margin:10px 10px 10px 348px;" type="text" name = "porcentaje" placeholder="%">

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
                                        $newDate = date("d-m-Y", strtotime($row['FECHA_INGRESO']));
                                        echo '<td>'. $newDate .'</td>';
                                        //echo '<td>'. $row['FECHA_INGRESO'] .'</td>';
                                        echo '<td>'. $row['SALARIO'] .'</td>';
                                        echo '<td>'. $row['AGUINALDO'] .'</td>';
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
            <br>
        </div>
    </body>
</html>
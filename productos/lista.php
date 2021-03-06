<?php
    include '../resources/conexionBD.php';
    
    $sql = "BEGIN LISTAR_PRODUCTOS(:cur); END;";
    $parse = oci_parse($conn, $sql);
    $cur = oci_new_cursor($conn);
    oci_bind_by_name($parse, ':cur', $cur, -1, OCI_B_CURSOR);
    
    oci_execute($parse);
    oci_execute($cur);

    if (isset($_GET['id']))
    {
        $sqlEliminar = "BEGIN ELIMINAR_PRODUCTO(:id); END;";
        $parseEliminar = oci_parse($conn, $sqlEliminar);
        oci_bind_by_name($parseEliminar, ':id', $id, 32);
        $id = $_GET['id'];
        oci_execute($parseEliminar);
        oci_free_statement($parseEliminar);
        header('Location: lista.php');
    }
    if (isset($_POST['btnBuscar']))
    {
        $sqlBuscar = "BEGIN BUSCAR_PRODUCTO(:nombre, :cur); END;";
        $parseBuscar = oci_parse($conn, $sqlBuscar);
        $cur = oci_new_cursor($conn);
        oci_bind_by_name($parseBuscar, ':cur', $cur, -1, OCI_B_CURSOR);
        oci_bind_by_name($parseBuscar, ':nombre', $nombre, 32);
        $nombre = $_POST['nombreProducto'];
        oci_execute($parseBuscar);
        oci_execute($cur);
        oci_free_statement($parseBuscar);
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Productos</title>
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
                        <li class="active">
                            <a href="../productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                        </li>
                        <li>
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                        </li>
                        <li>
                            <a href="../reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Administraci??n</a>
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
                    <form method = "post" action="">
                        <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Lista de Productos</h3>
                        <hr style="height: 5px; background-color: #007DC6;">
                        <div class="container text-left" style="margin-top: 2%">
                            <a href="formulario.php" id="add-product" class="btn btn-success" style="font-size: 1.5rem">Agregar Producto</a>                    
                            <a href="../categorias/lista.php" class="btn btn-success" style="font-size: 1.5rem">Ver Categorias</a> 
                            <input style="margin:10px 10px 10px 10px;" type="text" name = "nombreProducto" placeholder="Nombre Producto">  
                            <button name="btnBuscar" type="submit" class="btn btn-success" style="font-size: 1.5rem">Buscar</button> 
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Categoria</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    
                                while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                {
                                    echo '<tr>';
                                    echo '<td>'. $row['ID'] .'</td>';
                                    echo '<td>'. $row['NOMBRE'] .'</td>';
                                    echo '<td>'. $row['PRECIO'] .'</td>';
                                    echo '<td>'. $row['DESCRIPCION'] .'</td>';
                                    echo '<td>'. $row['CANTIDAD'] .'</td>';
                                    echo '<td>'. $row['CATEGORIA'] .'</td>';
                                    echo '<td><a href="formulario.php?id='. $row["ID"] .'">Actualizar </a>
                                                    </br><a name = "btnEliminar" href="lista.php?id='. $row["ID"] .'">Eliminar</a></td>';
                                    echo '</tr>';
                                }             
                            ?>
                            </tbody>
                        </table>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>

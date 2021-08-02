<?php
    include '../resources/conexionBD.php';
    $sql = "BEGIN LISTAR_CATEGORIA(:id, :nombre); END;";
    $parse = oci_parse($conn, $sql);
    $bindArray = array(":id"=>$_GET['id'],":nombre"=>"");
    foreach ($bindArray as $key => $val) {
        oci_bind_by_name($parse, $key, $bindArray[$key], 32);
    }
    oci_execute($parse);
    oci_free_statement($parse);
    
    if(isset($_POST['btnGuardar']))   
    {
        if ($_GET['id'] !=null)
        {
            $sqlUpdate = "BEGIN ACTUALIZAR_CATEGORIA(:id, :nombre); END;";
            $parseUpdate = oci_parse($conn, $sqlUpdate);
            $bindArrayUpdate = array(":id"=>$_GET['id'],":nombre"=>$_POST['nombre']);
            foreach ($bindArrayUpdate as $key => $val) {
                oci_bind_by_name($parseUpdate, $key, $bindArrayUpdate[$key], 32);
            }
            oci_execute($parseUpdate);
            oci_free_statement($parseUpdate);
            oci_close($conn);
            header('Location: lista.php');
        }
        else
        {
            $sqlInsert = "BEGIN INSERTAR_CATEGORIA(:id, :nombre); END;";
            $parseInsert = oci_parse($conn, $sqlInsert);
            $bindArrayInsert = array(":id"=>$_POST['id_categoria'],":nombre"=>$_POST['nombre']);
            foreach ($bindArrayInsert as $key => $val) {
                oci_bind_by_name($parseInsert, $key, $bindArrayInsert[$key], 32);
            }
            
            oci_execute($parseInsert);
            oci_free_statement($parseInsert);
            oci_close($conn);
            header('Location: lista.php');
        }
    }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>
            <?php
                if ($_GET['id'] !=null)
                {
                    echo 'Gualmarsh / Editar';
                }
                else
                {
                    echo 'Gualmarsh / Agregar';
                }
            ?>    
        </title>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/font.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                        <li class="active">
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
                        
            <!-- Contenido Principal  -->
           <div id="content" class="container col-md-5 pt-5">
                <div class="card">
                    <div class="card-body">
                            <form action="" method="post">
                            <caption>
                                <h2 style="font-family: 'Bogle'; font-size: 40px;">
                                    <?php
                                        if ($_GET['id'] !=null)
                                        {
                                            echo 'Editar Categoria';
                                        } 
                                        else
                                        {
                                            echo 'Agregar Categoria';
                                        }
                                    ?> 
                                </h2>
                                <hr style="height: 5px; background-color: #007DC6;">
                            </caption>
                            <?php
                                if ($_GET['id'] ==null)
                                {
                             ?>  
                                <fieldset class="form-group">
                                    <label>ID Categoria</label>
                                    <input readonly type="text"
                                           value="<?php
                                        $sqlCount = "BEGIN :result := CANTIDAD_CATEGORIAS; END;";
                                        $parseCount = oci_parse($conn, $sqlCount);
                                        oci_bind_by_name($parseCount, ':result', $result, 32);
                                        
                                        oci_execute($parseCount);
                                        echo($result + 1);
                                        oci_free_statement($parseCount);

                                    ?>" class="form-control"
                                           name="id_categoria" required="required">
                                </fieldset>
                                <?php  
                                    }
                                ?>
                                <fieldset class="form-group">
                                    <label>Nombre</label>
                                    <input type="text"
                                    <?php
                                        if ($_GET['id'] !=null)
                                            {
                                                echo 'value="'.$bindArray[":nombre"].'"';
                                            }
                                            else
                                            {
                                                echo 'value=""';
                                            }
                                        ?> 
                                        class="form-control"
                                        name="nombre" required="required">
                                </fieldset>
                                <button type="submit" name="btnGuardar" class="btn btn-success">Guardar</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    include '../resources/conexionBD.php';
    $sql = "BEGIN LISTAR_PRODUCTO(:id, :nombre, :precio, :descripcion, 
                                :cantidad, :categoria); END;";
    $parse = oci_parse($conn, $sql);
    $bindArray = array(":id"=>$_GET['id'],":nombre"=>"", ":precio"=>"",
                        ":descripcion"=>"",":cantidad"=>"",":categoria"=>"");                 
    foreach ($bindArray as $key => $val) {
        oci_bind_by_name($parse, $key, $bindArray[$key], 32);
    }
    oci_execute($parse);
    oci_free_statement($parse);
    
    if(isset($_POST['btnGuardar']))   
    {
        if ($_GET['id'] !=null)
        {
            $sqlUpdate = "BEGIN ACTUALIZAR_PRODUCTO(:id, :nombre, :precio, 
                            :descripcion, :cantidad, :categoria); END;";
            $parseUpdate = oci_parse($conn, $sqlUpdate);
            if ($_POST['categoria'] == '0' ){
                $bindCategoria = $_POST['otra_categoria'];
            }
            else{
                $bindCategoria = $_POST['categoria'];
            }
            $bindArrayUpdate = array(":id"=>$_GET['id'],":nombre"=>$_POST['nombre'], ":precio"=>$_POST['precio'],
            ":descripcion"=>$_POST['descripcion'],":cantidad"=>$_POST['cantidad'], ":categoria"=>$bindCategoria);
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
            
            $sqlInsert = "BEGIN INSERTAR_PRODUCTO(:id, :nombre, :precio, 
                        :descripcion, :cantidad, :categoria); END;";
            $parseInsert = oci_parse($conn, $sqlInsert);
            if ($_POST['categoria'] == '0' ){
                $bindCategoria = $_POST['otra_categoria'];
            }
            else{
                $bindCategoria = $_POST['categoria'];
            }
            $bindArrayInsert = array(":id"=>$_POST['id_producto'],":nombre"=>$_POST['nombre'], ":precio"=>$_POST['precio'],
            ":descripcion"=>$_POST['descripcion'],":cantidad"=>$_POST['cantidad'], ":categoria"=>$bindCategoria);
            foreach ($bindArrayInsert as $key => $val) {
                oci_bind_by_name($parseInsert, $key, $bindArrayInsert[$key], 32);
            }
            echo '<script>console.log("Hola Mundo"); </script>';
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
                            <a href="../reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Reportes</a>
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
                        
            <!-- Contenido Principal  -->
           <div id="content" class="container col-md-5 pt-5" style="margin-left: 38%">
                <div class="card">
                    <div class="card-body">
                            <form action="" method="post">
                            <caption>
                                <h2 style="font-family: 'Bogle'; font-size: 40px;">
                                    <?php
                                        if ($_GET['id'] !=null)
                                        {
                                            echo 'Editar Producto';
                                        } 
                                        else
                                        {
                                            echo 'Agregar Producto';
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
                                    <label>ID Producto</label>
                                    <input readonly type="text"
                                           value="<?php
                                        $sqlCount = "BEGIN :result := CANTIDAD_PRODUCTOS; END;";
                                        $parseCount = oci_parse($conn, $sqlCount);
                                        oci_bind_by_name($parseCount, ':result', $result, 32);
                                        
                                        oci_execute($parseCount);
                                        echo($result + 1);
                                        oci_free_statement($parseCount);

                                    ?>" class="form-control"
                                           name="id_producto" required="required">
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
                                <fieldset class="form-group">
                                    <label>Precio</label> 
                                    <input type="text"
                                        <?php
                                            if ($_GET['id'] !=null)
                                            {
                                                echo 'value="'.$bindArray[":precio"].'"';
                                            }
                                            else
                                            {
                                                echo 'value=""';
                                            }
                                        ?> 
                                    class="form-control"
                                    name="precio" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Descripcion</label> 
                                    <input type="text"
                                    <?php
                                        if ($_GET['id'] !=null)
                                        {
                                            echo 'value="'.$bindArray[":descripcion"].'"';
                                        }
                                        else
                                        {
                                            echo 'value=""';
                                        }
                                    ?> 
                                    class="form-control"
                                    name="descripcion" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Cantidad</label> 
                                    <input type="text"
                                    <?php
                                        if ($_GET['id'] !=null)
                                        {
                                            echo 'value="'.$bindArray[":cantidad"].'"';
                                        }
                                        else
                                        {
                                            echo 'value=""';
                                        }
                                    ?> 
                                    class="form-control"
                                    name="cantidad" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Categoria</label> 
                                    <select name ="categoria" id="categoria" class="form-control">
                                    <?php
                                        $sqlCategorias = "BEGIN LISTAR_CATEGORIAS(:cur); END;";
                                        $parseCategorias = oci_parse($conn, $sqlCategorias);
                                        $cur = oci_new_cursor($conn);
                                        oci_bind_by_name($parseCategorias, ':cur', $cur, -1, OCI_B_CURSOR);
                                        
                                        oci_execute($parseCategorias);
                                        oci_execute($cur);
                                        oci_free_statement($parseCategorias);
                                        if ($_GET['id'] !=null)
                                        {
                                            echo '<option value="'.$bindArray[":categoria"].'">'.$bindArray[":categoria"].'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="default">Seleccione una categoria</option>';
                                        }
                                        while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                        {
                                            if ($bindArray[":categoria"]!=$row["NOMBRE"])
                                            {
                                                echo '<option value="'.$row["NOMBRE"].'">'.$row["NOMBRE"].'</option>';
                                            }
                                        }
                                        echo '<option value="0">Otra...</option>';
                                    ?> 
                                    </select>
                                    <fieldset class="form-group">
                                        <input id="otra_categoria" type="text" style="display: none;"
                                        value="" class="form-control"
                                        name="otra_categoria">
                                    <fieldset class="form-group">
                            </fieldset>
                            <br>
                            <button type="submit" name="btnGuardar" class="btn btn-success" style="font-size: 1.5rem">Guardar</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#categoria").change(function(){
                if($(this).val() == 0){
                    $("#otra_categoria").show();
                }else{
                    $("#otra_categoria").hide();
                }
                var categoria = $("#categoria").val();
                });
        </script>
    </body>
</html>

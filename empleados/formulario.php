<?php
    include '../resources/conexionBD.php';
    $sql = "BEGIN LISTAR_USUARIO(:id, :nombre, :apellido, :correo, :contrasena,
                                 :telefono, :direccion, :canton, :provincia, :pais, :genero, 
                                 :fecha_nacimiento, :fecha_ingreso, :salario); END;";
    $parse = oci_parse($conn, $sql);
    $bindArray = array(":id"=>$_GET['id'],":nombre"=>"", ":apellido"=>"", 
                        ":correo"=>"", ":contrasena"=>"", ":telefono"=>"", 
                        ":direccion"=>"", ":canton"=>"", ":provincia"=>"",
                        ":pais"=>"",":genero"=>"", ":fecha_nacimiento"=>"", 
                        ":fecha_ingreso"=>"", ":salario"=>"");
    foreach ($bindArray as $key => $val) {
        oci_bind_by_name($parse, $key, $bindArray[$key], 32);
    }
    oci_execute($parse);
    oci_free_statement($parse);
    
    if(isset($_POST['btnGuardar']))   
    {
        if ($_GET['id'] !=null)
        {
            $sqlUpdate = "BEGIN ACTUALIZAR_USUARIO(:id, :nombre, :apellido, :correo, :contrasena,
                                            :telefono, :direccion, :canton, :provincia, :pais, 
                                            :genero, :fecha_nacimiento, :fecha_ingreso,
                                            :salario); END;";
            $parseUpdate = oci_parse($conn, $sqlUpdate);

            if ($_POST['pais'] == '0' ){
                $bindPais = $_POST['otro_pais'];
            }
            else
            {
                $bindPais = $_POST['pais'];
            }
            if ($_POST['provincia'] == '0' ){
                $bindProvincia = $_POST['otra_provincia'];
            }
            else
            {
                $bindProvincia = $_POST['provincia'];
            }
            if ($_POST['canton'] == '0' ){
                $bindCanton = $_POST['otro_canton'];
            }
            else
            {
                $bindCanton = $_POST['canton'];
            }
            $bindArrayUpdate = array(":id"=>$_GET['id'],":nombre"=>$_POST['nombre'], ":apellido"=>$_POST['apellido'], 
            ":correo"=>$_POST['correo'], ":contrasena"=>$_POST['contrasena'], ":telefono"=>$_POST['telefono'], 
            ":direccion"=>$_POST['direccion'], ":canton"=>$bindCanton, ":provincia"=>$bindProvincia, ":pais"=>$bindPais,
            ":genero"=>$_POST['genero'],":fecha_nacimiento"=>$_POST['fechaNacimiento'], 
            ":fecha_ingreso"=>$_POST['fechaIngreso'], ":salario"=>$_POST['salario']);
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
            $sqlInsert = "BEGIN INSERTAR_USUARIO(:id, :nombre, :apellido, :correo, :contrasena,
                                            :telefono, :direccion, :canton, :provincia, :pais, :genero, 
                                            :fecha_nacimiento, :fecha_ingreso, :salario); END;";
            $parseInsert = oci_parse($conn, $sqlInsert);
            if ($_POST['pais'] == '0' ){
                $bindPais = $_POST['otro_pais'];
            }
            else
            {
                $bindPais = $_POST['pais'];
            }
            if ($_POST['provincia'] == '0' ){
                $bindProvincia = $_POST['otra_provincia'];
            }
            else
            {
                $bindProvincia = $_POST['provincia'];
            }
            if ($_POST['canton'] == '0' ){
                $bindCanton = $_POST['otro_canton'];
            }
            else
            {
                $bindCanton = $_POST['canton'];
            }
            $bindArrayInsert = array(":id"=>$_POST['id_usuario'],":nombre"=>$_POST['nombre'], ":apellido"=>$_POST['apellido'], 
            ":correo"=>$_POST['correo'], ":contrasena"=>$_POST['contrasena'], ":telefono"=>$_POST['telefono'], 
            ":direccion"=>$_POST['direccion'], ":canton"=>$bindCanton, ":provincia"=>$bindProvincia, ":pais"=>$bindPais,
            ":genero"=>$_POST['genero'],":fecha_nacimiento"=>$_POST['fechaNacimiento'], 
            ":fecha_ingreso"=>$_POST['fechaIngreso'], ":salario"=>$_POST['salario']);
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

        <div id="content" class="container col-md-5 pt-5" style="margin-left: 38%">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <caption>
                            <h2 style="font-family: 'Bogle'; font-size: 40px;">
                                <?php
                                    if ($_GET['id'] !=null)
                                    {
                                        echo 'Editar Empleado';
                                    } 
                                    else
                                    {
                                        echo 'Agregar Empleado';
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
                        <label>ID Empleado</label>
                            <input readonly type="text"
                                value="<?php
                                    $sqlCount = "BEGIN :result := CANTIDAD_USUARIOS; END;";
                                    $parseCount = oci_parse($conn, $sqlCount);
                                    oci_bind_by_name($parseCount, ':result', $result, 32);
                                    
                                    oci_execute($parseCount);
                                    echo($result + 1);
                                    oci_free_statement($parseCount);

                                ?>" class="form-control"
                                name="id_usuario" required="required">
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
                            <label>Apellido</label>
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":apellido"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="apellido" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Correo</label>
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":correo"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="correo" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Contraseña</label>
                            <input type="password"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":contrasena"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                    class="form-control"
                                    name="contrasena" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Teléfono</label> 
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":telefono"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="telefono">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Dirección</label> 
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":direccion"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="direccion">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>País</label> 
                            <select name ="pais" id="pais" class="form-control">
                            <?php
                                $sqlPaises = "BEGIN LISTAR_PAISES(:cur); END;";
                                $parsePaises = oci_parse($conn, $sqlPaises);
                                $cur = oci_new_cursor($conn);
                                oci_bind_by_name($parsePaises, ':cur', $cur, -1, OCI_B_CURSOR);
                                
                                oci_execute($parsePaises);
                                oci_execute($cur);
                                oci_free_statement($parsePaises);
                                if ($_GET['id'] !=null)
                                {
                                    echo '<option value="'.$bindArray[":pais"].'">'.$bindArray[":pais"].'</option>';
                                }
                                else
                                {
                                    echo '<option value="default">Seleccione un país</option>';
                                }
                                while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
                                {
                                    if ($bindArray[":pais"]!=$row["NOMBRE"])
                                    {
                                        echo '<option value="'.$row["NOMBRE"].'">'.$row["NOMBRE"].'</option>';
                                    }
                                }
                                echo '<option value="0">Otro...</option>';
                            ?> 
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <input id="otro_pais" type="text" style="display: none;"
                                value="" class="form-control"
                                name="otro_pais">
                        <fieldset class="form-group">
                            <label>Provincia</label>
                                <select disabled name ="provincia" id="provincia" class="form-control">
                                <?php
                                    include 'provincias.php';
                                ?>
                                </select> 
                        </fieldset>
                        <fieldset class="form-group">
                            <input id="otra_provincia" type="text" style="display: none;"
                                value="" class="form-control"
                                name="otra_provincia">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Cantón</label>
                            <select disabled name ="canton" id="canton" class="form-control">
                            <?php
                                include 'cantones.php';
                            ?>
                            </select> 
                        </fieldset>
                        <fieldset class="form-group">
                            <input id="otro_canton" type="text" style="display: none;"
                                value="" class="form-control"
                                name="otro_canton">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Género</label> 
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    $no_spaces = str_replace(' ', '', $bindArray[":genero"]);
                                    echo 'value="'.$no_spaces.'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="genero" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Fecha Nacimiento</label> 
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":fecha_nacimiento"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="fechaNacimiento" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Fecha Ingreso</label> 
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":fecha_ingreso"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="fechaIngreso" required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Salario</label> 
                            <input type="text"
                            <?php
                                if ($_GET['id'] !=null)
                                {
                                    echo 'value="'.$bindArray[":salario"].'"';
                                }
                                else
                                {
                                    echo 'value=""';
                                }
                            ?> 
                                class="form-control"
                                name="salario" required="required">
                        </fieldset>
                        <button type="submit" name="btnGuardar" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            $("#pais").change(function(){
                if($(this).val() == 0){
                    $("#otro_pais").show();
                }else{
                    $("#otro_pais").hide();
                }
                var pais = $("#pais").val();
                $.post("provincias.php", { pais: pais}, 
                function(data){
                    $("#provincia").html( data );
                    $("#provincia").removeAttr("disabled");
                });

            });
            $("#canton").change(function(){
                if($(this).val() == 0){
                    $("#otro_canton").show();
                }else{
                    $("#otro_canton").hide();
                }

            });
            $("#provincia").change(function(){
                if($(this).val() == 0){
                    $("#otra_provincia").show();
                }else{
                    $("#otra_provincia").hide();
                }
                var provincia = $("#provincia").val();
                $.post("cantones.php", { provincia: provincia}, 
                function(data){
                    $("#canton").html( data );
                    $("#canton").removeAttr("disabled");
                });

            });
            
     
        </script>
    </body>
</html>

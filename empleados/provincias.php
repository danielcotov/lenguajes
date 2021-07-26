<?php
    include '../resources/conexionBD.php';
    $sqlProv = "BEGIN LISTAR_PROVINCIAS(:cur,:pais); END;";
    $parseProv = oci_parse($conn, $sqlProv);
    $cur = oci_new_cursor($conn);

    oci_bind_by_name($parseProv, ':cur', $cur, -1, OCI_B_CURSOR);
    oci_bind_by_name($parseProv, ':pais', $pais, 32);
    $pais = $_POST['pais'];
    oci_execute($parseProv);
    oci_execute($cur);
    oci_free_statement($parseProv);
    if ($_GET['id'] !=null)
    {
        echo '<option value="'.$bindArray[":provincia"].'">'.$bindArray[":provincia"].'</option>';
        echo '<script>$("#provincia").removeAttr("disabled");</script>';
    }
    else
    {
        echo '<option value="default">Seleccione una provincia</option>';
    }
    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
    {
        if ($bindArray[":provincia"]!=$row["NOMBRE"])
        {
            echo '<option value="'.$row["NOMBRE"].'">'.$row["NOMBRE"].'</option>';
        }
    }
    echo '<option value="0">Otro...</option>';
                              
?>
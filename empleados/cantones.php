<?php
    include '../resources/conexionBD.php';
    $sqlCanton = "BEGIN LISTAR_CANTONES(:cur,:provincia); END;";
    $parseCanton = oci_parse($conn, $sqlCanton);
    $cur = oci_new_cursor($conn);
    oci_bind_by_name($parseCanton, ':cur', $cur, -1, OCI_B_CURSOR);
    oci_bind_by_name($parseCanton, ':provincia', $provincia, 32);
    echo $_POST['provincia'];
    $provincia = $_POST['provincia'];
    oci_execute($parseCanton);
    oci_execute($cur);
    oci_free_statement($parseCanton);
    if ($_GET['id'] !=null)
    {
        echo '<option value="'.$bindArray[":canton"].'">'.$bindArray[":canton"].'</option>';
        echo '<script>$("#canton").removeAttr("disabled");</script>';
    }
    else
    {
        echo '<option value="default">Seleccione un cantón</option>';
    }
    
    while (($row = oci_fetch_array($cur, OCI_ASSOC)) != false)  
    {
        if (($bindArray[":canton"]!=$row["NOMBRE"]))
        {
            echo '<option value="'.$row["NOMBRE"].'">'.$row["NOMBRE"].'</option>';
        }
    }
    echo '<option value="0">Otro...</option>';
                              
?>
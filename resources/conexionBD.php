<?php
 
    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;
    $conn = OCILogon("gadafa", "GADAFA", $db) or die;
    $sql = "ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'";
    $parse = oci_parse($conn, $sql);
    oci_execute($parse);
    oci_free_statement($parse);
?>
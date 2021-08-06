<?php
 
    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localwin)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;
    $conn = OCILogon("gadafa", "gadafa", $db) or die;
    $sql = "ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'";
    $parse = oci_parse($conn, $sql);
    oci_execute($parse);
    oci_free_statement($parse);

?>
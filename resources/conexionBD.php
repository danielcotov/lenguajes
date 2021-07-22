<?php
 
    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;
    $conn = OCILogon("gadafa", "gadafa", $db) or die;

    function CloseCon($conn)
    {
        OCILogoff($conn);
    }
?>
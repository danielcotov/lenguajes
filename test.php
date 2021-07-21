<?php
 
 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;
 
 if($c = OCILogon("gadafa", "gadafa", $db))
 {
 echo "Conexión a la base de datos exitosa.\n";
 OCILogoff($c);
 }
 else
 {
 $err = OCIError();
 echo "Conexión fallida." . $err[text];
 }
 
?>
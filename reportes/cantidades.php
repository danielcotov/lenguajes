<?php
$sqlClientes = "SELECT CANTIDAD_CLIENTES FROM DUAL";
$parseClientes = oci_parse($conn, $sqlClientes);
oci_execute($parseClientes);

$sqlEmpleados = "SELECT CANTIDAD_EMPLEADOS FROM DUAL";
$parseEmpleados = oci_parse($conn, $sqlEmpleados);
oci_execute($parseEmpleados);

$sqlProductos = "SELECT CANTIDAD_PRODUCTOS FROM DUAL";
$parseProductos = oci_parse($conn, $sqlProductos);
oci_execute($parseProductos);

$sqlVentas = "SELECT CANTIDAD_VENTAS FROM DUAL";
$parseVentas = oci_parse($conn, $sqlVentas);
oci_execute($parseVentas);
?>

<div class=row>
    <div class="col-md-3">
        <div class="box_dashboard">
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 20px;">Cantidad de Clientes</h3>
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px; font-weight: bold">
                <?php
                $row = oci_fetch_object($parseClientes);
                $row->CANTIDAD_CLIENTES;
                echo $row->CANTIDAD_CLIENTES . "<br>\n";
                ?>
            </h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box_dashboard">
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 20px;">Cantidad de Empleados</h3>
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px; font-weight: bold">
                <?php
                $row = oci_fetch_object($parseEmpleados);
                $row->CANTIDAD_EMPLEADOS;
                echo $row->CANTIDAD_EMPLEADOS . "<br>\n";
                ?>
            </h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box_dashboard">
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 20px;">Cantidad de Productos</h3>
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px; font-weight: bold">
                <?php
                $row = oci_fetch_object($parseProductos);
                $row->CANTIDAD_PRODUCTOS;
                echo $row->CANTIDAD_PRODUCTOS . "<br>\n";
                ?>
            </h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box_dashboard">
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 20px;">Cantidad de Ventas</h3>
            <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px; font-weight: bold">
                <?php
                $row = oci_fetch_object($parseVentas);
                $row->CANTIDAD_VENTAS;
                echo $row->CANTIDAD_VENTAS . "<br>\n";
                ?>
            </h3>
        </div>
    </div>
</div>


<!--<table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cantidad Total de Clientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = oci_fetch_object($parseClientes);
                            $row->CANTIDAD_CLIENTES;
                            echo '<tr>';
                            echo '<td>' . $row->CANTIDAD_CLIENTES . "<br>\n";
                            echo '</tr>';
                            ?>
                        </tbody>
                    </table>-->
<br>
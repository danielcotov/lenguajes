<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Gualmarsh</title>
    <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/styles/styles.css">
    <link rel="stylesheet" href="resources/css/font.css">
    
</head>

<body>  
    <div id="mySidenav" class="sidenav">
        <div class="p-4">
            <img src="resources/images/logo.png" width="275" height="65" alt="Logo"/> 
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="index.php"><span class="fa fa-home mr-3"></span> Inicio</a>
                    </li>
                    <li>
                        <a href="empleados/lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                    </li>
                    <li>
                        <a href="productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                    </li>
                    <li>
                        <a href="clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                    </li>
                    <li>
                        <a href="reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Reportes</a>
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
    <div id="main">
        <div class="container" style="margin-top: 10%">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="containericon" style="margin-right: 50%">
                                <img src="resources/images/employee.png" alt="Employee" class="image"/>
                                <div class="middle"  style="top: 115%; left: 50%;">
                                    <div> 
                                        <a href="empleados/lista.php" class="btn btn-success big-btn" style="font-size: 2rem">Empleados</a>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="containericon">
                                <img src="resources/images/customer.png" alt="Employee" class="image" style="vertical-align: middle"/>
                                <div class="middle" style="top: 115%; left: 50%;">
                                    <div> 
                                        <a href="empleados/lista.php" class="btn btn-success big-btn" style="font-size: 2rem">Clientes</a>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="containericon">
                                <img src="resources/images/product.png" alt="Employee" class="image"/>
                                <div class="middle" style="  top: 115%; left: 50%;">
                                    <div> 
                                        <a href="empleados/lista.php" class="btn btn-success big-btn" style="font-size: 2rem">Productos</a>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="containericon">
                                <img src="resources/images/report.png" alt="Employee" class="image"/>
                                <div class="middle" style="top: 115%; left: 50%;">
                                    <div> 
                                        <a href="empleados/lista.php" class="btn btn-success big-btn" style="font-size: 2rem">Admin</a>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>
</html>
<!--Backup code-->
    <!--<div class="wrapper d-flex align-items-stretch" style="font-family: 'Bogle';">
        <nav id="sidebar">
            <div class="custom-menu">
            </div>
            <div class="p-4">
                <img src="resources/images/logo.png" width="275" height="65" alt="Logo"/> 
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="index.php"><span class="fa fa-home mr-3"></span> Inicio</a>
                    </li>
                    <li>
                        <a href="empleados/lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                    </li>
                    <li>
                        <a href="productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                    </li>
                    <li>
                        <a href="clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                    </li>
                    <li>
                        <a href="reportes/lista.php"><span class="fa fa-file-text mr-3"></span> Reportes</a>
                    </li>
                </ul>
                <div class="footer">
                    <p>GADAFA &copy;
                        <script>document.write(new Date().getFullYear());</script>
                    </p>
                </div>
            </div>
        </nav>
    </div>-->
        <!--<div class="containericon" id = "customer-container" style="top: 100px; left: 750px">
                    <img src="resources/images/customer.png" alt="Customer" class="image" style="top: 100px; left: 750px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="clientes/lista.php" class="btn btn-success">Clientes</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 100px; left: 1100px">
                    <img src="resources/images/product.png" alt="Product" class="image" style="top: 100px; left: 1100px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="productos/lista.php" class="btn btn-success">Productos</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 100px; left: 1450px">
                    <img src="resources/images/report.png" alt="Sale" class="image" style="top: 100px; left: 1450px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="reportes/lista.php" class="btn btn-success">Reportes</a>
                        </div>                       
                    </div>
                </div>-->

<?php

    include 'conexionBD.php';
    $abrirCon = OpenCon();

    if(isset($_POST['btnConsultar']))
    {
        $queryVentas = "call ConsultarVentas()";
        $listaVentas = $abrirCon -> query($queryVentas);
    }

    
    
    CloseCon($abrirCon);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gualmarsh</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/estilosSitio.css" rel="stylesheet">
  <link rel="stylesheet" href="resources/styles/styles.css">
  
  

</head>

<body>
<form action="" method="post">
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Lenguajes de Base de Datos</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action bg-light">Inicio</a>
                <a href="compra.php" class="list-group-item list-group-item-action bg-light">Empleados</a>
                <a href="compra.php" class="list-group-item list-group-item-action bg-light">Productos</a>
                <a href="compra.php" class="list-group-item list-group-item-action bg-light">Clientes</a>
                <a href="compra.php" class="list-group-item list-group-item-action bg-light">Reportes</a>
            </div>
        </div>
    
    <div id="page-content-wrapper">
        <div class="header" style="background-color: #0071CE">
            <div class="container">
               <div class="header_logo">
                    <img src="resources/imgs/logo/Logo.png" class="center" id="logo" alt>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="categories_item">
                                <div class="categories_item_thumb">
                                    <div class="categories_overlay">
                                        <img src="resources/imgs/employee.png" alt="Employee" style="margin-left: 15%; height: 50%; width: 50%">
                                        <div class="d-flex justify-content-center" style="margin-left: -15%; margin-top: 2.5%">
                                            <a href="<%=request.getContextPath()%>/employees" class="btn btn-success" style="color: #fff; background-color: #FFC220; border-color: #FFC220;">Empleados</a>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="categories_item">
                                <div class="categories_item_thumb">
                                    <div class="categories_overlay">
                                        <img src="resources/imgs/customer.png" alt="Customer" style="margin-left: 15%; height: 50%; width: 50%">
                                        <div class="d-flex justify-content-center" style="margin-left: -15%; margin-top: 2.5%">
                                            <a href="<%=request.getContextPath()%>/employees" class="btn btn-success" style="color: #fff; background-color: #FFC220; border-color: #FFC220;">Clientes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="categories_item">
                                <div class="categories_item_thumb">
                                    <div class="categories_overlay">
                                        <img src="resources/imgs/employee.png" alt="Employee" style="margin-left: 15%; height: 50%; width: 50%">
                                        <div class="d-flex justify-content-center" style="margin-left: -15%; margin-top: 2.5%">
                                            <a href="<%=request.getContextPath()%>/employees" class="btn btn-success" style="color: #fff; background-color: #FFC220; border-color: #FFC220;">Empleados</a>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="categories_item">
                                <div class="categories_item_thumb">
                                    <div class="categories_overlay">
                                        <img src="resources/imgs/customer.png" alt="Customer" style="margin-left: 15%; height: 50%; width: 50%">
                                        <div class="d-flex justify-content-center" style="margin-left: -15%; margin-top: 2.5%">
                                            <a href="<%=request.getContextPath()%>/employees" class="btn btn-success" style="color: #fff; background-color: #FFC220; border-color: #FFC220;">Clientes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="p-4 p-md-5 pt-5">
                <div class="containericon" style="top: 100px; left: 400px">
                    <img src="employeeicon" alt="Employee" class="image" style="top: 100px; left: 400px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/employees" class="btn btn-success">Employees</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 100px; left: 750px">
                    <img src="customericon" alt="Customer" class="image" style="top: 100px; left: 750px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/customers" class="btn btn-success">Customers</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 100px; left: 1100px">
                    <img src="producticon" alt="Product" class="image" style="top: 100px; left: 1100px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/products" class="btn btn-success">Products</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 100px; left: 1450px">
                    <img src="saleicon" alt="Sale" class="image" style="top: 100px; left: 1450px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/sale" class="btn btn-success">Sale</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 500px; left: 400px">
                    <img src="reporticon" alt="Report" class="image" style="top: 500px; left: 400px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/report-list" class="btn btn-success">Reports</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 500px; left: 750px">
                    <img src="profileicon" alt="Profile" class="image" style="top: 500px; left: 750px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/profile" class="btn btn-success">Profile</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 500px; left: 1100px">
                    <img src="graphicon" alt="Charts" class="image" style="top: 500px; left: 1100px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/charts" class="btn btn-success">Charts</a>
                        </div>                       
                    </div>
                </div>
                <div class="containericon" style="top: 500px; left: 1450px">
                    <img src="logouticon" alt="Logout" class="image" style="top: 500px; left: 1450px; width: 100%;"/>
                    <div class="middle" style="  top: 115%; left: 50%;">
                        <div> 
                            <a href="<%=request.getContextPath()%>/login" class="btn btn-success">Logout</a>
                        </div>                       
                    </div>
                </div>
            </div>  
    </div>
    </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/funcionesSitio.js"></script>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

  </script>
</form>
</body>

</html>

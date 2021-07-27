    <!DOCTYPE html>
    <html>

    <head>
        <title>Gualmarsh / Reports</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/font.css">
    </head>

    <body>
        <div class="wrapper d-flex align-items-stretch" style="font-family: 'Bogle';">
            <nav id="sidebar">
                <div class="custom-menu">
                </div>
                <div class="p-4">
                    <img src="../resources/images/logo.png" width="275" height="65" alt="Logo" />
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a href="../index.php"><span class="fa fa-home mr-3"></span> Inicio</a>
                        </li>
                        <li>
                            <a href="../empleados/lista.php"><span class="fa fa-bar-chart mr-3"></span> Empleados</a>
                        </li>
                        <li>
                            <a href="../productos/lista.php"><span class="fa fa-shopping-cart mr-3"></span> Productos</a>
                        </li>
                        <li>
                            <a href="../clientes/lista.php"><span class="fa fa-users mr-3"></span> Clientes</a>
                        </li>
                        <li class="active">
                            <a href="lista.php"><span class="fa fa-file-text mr-3"></span> Reportes</a>
                        </li>
                    </ul>
                    <div class="footer">
                        <p>GADAFA &copy;
                            <script>document.write(new Date().getFullYear());</script>
                        </p>
                    </div>

                </div>
            </nav>
            <div id="content" class="p-4 p-md-5 pt-5">
                <div class="row">
                    <div class="container">
                        <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Reportes</h3>
                        <hr style="height: 5px; background-color: #007DC6;">
                    </div>
                </div>
                <div id="content" class="p-4 p-md-5 pt-5">
                    <div class="containerreporticon" style="top: 150px; left: 350px">
                        <a href="<%=request.getContextPath()%>/Product-Report">
                            <img src="../resources/images/productsreport.png" alt="Product Report" class="imagereports"
                                style="top: 150px; left: 350px; width: 100%;" />
                        </a>
                    </div>
                </div>
                <div id="content" class="p-4 p-md-5 pt-5">
                    <div class="containerreporticon" style="top: 150px; left: 860px">
                        <a href="<%=request.getContextPath()%>/Employee-Report">
                            <img src="../resources/images/employeereport.png" alt="Employee Report" class="imagereports"
                                style="top: 150px; left: 860px; width: 100%;" />
                        </a>
                    </div>
                </div>
                <div id="content" class="p-4 p-md-5 pt-5">
                    <div class="containerreporticon" style="top: 150px; left: 1370px">
                        <a href="<%=request.getContextPath()%>/Customer-Report">
                            <img src="../resources/images/customerreport.png" alt="Customer Report" class="imagereports"
                                style="top: 150px; left: 1370px; width: 100%;" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
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
        <div class="header" style="background-color: #0071CE">
            <div class="container">
               <div class="header_logo">
                    <img src="resources/imgs/logo/Logo.png" class="center" id="logo" alt>
                </div>
            </div>
        </div>
        <br>
        <div class="container col-md-5" style="font-family: 'Bogle';">
            <div class="card">
                <div class="card-body">
                    <form action="<%=request.getContextPath()%>/login" method="post">
                        <fieldset class="form-group">
                            <label>Username</label>
                            <input type="text"
                                   class="form-control"
                                   name="username" 
                                   required="required">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Password</label>
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   required="required">
                        </fieldset>
                        <button type="submit" class="btn btn-success" style="background-color: #FFC223; border: #FFC223; color: black">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/funcionesSitio.js"></script>

</form>
</body>

</html>

<?php 
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>LOGIN SIGLA V.1</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <link href="assets/css/custom.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="assets/js/funcionesjs.js"></script>
        <script src="assets/js/jquery-1.10.2.js"></script>   
        <script src="assets/js/bootstrap.min.js"></script> 
        <script src="assets/js/jquery.metisMenu.js"></script>
        <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
        <script src="assets/js/morris/morris.js"></script>
        <script src="assets/js/custom.js"></script>
	</head>
	<body>
<!--login modal-->
        <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="alert alert-info" align="center"><strong>SIGLA V.1 </strong></div><br>
                <form name="form1" method="post" action="" onkeypress="" class="form col-md-12 center-block">
                    <div class="modal-dialog">
                        <div class="modal-content">     
                        <div class="modal-body">         
                        <center><img src="img/empresa.png" width="100" height="150"></center><br>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="Email" id="Email" class="form-control input-lg" placeholder="Email" autocomplete="off" required autofocus>
                        </div>
                        <br>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="Clave" id="Clave" class="form-control input-lg" placeholder="Password" autocomplete="off" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <div align="right">
                                <button class="btn btn-primary btn-lg btn-block" type="button" onclick="login()"><i class="glyphicon glyphicon-log-in"></i> <strong>Conectar</strong></button>
                            </div>
                        </div>	
                </form>
            </div> 
        </div>
            <br>
            <div id="msg" class="alert alert-warning"> <div>
            <div class="alert alert-warning" align="center">
                <strong>Usuario: admin - Password: admin </strong>
            </div>
        </div>	
	</body>
</html>
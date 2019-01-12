<?php 
    session_start();
    if($_SESSION['autentic']){
        
    }else{
        header('Location:../../php_cerrar.php');
    }
	 include_once "../funciones.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" charset="utf-8"/>
    <title>Sigla V.1</title>	
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />    
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />    
    <link href="../../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="../../assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php echo $_SESSION['nombre']; ?></a> 
            </div>
            <div style="color: white; -->
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 12px;">
                <?php echo fecha(date('Y-m-d')); ?> &nbsp; <a href="../../php_cerrar.php" class="btn btn-danger square-btn-adjust">salir</a>
            </div>
        </nav>   
           <?php include_once "../../menu/m_principal.php"; ?>
        <div id="page-wrapper" >
            <div id="page-inner">               
                 <div class="row">
			  <div class="col-md-3 col-sm-6 col-xs-6">           
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
		     </div>
			 <div class="col-md-3 col-sm-6 col-xs-6">           
		     </div> 
			</div>
                 <!-- /. ROW  -->                                
                <hr />                
                </div>
                 <!-- /. ROW  -->                                
         
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
     <script src="../../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../../assets/js/morris/morris.js"></script>
    <script src="../../assets/js/custom.js"></script>
</body>
</html>

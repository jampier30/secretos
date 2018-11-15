<?php
    date_default_timezone_set("America/Bogota");
    $fecha=fecha(date('Y-m-d'));
    $fechadatetimepicker=date('Y-m-d');
?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php echo $_SESSION['nombre']; ?>
            </div>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;"><label id="fecha"><?php echo $fecha; ?></label>&nbsp; <a href="../../php_cerrar.php" class="btn btn-danger square-btn-adjust">Salir</a> </div>
        </nav>
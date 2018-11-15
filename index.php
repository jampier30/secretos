<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");
require_once("modulos/conn_BD.php");

if(isset($_GET['view'])) {
  if(file_exists('modulos/' . strtolower($_GET['view']) . '.php')) {
    include('modulos/' . strtolower($_GET['view']) . '.php');
  } else {
    include('vista/error404.php');
  }
} else {
  include('vista/indexvista.php');
}
?>
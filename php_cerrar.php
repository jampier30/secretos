<?php
session_start();
  unset($_SESSION['autentic']); 
  unset($_SESSION['id']);
  unset($_SESSION['email']);
  unset($_SESSION['estado']);
  unset($_SESSION['nombre']);
  session_destroy();
//$usuarios->close;
header("Location:/Secretos");
?>
<?php 

session_start();
ob_start();

unset($_SESSION['id'],$_SESSION['usuario']);
$_SESSION['msg'] = "<p style='color: green;'>Deslogado com sucesso</p>";
header("Location: index.php");
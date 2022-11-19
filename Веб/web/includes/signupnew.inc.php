<?php 
require_once 'function.inc.php';
require_once 'dbpdoconnection.inc.php';
createUser($pdo, $_GET['login'], $_GET['email'], password_hash($_GET['pwd'], PASSWORD_DEFAULT));
//createUser($pdo, $_GET['email'],$_GET['pwd']);
?>
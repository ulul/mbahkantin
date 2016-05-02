<?php 
session_start();
session_unset($_SESSION['ID_USER']);
session_destroy();

header("location:index.php");
?>
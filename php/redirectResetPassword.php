<?php
session_start();
$_SESSION["RegState"] = 3;
header("location:../index.php");
exit();
?>

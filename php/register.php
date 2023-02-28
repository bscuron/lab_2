<?php
session_start();
require_once("config.php");

// Get web data
$firstname = $_POST["registerFirstname"];
$lastname = $_POST["registerLastname"];
$email = $_POST["registerEmail"];
print "Webdata ($firstname) ($lastname) ($email) <br>";
?>

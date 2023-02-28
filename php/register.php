<?php
session_start();
require_once("config.php");

// Get web data
$firstname = $_POST["registerFirstname"];
$lastname = $_POST["registerLastname"];
$email = $_POST["registerEmail"];
print "Webdata ($firstname) ($lastname) ($email) <br>";

// Connect to db
$con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

// Check db connection
if (!con) {
    $_SESSION["Message"] = "Database connection failed: " . mysqli_error($con);
    $_SESSION["RegState"] = 1;
    header("location:../index.php");
    exit();
}
print "Database connected <br>";

// Generate authentication code
$acode = rand(100000, 999999);

// Create registration datetime
$rdatetime = date("Y-m-d h:s:i");

// Query db (hackable)
$query = "INSERT INTO Users2 (FirstName, LastName, Email, Acode, Rdatetime) " .
         "VALUES ('$firstname', '$lastname', '$email', '$acode', '$rdatetime')";
$result = mysqli_query($con, $query);

// Check query result
if (!$result) {
    $_SESSION["Message"] = "Database insert query failed: " . mysqli_error($con);
    $_SESSION["RegState"] = 1;
    header("location:../index.php");
    exit();
}
print "Database updated <br>";

exit();
?>

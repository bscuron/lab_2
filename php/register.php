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
print "Database updated. Ready to send email. <br>";

// Send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
echo "here";

// Build the PHPMailer object:
$mail= new PHPMailer(true);
try {
    $mail->SMTPDebug = 2; // Wants to see all errors
    $mail->IsSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->SMTPAuth=true;
    $mail->Username="ben.scuron.4398@gmail.com";
    $mail->Password = "qzchkavzpopwlwhm";
    $mail->SMTPSecure = "ssl";
    $mail->Port=465;
    $mail->SMTPKeepAlive = true;
    $mail->Mailer = "smtp";
    $mail->setFrom("ben.scuron@temple.edu", "Ben Scuron");
    $mail->addReplyTo("ben.scuron@temple.edu","Ben Scuron");
    $msg = "Welcome to my project. Your authentication code is: $acode";
    $mail->addAddress($email, "$firstname $lastname");
    $mail->Subject = "CIS 4398 Project - Authentication Code";
    $mail->Body = $msg;
    $mail->send();
    $_SESSION["RegState"] = 2;  // Your view index
    $_SESSION["Message"] = "Email sent ($email)."; // Your man-machine dialog context
    print "Email sent ($email)... <br>";
} catch (phpmailerException $e) {
    $_SESSION["Message"] = "Mailer error: " . $e->errorMessage();
    $_SESSION["RegState"] = 1; // Your view index
    print "Mail send failed: " . $e->errorMessage;
}
header("location:../index.php"); // Redirection to landing page

exit();
?>

<?php
include 'config.php';
require "common.php";
if(!isset($_SESSION))
    {
        session_start();
    }

$conn = openCon();

if (isset($_POST['submit'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['emailAdress'];
    $phone = $_POST['phoneNumber'];
    $message = $_POST['message'];
    $date1 = strtotime($_POST["date"]);
    $date1 = date('Y-m-d', $date1);
    $appTime = $_POST['time'];

    $sql = "INSERT INTO test
                  (firstName, lastName, mail, phoneNumber, msG, appDate, appTime)
                  VALUES ('$firstName', '$lastName', '$email', '$phone', '$message', '$date1', '$appTime')";
    $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($conn);
    }
}
//if (isset($_POST['submit'])) {
    //$sql = "INSERT INTO test(firstName, lastName, mail, phoneNumber, appDate, appTime, msG) VALUES('$firstName', '$lastName', '$email', '$phone', '$date', '$time', '$message')";
    //require_once 'mailer.php';
    //if (!mysqli_query($conn, $sql)) {
     //   echo "Error, could not execute" . mysqli_error($conn);
//}}
?>
<html>
<script type="text/javascript">
//window.location = "https://your-secondhand.com/";
</script>
</html>
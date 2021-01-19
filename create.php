<?php
include 'config.php';
require "common.php";

//Checks if there is a session, if not, starts one.
if (!isset($_SESSION)) {
    session_start();
}

//Opens connection to database
$conn = openCon();

//Checks if there is data submitted, starts the updating process.
if (isset($_POST['submit'])) {

    //Checks if there is no errors (form validation).
    if (empty($errors)) {

        //Makes a new array with the posted information.
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['emailAdress'];
        $phone = $_POST['phoneNumber'];
        $message = $_POST['message'];
        $date1 = strtotime($_POST["date"]);
        $date1 = date('Y-m-d', $date1);
        $appTime = $_POST['time'];

        //Adds array to database.
        $sql = "INSERT INTO test
                  (firstName, lastName, mail, phoneNumber, msG, appDate, appTime)
                  VALUES ('$firstName', '$lastName', '$email', '$phone', '$message', '$date1', '$appTime')";
        $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

        //Sends you back to index after putting values into database.
        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($conn);
        }
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
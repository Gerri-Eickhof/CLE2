<?php
include 'includes/config.php';
require "includes/common.php";
require_once "php-mailer.php";
//Checks if there is a session, if not, starts one.
if (!isset($_SESSION)) {
    session_start();
}

//Opens connection to database
$conn = openCon();

// BB gesprek

//Checks if there is data submitted, starts the updating process.
if (isset($_POST['submit'])) {

    //Checks if there is no errors (form validation).
    if (empty($errors)) {

        //Makes a new array with the posted information.
        $firstName = htmlspecialchars($_POST['firstName']);
        $firstName = mysqli_escape_string($conn, trim($firstName));
        $lastName = htmlspecialchars($_POST['lastName']);
        $lastname = mysqli_real_escape_string($conn, trim($lastName));
        $email = htmlspecialchars($_POST['emailAdress']);
        $email = mysqli_real_escape_string($conn, trim($email));
        $phone = htmlspecialchars($_POST['phoneNumber']);
        $phone = mysqli_real_escape_string($conn, trim($phone));
        $message = htmlspecialchars($_POST['message']);
        $message = mysqli_real_escape_string($conn, trim($message));
        $date1 = htmlspecialchars($_POST['date']);
        $date1 = mysqli_real_escape_string($conn, trim($date1));
        $date1 = strtotime($date1);
        $date1 = date('Y-m-d', $date1);
        $appTime = htmlspecialchars($_POST['time']);
        $time = mysqli_real_escape_string($conn, trim($appTime));

        //Adds array to database.
        $sql = "INSERT INTO test
                  (firstName, lastName, mail, phoneNumber, msG, appDate, appTime)
                  VALUES ('$firstName', '$lastName', '$email', '$phone', '$message', '$date1', '$appTime')";
        $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));
        sentMail();

        //Sends you back to index after putting values into database.
        if ($result) {
            //header('Location: index.php');
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
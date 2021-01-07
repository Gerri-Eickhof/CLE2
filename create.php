<?php
include 'config.php';
require "common.php";
$conn = new PDO($dsn, "$dataUser", "$dataPass", $options);

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

$new_app = array(
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "mail" => $_POST['emailAdress'],
        "phoneNumber" => $_POST['phoneNumber'],
        "appDate" => $_POST['date'],
        "appTime" =>$_POST['time'],
        "msG" => $_POST['message'],
);

$sql = sprintf(
    "INSERT INTO %s (%s) values (%s)",
    "test",
    implode(", ", array_keys($new_app)),
    ":" . implode(", :", array_keys($new_app))
);

$statement = $conn->prepare($sql);
$statement->execute($new_app);

if (isset($_POST['submit']) && $statement){
echo escape($_POST['firstName']) . " successfully added.";
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
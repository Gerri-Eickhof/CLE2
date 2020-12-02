<?php
include 'Swebtite.php';
$conn = OpenCon();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['emailAdress'];
$phone = $_POST['phoneNumber'];
$date = $_POST['date'];
$time = $_POST['time'];

if (isset($_POST['submit'])) {
    $sql = "INSERT INTO test(firstName, lastName, mail, phoneNumber, appDate, appTime) VALUES('$firstName', '$lastName', '$email', '$phone', '$date', '$time')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error, could not execute" . mysqli_error($conn);
}}
?>
<html>
<script type="text/javascript">
window.location = "https://your-secondhand.com/";
</script>
</html>
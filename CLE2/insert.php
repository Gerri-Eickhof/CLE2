<?php
include 'Swebtite.php';
$conn = OpenCon();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
if (isset($_POST['submit'])) {
    echo 'deez nuts';
    $sql = "INSERT INTO test(firstName, lastName, mail) VALUES('$firstName', '$lastName', '$email')";
    if (mysqli_query($conn, $sql)) {
        echo "Records added succesfully";
    } else {
        echo "Error, could not execute" . mysqli_error($conn);
    }
}
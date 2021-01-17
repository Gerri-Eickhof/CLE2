<?php
if(!isset($_SESSION))
{
    session_start();
}

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    exit;
}

    require "config.php";
    require "common.php";

    if (isset($_POST['submit'])) {
        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

    $conn = openCon();

    $sql = "SELECT * FROM test";
    $result = mysqli_query($conn, $sql)
    or die ('Error: ' . $sql );

    $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>update-page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h2>Update users</h2>
<form>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Phone Number</th>
        <th>Message</th>
        <th>Date</th>
        <th>Time</th>
        <th>Edit Appointment</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["firstName"]); ?></td>
            <td><?php echo escape($row["lastName"]); ?></td>
            <td><?php echo escape($row["mail"]); ?></td>
            <td><?php echo escape($row["phoneNumber"]); ?></td>
            <td><?php echo escape($row["msG"]); ?> </td>
            <td><?php echo escape($row["appDate"]); ?> </td>
            <td><?php echo escape($row["appTime"]); ?> </td>
            <td><a href="edit.php?id=<?= $row['id']; ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</form>
<a href="index.php">Back to home</a>
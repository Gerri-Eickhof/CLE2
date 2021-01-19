<?php
//Starts session
if (!isset($_SESSION)) {
    session_start();
}

//Checks if user is logged in
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    exit;
}

require "config.php";
require "common.php";

//Checks if CSRF key is set
if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
}
//Opens connection to database
$conn = openCon();
//Selects all entries from database.
$sql = "SELECT * FROM test";
$result = mysqli_query($conn, $sql)
or die ('Error: ' . $sql);

$result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>update-page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h2 class="centerhead">Update users</h2><br><br>
<form>
    <div class="tablediv">
    <table class="container">
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
    </div>
</form>
<footer class="updelete">
    <li class="site-footer__linklist-item h6">
        <?php if (isset($_SESSION['loggedInUser'])) : ?>
            <a href="index.php"><strong>HOME</strong></a>
        <?php endif; ?>
    </li>
    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/search"><strong>SEARCH</strong></a>
    </li>

    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/pages/about"><strong>ABOUT US</strong></a>
    </li>

    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/pages/return-of-items"><strong>RETURN OF ITEMS</strong></a>
    </li>

    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/blogs/nieuws"><strong>NEWS</strong></a>
    </li>
    <li class="site-footer__linklist-item h6">
        <?php if (isset($_SESSION['loggedInUser'])) : ?>
            <a href="delete.php"><strong>DELETE APPOINTMENTS</strong></a>
        <?php endif; ?>
    </li>
    <li class="site-footer__linklist-item h6">
        <?php if (isset($_SESSION['loggedInUser'])) : ?>
            <a href="logout.php"><strong>LOGOUT</strong></a>
        <?php endif; ?>
    </li>
</footer>
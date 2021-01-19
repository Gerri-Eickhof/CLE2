<?php
//Starts new session
session_start();

require "config.php";
require "common.php";

//Checks if user is logged in, if not, sends back to index.
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    exit;
}
//Opens connection to database
$conn = openCon();

//Checks if ID is set, then deletes entry from Database.
if (isset($_GET["id"])) {
    try {
        $id = $_GET['id'];
        $sql = "DELETE FROM test WHERE id = " . mysqli_escape_string($conn, $id);

        $statement = $conn->prepare($sql);;
        $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

    } catch (mysqli_sql_exception $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

//Selects everything in database for display in HTML
try {
    $conn = openCon();

    $sql = "SELECT * FROM test";
    $result = mysqli_query($conn, $sql)
    or die ('Error: ' . $sql);

    $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

} catch (mysqli_sql_exception $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>delete-page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h2 class="centerhead">Delete users</h2><br><br>

<div class="tablediv">
<table class="container">
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>E-Mail</th>
        <th>Phone Number</th>
        <th>Message</th>
        <th>Delete Appointment</th>
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
            <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
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
            <a href="update.php"><strong>UPDATE APPOINTMENTS</strong></a>
        <?php endif; ?>
    </li>
    <li class="site-footer__linklist-item h6">
        <?php if (isset($_SESSION['loggedInUser'])) : ?>
            <a href="logout.php"><strong>LOGOUT</strong></a>
        <?php endif; ?>
    </li>
</footer>
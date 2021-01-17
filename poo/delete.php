<?php
session_start();
    require "config.php";
    require "common.php";

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    exit;
}

    if (isset($_POST['submit'])) {

        $conn = openCon();

        if (isset($_GET["id"])) {
            try {
                $id = $_GET['id'];
                $sql = "DELETE FROM test WHERE id = " . mysqli_escape_string($conn, $id);

                $statement = $conn->prepare($sql);
                $result = mysqli_query($conn, $sql)
                or die ('Error: ' . $sql);

                $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));
            } catch (mysqli_sql_exception $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }

        try {
            $conn = openCon();

            $sql = "SELECT * FROM test";
            $result = mysqli_query($conn, $sql)
            or die ('Error: ' . $sql);

            $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));

        } catch (mysqli_sql_exception $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>delete-page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h2>Update users</h2>

<table>
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

<a href="index.php">Back to home</a>
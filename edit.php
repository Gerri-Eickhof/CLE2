<?php
/**
 * @var mysqli $db
 */

//Starts session
session_start();

//Checks if user logged in, else sends back to index
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    exit;
}

require "config.php";

//Opens connection to DB
$conn = openCon();

//Checks if submitted data is available, starts edit process.
if (isset($_POST['submit'])) {
    $id = mysqli_escape_string($conn, $_POST['id']);
    $firstName = mysqli_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_escape_string($conn, $_POST['lastName']);
    $mail = mysqli_escape_string($conn, $_POST['mail']);
    $phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
    $message = mysqli_escape_string($conn, $_POST['msG']);
    $appDate = mysqli_escape_string($conn, $_POST['appDate']);
    $appTime = mysqli_escape_string($conn, $_POST['appTime']);
    $appDate = strtotime($_POST['date']);
    $appDate = date('Y-m-d', $appDate);

    //Make array so the form won't break.
    $appointment = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'mail' => $mail,
        'phoneNumber' => $phoneNumber,
        'msG' => $message,
        'appDate' => $appDate,
        'appTime' => $appTime
    ];

    //Updates old values with new set values.
    $sql = "UPDATE test 
            SET firstName = '$firstName', lastName = '$lastName', mail = '$mail', phoneNumber = '$phoneNumber', msG = '$message', appDate = '$appDate', appTime = '$appTime'
            WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location:index.php');
        exit();
    } else {
        $errors[] = 'Something went wrong : ' . mysqli_error($conn);
    }

    //Checks if ID is set, retrieves entry info with ID number.
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM test WHERE id = " . mysqli_escape_string($conn, $id);
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $app = mysqli_fetch_assoc($result);
    } else {
        header('Location:index.php');
        exit();
    }
}

//Close connection
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Edit Appointment</h1>

<form action="" method="post" enctype="multipart/form-data">
    <label for="artist">Artiest</label>
    <div class="data-field">
        <label for="firstName">First Name</label>
        <input id="firstName" type="text" name="firstName" value="<?= htmlentities($app['firstName']); ?>"/>
    </div>
    <div class="data-field">
        <label for="lastName">Last Name</label>
        <input id="lastName" type="text" name="lastName" value="<?= htmlentities($app['lastName']); ?>"/>
    </div>
    <div class="data-field">
        <label for="mail">E-Mail</label>
        <input id="mail" type="text" name="mail" value="<?= htmlentities($app['mail']); ?>"/>
    </div>
    <div class="data-field">
        <label for="phone">Phone Number</label>
        <input id="phoneNumber" type="text" name="phoneNumber" value="<?= htmlentities($app['phoneNumber']); ?>"/>
    </div>
    <div class="data-field">
        <label for="message">Message</label>
        <input id="msG" type="text" name="msG" value="<?= htmlentities($app['msG']); ?>"/>
    </div>
    <div>
        <label for="appDate">Date</label>
        <input id="calendar" type="date" name="date" class="form-control" id="date" required
               value="<?= htmlentities($app['appDate']); ?>">
    </div>
    <div>
        <select id="appTime" name="appTime" required>
            <option value="">--Select--</option>
            <option value="10:00-10:15">10:00-10:15</option>
            <option value="14:00-14:15">14:00-14:15</option>
            <option value="20:00-20:15">20:00-20:15</option>
        </select>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $id; ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
<script type="text/javascript" src="myscript.js"></script>

</body>
</html>
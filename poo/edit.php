<?php
/**
 * @var mysqli $db
 */
require "config.php";

$conn = openCon();

if(!isset($_SESSION))
{
    session_start();
}

//Check if Post isset, else do nothing
if (isset($_GET['id'])) {
    $banaan = $_GET['id'];
$sql = "SELECT 
                firstName, lastName, mail, phoneNumber, msG, appDate, appTime
          FROM test
              WHERE id = $banaan";
    $result1 = mysqli_query($conn, $sql);

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $id = mysqli_escape_string($conn, $_POST['id']);
    $firstName = mysqli_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_escape_string($conn, $_POST['lastName']);
    $mail = mysqli_escape_string($conn, $_POST['mail']);
    $phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
    $message = mysqli_escape_string($conn, $_POST['msG']);

    //Save variables to array so the form won't break
    $app = [
        'id' => $id,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'mail' => $mail,
        'phoneNumber' => $phoneNumber,
        'msG' => $message,
    ];

    //Update the record in the database
    $query = "UPDATE test
                  SET firstName = '$firstName', lastName = '$lastName', mail = '$mail', phoneNumber = '$phoneNumber', msG = '$message'
                  WHERE id = '$id'";
    $result2 = mysqli_query($conn, $query);
}

//Close connection
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Edit Appointment</h1>

<form action="" method="post" enctype="multipart/form-data">
    <label for="artist">Artiest</label>
        <?php foreach ($app as $row) : ?>
    <div class="data-field">
        <label for="firstName">First Name</label>
        <input id="firstName" type="text" name="firstName" value="<?= $row['firstName']; ?>"/>
    </div>
    <div class="data-field">
        <label for="lastName">Last Name</label>
        <input id="lastName" type="text" name="lastName" value="<?= $row['lastName']; ?>"/>
    </div>
    <div class="data-field">
        <label for="mail">E-Mail</label>
        <input id="mail" type="text" name="mail" value="<?= $row['mail']; ?>"/>
    </div>
    <div class="data-field">
        <label for="phone">Phone Number</label>
        <input id="phone]" type="text" name="phone" value="<?= $row['phoneNumber']; ?>"/>
    </div>
    <div class="data-field">
        <label for="message">Message</label>
        <input id="message" type="text" name="message" value="<?= $row['message']; ?>"/>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $id; ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
    <?php endforeach; ?>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
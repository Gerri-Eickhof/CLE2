<?php
include 'includes/config.php';
require "includes/common.php";
require_once "includes/php-mailer.php";

session_start();

//Opens connection to database.
$conn = openCon();

//Checks if submit isset, starts create process if true.
if (isset($_POST['submit'])) {

    //Makes a new array with the posted information.
    $firstName = htmlspecialchars($_POST['firstName']);
    $firstName = mysqli_real_escape_string($conn, trim($firstName));
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
    $appTime = htmlspecialchars($_POST['time']);
    $time = mysqli_real_escape_string($conn, trim($appTime));

    require_once "includes/form-validation.php";
    //Checks if there is no errors (form validation).
    if (empty($errors)) {
        $date1 = strtotime($date1);
        $date1 = date('Y-m-d', $date1);

        //Adds array to database.
        $sql = "INSERT INTO test
                  (firstName, lastName, mail, phoneNumber, msG, appDate, appTime)
                  VALUES ('$firstName', '$lastName', '$email', '$phone', '$message', '$date1', '$appTime')";
        $result = mysqli_query($conn, $sql) or die ('Error: ' . $sql . '<br>' . mysqli_error($conn));
        sendMail();

        //Sends you back to index after putting values into database.
        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($conn);
        }
    }
}
//Opens connection to database
$conn = openCon();

?>

<html lang="en">
<head>
    <title>Reservering</title>
    <link rel="stylesheet" type="text/css" href="includes/style.css">
</head>
<body>
<form id="contact-form" method="post" action="">
    <div id="content">
        <div class="box1">
            <img id="logo" src="img/logo.png">
        </div>
        <div class="box2">
            <h1>Create an appointment</h1>
        </div>
        <div class="box3">
            <img id="img" src="img/2.png" width="533,6" height="262,9">
        </div>
        <div class="box4">
            <input type="text" name="firstName" class="form-control" placeholder="First name" >
            <span class><?= isset($errors['firstName'])?$errors['firstName'] : ''?></span>
        </div>
        <div class="box5">
            <input type="text" name="lastName" class="form-control" placeholder="Last name" >
            <span class><?= isset($errors['lastName'])?$errors['lastName'] : ''?></span>
        </div>
        <div class="box6">
            <input type="text" name="emailAdress" class="form-control" placeholder="Your Email" >
            <span class><?= isset($errors['mail'])?$errors['mail'] : ''?></span>
        </div>
        <div class="box7">
            <input type="text" name="phoneNumber" class="form-control" placeholder="Phone number" >
            <span class><?= isset($errors['phoneNumber'])?$errors['phoneNumber'] : ''?></span>
        </div>
        <div class="box8">
            <input type="text" name="message" class="form-control" placeholder="Message">
        </div>
        <div class="box9">
            <input id="calendar" type="date" name="date" class="form-control"  >
            <span class><?= isset($errors['date'])?$errors['date'] : ''?></span>
        </div>
        <div class="box10">
            <select id="time" name ="time" class="form-control">
                <option value="">Pick your time</option>
                <option value="10:00-10:15">10:00-10:15</option>
                <option value="14:00-14:15">14:00-14:15</option>
                <option value="20:00-20:15">20:00-20:15</option>
            </select>
            <span class><?= isset($errors['time'])?$errors['time'] : ''?></span>
        </div>
        <div class="box11">
            <img id="img" src="img/3.png" width="533,6" height="262,9">
        </div>
        <div class="box12">
            <input id="submit" type="submit" name="submit" value="SUBMIT APPOINTMENT">
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        </div>
    </div>
</form>
<footer>
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
        <?php if (!isset($_SESSION['loggedInUser'])) : ?>
            <a href="login.php"><strong>ADMIN LOGIN</strong></a>
        <?php endif; ?>
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
<script type="text/javascript" src="includes/myscript.js"></script>
</body>
</html>
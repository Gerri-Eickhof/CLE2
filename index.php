<?php
include 'config.php';
require "common.php";

session_start();

//Checks if CSRF is set.
if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

//Opens connection to database.
$conn = openCon();
?>

<html lang="en">
<head>
    <title>Reservering</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form id="contact-form" method="post" action="create.php">
    <div id="content">
        <div class="box1">
            <img id="logo" src="img/logo.png">
        </div>
        <div class="box2">
            <h1>Create appointment</h1>
        </div>
        <div class="box3">
            <img id="img" src="img/2.png" width="533,6" height="262,9">
        </div>
        <div class="box4">
            <input type="text" name="firstName" class="form-control" placeholder="First name" required>
            <span class><?= isset($errors['firstName'])?$errors['firstName'] : ''?></span>
        </div>
        <div class="box5">
            <input type="text" name="lastName" class="form-control" placeholder="Last name" required>
            <span class><?= isset($errors['lastName'])?$errors['lastName'] : ''?></span>
        </div>
        <div class="box6">
            <input type="text" name="emailAdress" class="form-control" placeholder="Your Email" required>
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
            <input id="calendar" type="date" name="date" class="form-control" id="date" required>
            <span class><?= isset($errors['appDate'])?$errors['appDate'] : ''?></span>
        </div>
        <div class="box10">
            <select id="time" name ="time" required>
                <span class><?= isset($errors['appTime'])?$errors['appTime'] : ''?></span>
                <option value="">Pick your time</option>
                <option value="10:00-10:15">10:00-10:15</option>
                <option value="14:00-14:15">14:00-14:15</option>
                <option value="20:00-20:15">20:00-20:15</option>
            </select>
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
    </li>
    <li class="site-footer__linklist-item h6">
        <?php if (isset($_SESSION['loggedInUser'])) : ?>
            <a href="delete.php"><strong>DELETE APPOINTMENTS</strong></a>
        <?php endif; ?>
    </li>
</footer>
<script type="text/javascript" src="myscript.js"></script>
</body>
</html>
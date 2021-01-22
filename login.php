<?php
session_start();
include "includes/config.php";
$conn = openCon();

//Check if user is logged in, else move to secure page
if (isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    exit;
}

//If form is posted, lets validate!
if (isset($_POST['submit'])) {
    //Retrieve values (email safe for query)
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    //Get password & name from DB
    $sql = "SELECT *
              FROM users
              WHERE username = '$email'";
    $result = mysqli_query($conn, $sql) or die('Error: ' . $sql);
    $user = mysqli_fetch_assoc($result);

    //Check if email exists in database
    $errors = [];
    if ($user) {
        //Validate password
        if (password_verify($password, $user['password'])) {
            //Set email for later use in Session
            $_SESSION['loggedInUser'] = [
                'name' => $user['name'],
                'id' => $user['id']
            ];

            //Redirect to secure.php & exit script
            header("Location: index.php");
            exit;
        } else {
            $errors[] = 'Incorrect login data';
        }
    } else {
        $errors[] = 'Incorrect login data';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Login</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/style.css"/>
</head>
<body>
<h1>Login</h1>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form id="login" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?= (isset($email) ? $email : ''); ?>"/>
    </div>
    <div>
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
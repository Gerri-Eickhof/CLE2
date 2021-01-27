<?php
//Check if data is valid & generate error if not so
$errors = [];
if (!isset($firstName) || $firstName == "") {
    $errors['firstName'] = 'First name cannot be empty';
}
if (!isset($lastName) || $lastName == "") {
    $errors['lastName'] = 'Last name cannot be empty';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['mail'] = "This is not a valid E-Mail";
}
if (!isset($phone) || $phone == "") {
    $errors['phoneNumber'] = 'Phone number cannot be empty';
}
if ($date1 == "") {
    $errors['date'] = 'Date cannot be empty';
}
if ($appTime == "") {
    $errors['time'] = 'Time cannot be empty';
} ?>

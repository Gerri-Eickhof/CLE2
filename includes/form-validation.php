<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($firstName == "") {
    $errors['firstName'] = 'First name cannot be empty'; //Alternative for errors behind input and not in summary
}
if ($lastName == "") {
    $errors['lastName'] = 'Last name cannot be empty';
}
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errors['mail'] = "This is not a valid E-Mail";
}
if ($phone == "") {
    $errors['phoneNumber'] = 'Phone number cannot be empty';
}
if ($appDate == "") {
    $errors['appDate'] = 'Date cannot be empty';
}
if ($appTime == "") {
    $errors['appTime'] = 'Time cannot be empty';
} ?>

<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($firstName == "") {
    $errors['firstName'] = 'Artist cannot be empty'; //Alternative for errors behind input and not in summary
}
if ($lastName == "") {
    $errors['lastName'] = 'Album name cannot be empty';
}
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errors['mail'] = "Ga zelf eens wat zoeken ofzo"; }

if ($phone == "") {
    $errors['phoneNumber'] = 'Year cannot be empty';
}
if ($appDate == "") {
    $errors['appDate'] = 'Tracks cannot be empty';
}
if ($appTime == "") {
    $errors['appTime'] = 'Tracks cannot be empty';
}
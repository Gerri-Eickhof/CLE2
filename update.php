<?php
try {
require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

$conn = new PDO($dsn, "$dataUser", "$dataPass", $options);

$sql = "SELECT * FROM test";

$statement = $conn->prepare($sql);
$statement->execute();

$result = $statement->fetchAll();

} catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>update-page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h2>Update users</h2>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Phone Number</th>
        <th>Date</th>
        <th>Time</th>
        <th>Message</th>
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
            <td><?php echo escape($row["appDate"]); ?></td>
            <td><?php echo escape($row["appTime"]); ?></td>
            <td><?php echo escape($row["msG"]); ?> </td>
            <td><a href="updateone.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>


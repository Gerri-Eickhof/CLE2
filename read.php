<?php
    try {
        require "config.php";
        require "common.php";

        if (isset($_POST['submit'])) {
            if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

        $conn = new PDO($dsn, "$dataUser", "$dataPass", $options);
        $sql = "SELECT *
        FROM test
        WHERE appDate = :appDate";

        $appDate = $_POST['appDate'];

        $statement = $conn->prepare($sql);
        $statement->bindParam('appDate', $appDate, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
if (isset($_POST['submit'])) {
if ($result && $statement->rowCount() > 0) {
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Afspraken</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class= "contact-title">
    <h1>Here are the current appointments</h1>
    <h2> Don't forget to put them in your schedule</h2>
</div>


<div class="content read">
    <h2>Read Contacts</h2>
    <a href="index.php" class="create-contact">Make a new appointment</a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-Mail</th>
            <th>Phone Number</th>
            <th>Date</th>
            <th>Time</th>
            <th>Message</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row['id'])?></td>
                <td><?php echo escape($row['firstName'])?></td>
                <td><?php echo escape($row['lastName'])?></td>
                <td><?php echo escape($row['mail'])?></td>
                <td><?php echo escape($row['phoneNumber'])?></td>
                <td><?php echo escape($row['appDate'])?></td>
                <td><?php echo escape($row['appTime'])?></td>
                <td><?php echo escape($row['msG'])?></td>
                <td class="actions">
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        > No results found for <?php echo escape($_POST['appDate']); ?>.
    <?php }
    } ?>
    <div class="pagination">
    </div>
</div>
<h2>Find appointments based on their date</h2>
<form method="post">
    <label for="appDate">Appointment Date</label>
    <input type="text" id="appDate" name="appDate">
    <input type="submit" name="submit" value="View Results">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
</form>
</body>
</html>
<?php
require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

if (isset($_POST['submit'])) {
    try {
        $conn = new PDO($dsn, "$dataUser", "$dataPass", $options);
        $app =[
            "id"        => $_POST['id'],
            "firstName" => $_POST['firstName'],
            "lastName"  => $_POST['lastName'],
            "mail"     => $_POST['mail'],
            "phoneNumber"       => $_POST['phoneNumber'],
            "appDate"       => $_POST['appDate'],
            "appTime"  => $_POST['appTime'],
            "msG"      => $_POST['msG']
        ];

        $sql = "UPDATE test
            SET id = :id,
              firstName = :firstName,
              lastName = :lastName,
              mail = :mail,
              phoneNumber = :phoneNumber,
              appDate = :appDate,
              appTime = :appTime,
              msG = :msG
            WHERE id = :id";

        $statement = $conn->prepare($sql);
        $statement->execute($app);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['id'])) {
    try {
        $conn = new PDO($dsn, "$dataUser", "$dataPass", $options);
        $id = $_GET['id'];

        $sql = "SELECT * FROM test WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $app = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<form method="post">
    <?php foreach ($app as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
</form>

<a href="index.php">Back to home</a>
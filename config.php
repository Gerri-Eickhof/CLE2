<?php
    $dataHost = "localhost";
    $dataUser = "root";
    $dataPass = "";
    $dataBase = "data";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dsn        = "mysql:host=$dataHost;dbname=$dataBase";
    $conn = new PDO($dsn, "$dataUser", "$dataPass", $options);
function closeCon($conn) {
    $conn -> close();
}
?>
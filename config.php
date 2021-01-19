<?php
//   $dataHost = "localhost";
//  $dataUser = "root";
//  $dataPass = "";
//  $dataBase = "data";
//   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
//   $dsn        = "mysql:host=$dataHost;dbname=$dataBase";
//  $conn = new PDO($dsn, "$dataUser", "$dataPass", $options);
//function closeCon($conn) {
///   $conn -> close();
//}


//Making connection to database in a function.
function openCon()
{
    $dbHost = "localhost"; //host of server
    $dbUser = "root"; //user
    $dbPass = ""; //password of user
    $db = "data"; //name of database

//Connecting to the database
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) or die("Connect Failed; %s\n" .
        $conn->error);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "Connected Failed" . "<br>";

    }
    return $conn;
}

// closing connection to database
function closeCon($conn)
{
    $conn->close();
}

?>

<?php
function openCon() {
    $dataHost = "localhost";
    $dataUser = "root";
    $dataPass = "";
    $dataBase = "data";
        $conn = mysqli_connect($dataHost, $dataUser, $dataPass, $dataBase) or die("Connect Failed; %s\n".
            $conn -> error);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
function closeCon($conn) {
    $conn -> close();
}
?>
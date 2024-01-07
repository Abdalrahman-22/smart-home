<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];

    //........................................

    //........................................ Get the time and date.
    date_default_timezone_set("Asia/Jerusalem");
    $tm = date("H:i:s");
    $dt = date("Y-m-d");
    //........................................

    //........................................ Updating the data in the table.
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO temp_sensor_records (id, temperature, humidity, `time`, `date`) VALUES (?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute([$id, $temperature, $humidity, $tm, $dt]);



    Database::disconnect();
    //........................................
}
?>
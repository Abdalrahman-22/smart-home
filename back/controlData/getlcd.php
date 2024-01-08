<?php
include '../database.php';
require 'Class.authorization.php';
if (!empty($_POST) && authorization::authorize($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];

    $myObj = (object) array();

    $pdo = Database::connect();

    $sql = "SELECT * FROM lcd WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $myObj->id = $row['id'];
        $myObj->show = $row['show'];

        $timezone = new DateTimeZone('Asia/Jerusalem');
        $datetime = new DateTime('now', $timezone);

        $myObj->date = $datetime->format('Y-m-d');
        $myObj->time = $datetime->format('H:i');

    }

    $sql = "SELECT * FROM smoke_sensor WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $myObj->fire = $row['fire'];
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;
    Database::disconnect();
}
?>
<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $roomID = $_POST['roomID'];
    $state_from_post = $_POST['state'];
    $table = $_POST['table'];


    //........................................

    //........................................ Get the time and date.
    date_default_timezone_set("Asia/Jerusalem");
    $tm = date("H:i:s");
    $dt = date("Y-m-d");
    //........................................

    //........................................ Updating the data in the table.
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM $table WHERE id=? AND roomID=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id,$roomID));

    $previous_state = "unknown";
    if ($row = $q->fetch(PDO::FETCH_ASSOC)) {
        $previous_state = $row['state'];
    }

    if ($previous_state != $state_from_post && $previous_state != "unknown") {
        $sql = "UPDATE $table SET state = ?, time = ?, date = ? WHERE id = ? AND roomID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($state_from_post, $tm, $dt, $id, $roomID));
    }

    Database::disconnect();
    //........................................
}
?>
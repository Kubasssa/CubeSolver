<?php 
    session_start();
    // pobieranie czasu i wkladanie go do tablicy w bazie
    require_once "connect.php";
    $time = $_GET['time'];
    $scramble = $_GET['scramble'];
   
    $sql = "INSERT INTO times (time, scramble, userID)
    VALUES (".$time.",'kuba'," . $_SESSION['user_id'] . ")";  // wkładanie scramble nie działa 

    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
?>
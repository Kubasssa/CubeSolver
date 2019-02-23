<?php

session_start();
require_once "connect.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $sql = "DELETE FROM times Where userID = '".$_SESSION['user_id']."' ";
    $result = mysqli_query($connection,$sql);

    if($result){
        echo"success";
    }else{
        echo mysqli_query($connection);
    }
}



?>
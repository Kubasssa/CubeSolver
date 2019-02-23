<?php 
    session_start();
    require_once "connect.php";

    $compNameText = $_POST['compNameText'];

    $cube2Single = $_POST['cube2Single'];
    $cube2Avg = $_POST['cube2Avg'];
    $cube3Single = $_POST['cube3Single'];
    $cube3Avg = $_POST['cube3Avg'];
    $cube4Single = $_POST['cube4Single'];
    $cube4Avg = $_POST['cube4Avg'];
    $cube5Single = $_POST['cube5Single'];
    $cube5Avg = $_POST['cube5Avg'];

    $goldMedals = $_POST['goldMedals'];
    $silverMedals = $_POST['silverMedals'];
    $bronzeMedals = $_POST['bronzeMedals'];

    $compId = 0;
    $isCompFLag = true;
    $xd = array();

    $sqlIsComp = "SELECT compName,userID FROM competitions where userID='".$_SESSION['user_id']."'";
    $resultIsComp = mysqli_query($connection, $sqlIsComp);
    if($resultIsComp == false) {
        echo "error while executing mysql: " . mysqli_error($connection);
        } else {
            while($row = mysqli_fetch_array($resultIsComp)) {
                if($compNameText == $row["compName"]){
                    $isCompFLag = false;
                }
            }
            
        }

    if($isCompFLag){
        
        $sql = "INSERT INTO competitions (compName,goldMedals,silverMedals,bronzeMedals,userID)
        VALUES ('".$compNameText."',".$goldMedals.",".$silverMedals.",".$bronzeMedals."," . $_SESSION['user_id'] . ")";  // wkładanie scramble nie działa 

        if ($connection->query($sql) === TRUE) {
            echo "New record created successfully";
            $sqlComp = "SELECT compsId FROM competitions Where compName='".$compNameText."' and userID='".$_SESSION['user_id']."' ";
            $resultComp = mysqli_query($connection, $sqlComp);
            if($resultComp === false) {
                echo "error while executing mysql: " . mysqli_error($connection);
            } else {
                while($row = mysqli_fetch_assoc($resultComp)) {
                    $compId = $row; 
                }
            }

            //mysqli_free_result($resultComp);

            $sql2 = "INSERT INTO cube2 (single, avg, compsId, userID)
            VALUES (".$cube2Single.",".$cube2Avg.",'".$compId['compsId']."','".$_SESSION['user_id']."')";  // wkładanie scramble nie działa 
        
            if ($connection->query($sql2) === TRUE) {
                echo "New record created successfully";
                
            } else {
                echo "Error: " . $sql2 . "<br>" . $connection->error;
            }
            
            $sql3 = "INSERT INTO cube3 (single, avg, compsId, userID)
            VALUES (".$cube3Single.",".$cube3Avg.",'".$compId['compsId']."','".$_SESSION['user_id']."')";  // wkładanie scramble nie działa 
        
            if ($connection->query($sql3) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql3 . "<br>" . $connection->error;
            }
        
            $sql4 = "INSERT INTO cube4 (single, avg, compsId, userID)
            VALUES (".$cube4Single.",".$cube4Avg.",'".$compId['compsId']."','".$_SESSION['user_id']."')";  // wkładanie scramble nie działa 
        
            if ($connection->query($sql4) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql4 . "<br>" . $connection->error;
            }
        
            $sql5 = "INSERT INTO cube5 (single, avg, compsId, userID)
            VALUES (".$cube5Single.",".$cube5Avg.",'".$compId['compsId']."','".$_SESSION['user_id']."')";  // wkładanie scramble nie działa 
        
            if ($connection->query($sql5) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql5 . "<br>" . $connection->error;
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;

        }
    }

    header("Location: profile.php");
    
?>
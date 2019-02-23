<?php 
    session_start();
    require_once "connect.php";

    if($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno ;
    }
    else{
  
            $login = $_POST['login'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM userdata WHERE login = ?";
            $sql1 = "SELECT * FROM userdata WHERE login = '$login'";
            $data = $connection->query($sql1)->fetch_assoc();
            // $result = mysqli_query($connection,$sql);
            // $howManyUsers = mysqli_num_rows($result);
            
            // $data = $connection->query($sql)->fetch_assoc();
        //    var_dump($data['userID']);die;


        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $login;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){   
                    mysqli_stmt_bind_result($stmt, $data['userID'], $login, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){  
                                $_SESSION['urLogin'] = true;
                                $_SESSION['user_id'] = $data['userID'];

                            
                                $sql = "SELECT time FROM times Where userID = '".$_SESSION['user_id']."' ";
                                $result = mysqli_query($connection,$sql);
                                $howManyTimes = mysqli_num_rows($result);
                    
                                if($howManyTimes>0){
                                    $_SESSION["isTimeInDatabase"] = true;
                                  
                                    while($row= mysqli_fetch_assoc($result)){
                                        $_SESSION["time"][] = $row;
                                    }
                                }else{
                                    $_SESSION["isTimeInDatabase"] = false;
                                }
                                unset($_SESSION['blad']);  // usuwamy zmienna blad ktora po prawidłowym zalogowaniu nie jest nam potrzena
                                $result->free_result();

                                
                                header("Location: loginTimer.php");
                            }
                        }
            }else{                   
                //jezeli nie ma zadnego uzytkownika o takim loginie i haśle 
                //to tworzona zostaje zmienna blad która przechowuje spana z komunikatem bledu 
                $_SESSION['blad'] = '<span style="position:absolute; color:red; right: 180px;top: 37px;">Wrong login or password
                </span>';
                header("Location: timer.php");
                }
            }
            mysqli_stmt_close($stmt);
        }
       $connection->close();
    }

?>


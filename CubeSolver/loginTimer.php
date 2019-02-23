<?php 
    session_start();

    if(!isset($_SESSION['urLogin'])){
        header('Location: timer.php');
        exit();
    }

        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timer</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->


</head>

<body onload="valuesFromDatabase();">
    <div class="main">
        <header>
            <a href="loginTimer.php" class="mainLink"></a>
            <a href="logOut.php" class="logout" style=" color: white; text-decoration: none;">Logout</a>
            <div class="loginImage" title="Profile"></div>
        </header>

        <section>
            <!-- <div class="imageWrapper">
                <a href="profile.php">Your Profile</a>            
                <?php
                   // echo '<a href="logOut.php" style=" color: black; text-decoration: none;">Logout!</a>';
                ?>
            </div> -->
            <div class="display">00:00</div>
            <div class="timeTable">
                <form action="" id="deleteform" method="post" >
                    <input type="submit" class="resetButton" value="Reset" name="submit">
                </form>
                <div class="times">

                        <?php  
                                if($_SESSION['isTimeInDatabase']){
                                    foreach ($_SESSION["time"] as $sess ) {
                                        echo  '<div class="delete" >' .$sess["time"]. '</div>';
                                    
                                    }
                                }
                        ?>
                </div>
            </div>
            <div class="stats">
                <button class="statsButton"></button>
                <div class="mainStats">
                    <div>Number of times: <span>0</span> </div>
                    <div>best: <span>00</span></div>
                    <div>worst <span>00</span></div>
                    <div>avg5: <span>00</span></div>
                    <div>avg12: <span>00</span></div>
                    <div>avg100: <span>00</span></div>
                    <br>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(".resetButton").click(function () {

            $(".delete").remove();
            numberOfTimes = 0;
            bestTime = 10000;
            worstTime = 0;
            avg5Value = 0;
            document.querySelector(".mainStats :nth-child(1) span").innerHTML = numberOfTimes; // updatetuje liczbe czasów
            document.querySelector(".mainStats :nth-child(2) span").innerHTML = "0"; // updatetuje najlepszy czas
            document.querySelector(".mainStats :nth-child(3) span").innerHTML = worstTime; // updatetuje najgorszy czas
            document.querySelector(".mainStats :nth-child(4) span").innerHTML = avg5Value; // updatetuje srednia z 5

            timesTable.forEach(element => { //zerowanie czasów w tablicy po nacisnieciu reset button
                timesTable = [];
                k = 0;
            });

        });


        $("#deleteform").on('submit',(function (e) {

                e.preventDefault(); 
                if(confirm("do you want to delete all times ?")==true)
                {
                    $.ajax({
                        type:'POST',
                        url:'deleteAllTime.php',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){

                            window.location.replace("loginTimer.php");
                        }
                    })


                }
                
        }))


        //--------------------------------------toggle na okienko z opcjami po naciśnięciu obrazka 
        // $(".imageWrapper").hide();

        $(".loginImage").click(function()  {
            window.location = "profile.php"
        });


    </script>
    <script src="timer.js?v=1"></script>
    <script src="scramble.js"></script>
    <script src="send_post.js"></script>

</body>

</html>
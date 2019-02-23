<?php 
    session_start();

    if((isset($_SESSION['urLogin'])) && ($_SESSION['urLogin']==true)){
        header('Location: loginTimer.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

</head>

<body>
    <div class="main">
        <header>
            <a href="timer.php" class="mainLink" ></a>
            <form action="form.php" method="POST">
                <input type="text" name="login" placeholder="Login">
                <input type="text" name="password" placeholder="Password" autocomplete="off" >
                <input type="submit" value="Go">
            </form>
            <?php
                    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
            ?>
            <a href="registPage.php" class="regLink"> REGISTER</a>
        </header>

        <section>
            <div class="display">00:00</div>
            <div class="timeTable">
                <form action="" id="deleteform" method="post" >
                        <input type="submit" class="resetButton" value="Reset" name="submit">
                    </form>
                <div class="times">
            </div>
            </div>
            <div class="stats">
                <button id= "3" class="statsButton"></button>
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

        $('.delete').click(function () {
            alert($('.delete').index(this));
        });
    </script>
    <script src="timer.js"></script>
    <script src="scramble.js"></script>

</body>

</html>
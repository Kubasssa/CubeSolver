<?php 
    session_start();
    require_once "connect.php";

    unset($_SESSION['compName']);
    $_SESSION['totalGoldMedals']=0;
    $_SESSION['totalSilverMedals']=0;
    $_SESSION['totalBronzeMedals']=0;

    $compsID=0;

    $_SESSION['single2best'] = 9999;
    $_SESSION['avg2best'] = 9999;

    $_SESSION['single3best'] = 9999;
    $_SESSION['avg3best'] = 9999;

    $_SESSION['single4best'] = 9999;
    $_SESSION['avg4best'] = 9999;

    $_SESSION['single5best'] = 9999;
    $_SESSION['avg5best'] = 9999;

    if(!isset($_SESSION['profileFlag'])){

        $_SESSION['goldMedals'] = 0;
        $_SESSION['silverMedals'] = 0;
        $_SESSION['bronzeMedals'] = 0;

        $_SESSION['comps_ID'] = 0;

        $_SESSION['single2'] = 0;
        $_SESSION['avg2'] = 0;

        $_SESSION['single3'] = 0;
        $_SESSION['avg3'] = 0;

        $_SESSION['single4'] = 0;
        $_SESSION['avg4'] = 0;

        $_SESSION['single5'] = 0;
        $_SESSION['avg5'] = 0;
        
    }

    $sqlComp = "SELECT compName FROM competitions Where userID='".$_SESSION['user_id']."' ";
    $resultComp = mysqli_query($connection, $sqlComp);
    $_SESSION["howManyComps"] = mysqli_num_rows($resultComp);
    while($row = mysqli_fetch_array($resultComp)) {
            
        $_SESSION['compName'][]=  $row;       
    }

    $sql = "SELECT * FROM competitions Where userID='".$_SESSION['user_id']."' ";
    $result = mysqli_query($connection, $sql);

    while($row = mysqli_fetch_array($result)) {
        $compsID = $row["compsId"];
        $_SESSION['totalGoldMedals'] = $_SESSION['totalGoldMedals'] + $row["goldMedals"];
        $_SESSION['totalSilverMedals'] = $_SESSION['totalSilverMedals'] + $row["silverMedals"];
        $_SESSION['totalBronzeMedals'] = $_SESSION['totalBronzeMedals'] + $row["bronzeMedals"];
    }

    $sql2 = "SELECT * FROM cube2 Where userID='".$_SESSION['user_id']."' ";

    $result2 = mysqli_query($connection, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result2)) {
            if($row["single"]<$_SESSION['single2best']){
                $_SESSION['single2best'] =  $row["single"];
            }
            if($row["avg"]<$_SESSION['avg2best']){
                $_SESSION['avg2best'] = $row["avg"];
            }
        }
    } else {
        $_SESSION['single2'] =  0;
        $_SESSION['avg2'] = 0;
    }

    $sql3 = "SELECT * FROM cube3 Where userID='".$_SESSION['user_id']."' ";

    $result3 = mysqli_query($connection, $sql3);

    if (mysqli_num_rows($result3) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result3)) {
            if($row["single"]<$_SESSION['single3best']){
                $_SESSION['single3best'] =  $row["single"];
            }
            if($row["avg"]<$_SESSION['avg3best']){
                $_SESSION['avg3best'] = $row["avg"];
            }
        }
    } else {
        $_SESSION['single3'] = 0;
        $_SESSION['avg3'] = 0;
    }

    $sql4 = "SELECT * FROM cube4 Where userID='".$_SESSION['user_id']."'";

    $result4 = mysqli_query($connection, $sql4);

    if (mysqli_num_rows($result4) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result4)) {
            if($row["single"]<$_SESSION['single4best']){
                $_SESSION['single4best'] =  $row["single"];
            }
            if($row["avg"]<$_SESSION['avg4best']){
                $_SESSION['avg4best'] = $row["avg"];
            }
        }
    } else {
        $_SESSION['single4'] =  0;
        $_SESSION['avg4'] = 0;
    }

    $sql5 = "SELECT * FROM cube5 Where  userID='".$_SESSION['user_id']."' ";

    $result5 = mysqli_query($connection, $sql5);

    if (mysqli_num_rows($result5) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result5)) {
            if($row["single"]<$_SESSION['single5best']){
                $_SESSION['single5best'] =  $row["single"];
            }
            if($row["avg"]<$_SESSION['avg5best']){
                $_SESSION['avg5best'] = $row["avg"];
            }
        }
    } else {
        $_SESSION['single5'] = 0;
        $_SESSION['avg5'] = 0;
    }



        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?v1"></script>
</head>
<body>

    <div class="main">
        <header>
            <a href="loginTimer.php" class="mainLink"></a>
            <a href="logOut.php" class="logout" style=" color: white; text-decoration: none;">Logout</a>
            <div class="loginImage" title="Main Window"></div>
        </header>

        <section id="app" >
            <div class="dataBar">
                <div class="image"></div>
                <p class="name">{{name}}</p>
                <p class="surename">{{surename}}</p>
            </div>
            <div class="chooseBar">
                <div class="stats" v-on:click="statsBarActive">Best Stats</div>
                <div class="comps" v-on:click="compsBarActive">Competitions</div>
                <div class="edit" v-on:click="editBarActive">Edit profile</div>
                <div class="statsBarActive"></div>
                <div class="compsBarActive"></div>
                <div class="editBarActive"></div>
            </div>
            <div class="dataWindow">
                <p class="compName3">Best Results</p>
                    <table class="resultTable3">
                        <thead>
                            <tr>
                                <th class="event3">event</th>
                                <th class="single3">single</th>
                                <th class="avg3">avg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="event3">2x2</td>
                                <td class="single3"><?PHP echo $_SESSION["single2best"];?></td>
                                <td class="avg3"><?PHP echo $_SESSION["avg2best"];?></td>
                            </tr>
                            <tr>
                                <td class="event3">3x3</td>
                                <td class="single3"><?PHP echo $_SESSION["single3best"];?></td>
                                <td class="avg3"><?PHP echo $_SESSION["avg3best"];?></td>
                            </tr>
                            <tr>
                                <td class="event3">4x4</td>
                                <td class="single3"><?PHP echo $_SESSION["single4best"];?></td>
                                <td class="avg3"><?PHP echo $_SESSION["avg4best"];?></td>
                            </tr>
                            <tr>
                                <td class="event3">5x5</td>
                                <td class="single3"><?PHP echo $_SESSION["single5best"];?></td>
                                <td class="avg3"><?PHP echo $_SESSION["avg5best"];?></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Total Medals</p>

                    <table class="medals3">
                        <thead>
                            <tr>
                                <th>gold</th>
                                <th>silver</th>
                                <th>bromze</th>
                            </tr>                
                        </thead>
                        <tbody>
                            <tr>
                                <td class="goldMedals3"><?PHP echo $_SESSION["totalGoldMedals"]; ?></td>
                                <td class="silverMedals3"><?PHP echo $_SESSION["totalSilverMedals"]; ?></td>
                                <td class="bronzeMedals3"><?PHP echo $_SESSION["totalBronzeMedals"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
             </div>
            <div class="compWindow">
                <form action="profileStats.php" method="POST">
                    <select class="compChoice" name="compName">
                        <?php  
         
                                foreach ($_SESSION['compName'] as $ses ) {
                                    echo  '<option value='.$ses["compName"].'>' .$ses["compName"]. '</option>';                              
                                }
                            
                        ?>
                    </select>
                    <input class="refreshButton" type="submit" value="refresh" >
                </form>
                <div class="addCompButton" v-on:click="addCompButton()">add competition</div>
                <p class="compName"><?PHP echo $_SESSION["compName2"];?></p>
                <table class="resultTable">
                    <thead>
                        <tr>
                            <th class="event">event</th>
                            <th class="single">single</th>
                            <th class="avg">avg</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="event">2x2</td>
                            <td class="single"><?PHP echo $_SESSION["single2"];?></td>
                            <td class="avg"><?PHP echo $_SESSION["avg2"];?></td>
                        </tr>
                        <tr>
                            <td class="event">3x3</td>
                            <td class="single"><?PHP echo $_SESSION["single3"];?></td>
                            <td class="avg"><?PHP echo $_SESSION["avg3"];?></td>
                        </tr>
                        <tr>
                            <td class="event">4x4</td>
                            <td class="single"><?PHP echo $_SESSION["single4"];?></td>
                            <td class="avg"><?PHP echo $_SESSION["avg4"];?></td>
                        </tr>
                        <tr>
                            <td class="event">5x5</td>
                            <td class="single"><?PHP echo $_SESSION["single5"];?></td>
                            <td class="avg"><?PHP echo $_SESSION["avg5"];?></td>
                        </tr>
                    </tbody>
                </table>

                <p>Medals</p>

                <table class="medals">
                    <thead>
                        <tr>
                            <th>gold</th>
                            <th>silver</th>
                            <th>bromze</th>
                        </tr>                
                    </thead>
                    <tbody>
                        <tr>
                            <td class="goldMedals"><?PHP echo $_SESSION["goldMedals"]; ?></td>
                            <td class="silverMedals"><?PHP echo $_SESSION["silverMedals"]; ?></td>
                            <td class="bronzeMedals"><?PHP echo $_SESSION["bronzeMedals"]; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="addCompWindow">
                <form action="addComp.php" method="POST" >
                    <input class="addComp" type="submit" value="Add" >

                    <p class="writeCompName">Competiton name</p>
                    <input class="compNameInput" type="text" name="compNameText">
                    <table class="resultTable2">
                        <thead>
                            <tr>
                                <th class="event2">event</th>
                                <th class="single2">single</th>
                                <th class="avg2">avg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="event2">2x2</td>
                                <td class="single2"><input type="text" name="cube2Single" value="0"></td>
                                <td class="avg2"><input type="text" name="cube2Avg" value="0"></td>
                            </tr>
                            <tr>
                                <td class="event2">3x3</td>
                                <td class="single2"><input type="text" name="cube3Single" value="0"></td>
                                <td class="avg2"><input type="text" name="cube3Avg" value="0"></td>
                            </tr>
                            <tr>
                                <td class="event2">4x4</td>
                                <td class="single2"><input type="text" name="cube4Single" value="0"></td>
                                <td class="avg2"><input type="text" name="cube4Avg" value="0"></td>
                            </tr>
                            <tr>
                                <td class="event2">5x5</td>
                                <td class="single2"><input type="text" name="cube5Single" value="0"></td>
                                <td class="avg2"><input type="text" name="cube5Avg" value="0"></td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Medals</p>

                    <table class="medals2">
                        <thead>
                            <tr>
                                <th>gold</th>
                                <th>silver</th>
                                <th>bromze</th>
                            </tr>                
                        </thead>
                        <tbody>
                            <tr>
                                <td class="goldMedals"><input type="text" name="goldMedals" value="0"></td>
                                <td class="silverMedals"><input type="text" name="silverMedals" value="0"></td>
                                <td class="bronzeMedals"><input type="text" name="bronzeMedals" value="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="editWindow">
                <input class="nameInput" type="text" v-model="name">
                <input class="surenameInput"  type="text" v-model="surename">
            </div>
        </section>
    </div>

    <script>
        $(".loginImage").click(function()  {
            window.location = "loginTimer.php";
        });

        function myFunction() {
            let x = document.querySelector(".compChoice").value;
            $(".compChoice").val("x");
        }


        var app = new Vue({
            el: '#app',
            data:{
                name: "Jakub",
                surename: "Wojtaszewski"
            },
            methods: {
                statsBarActive: function () {
                    document.querySelector('.statsBarActive').style.backgroundColor = "gold";
                    document.querySelector('.compsBarActive').style.backgroundColor = "#ddd";
                    document.querySelector('.editBarActive').style.backgroundColor = "#ddd";

                    document.querySelector('.addCompWindow').style.display = "none";
                    document.querySelector('.dataWindow').style.display = "block";
                    document.querySelector('.compWindow').style.display = "none";
                    document.querySelector('.editWindow').style.display = "none";

                },
                editBarActive: function () {
                    document.querySelector('.editBarActive').style.backgroundColor = "gold";
                    document.querySelector('.compsBarActive').style.backgroundColor = "#ddd";
                    document.querySelector('.statsBarActive').style.backgroundColor = "#ddd";

                    document.querySelector('.addCompWindow').style.display = "none";
                    document.querySelector('.editWindow').style.display = "block";
                    document.querySelector('.compWindow').style.display = "none";
                    document.querySelector('.dataWindow').style.display = "none";

                },
                compsBarActive: function () {
                    document.querySelector('.compsBarActive').style.backgroundColor = "gold";
                    document.querySelector('.statsBarActive').style.backgroundColor = "#ddd";
                    document.querySelector('.editBarActive').style.backgroundColor = "#ddd";

                    document.querySelector('.addCompWindow').style.display = "none";
                    document.querySelector('.compWindow').style.display = "block";
                    document.querySelector('.dataWindow').style.display = "none";
                    document.querySelector('.editWindow').style.display = "none";

                },
                addCompButton: function () {
                    document.querySelector('.addCompWindow').style.display = "block";
                    document.querySelector('.compWindow').style.display = "none";
                    document.querySelector('.dataWindow').style.display = "none";
                    document.querySelector('.editWindow').style.display = "none";

                }
            }
        })
    </script>
</body>
</html>
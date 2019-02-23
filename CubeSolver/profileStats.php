<?PHP
session_start();
require_once "connect.php";

$_SESSION["profileFlag"] = true;
$compsID = 0;
$compName = $_POST['compName'];
unset($_SESSION['compName']);

$sql = "SELECT * FROM competitions Where userID='".$_SESSION['user_id']."' ";
$sqlComp = "SELECT compName FROM competitions Where userID='".$_SESSION['user_id']."' ";

$result = mysqli_query($connection, $sql);
$resultComp = mysqli_query($connection, $sqlComp);
$_SESSION["howManyComps"] = mysqli_num_rows($result);

if ($_SESSION["howManyComps"] > 0) {
    // output data of each row

        while($row = mysqli_fetch_array($resultComp)) {
            
            $_SESSION['compName'][]=  $row;       
        }

        $sql = "SELECT * FROM competitions Where userID='".$_SESSION['user_id']."' AND compName = '$compName' ";
        
        $result = mysqli_query($connection, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            $compsID = $row["compsId"];
            $_SESSION['compName2'] =  $compName;            
            $_SESSION['goldMedals'] = $row["goldMedals"];
            $_SESSION['silverMedals'] = $row["silverMedals"];
            $_SESSION['bronzeMedals'] = $row["bronzeMedals"];
        }

       

    $sql2 = "SELECT * FROM cube2 Where compsId='$compsID' ";

    $result2 = mysqli_query($connection, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result2)) {
            $_SESSION['single2'] =  $row["single"];
            $_SESSION['avg2'] = $row["avg"];
        }
    } else {
        $_SESSION['single2'] =  0;
        $_SESSION['avg2'] = 0;
    }

    $sql3 = "SELECT * FROM cube3 Where compsId='$compsID' ";

    $result3 = mysqli_query($connection, $sql3);

    if (mysqli_num_rows($result3) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result3)) {
            $_SESSION['single3'] =  $row["single"];
            $_SESSION['avg3'] = $row["avg"];
        }
    } else {
        $_SESSION['single3'] = 0;
        $_SESSION['avg3'] = 0;
    }

    $sql4 = "SELECT * FROM cube4 Where compsId='$compsID' ";

    $result4 = mysqli_query($connection, $sql4);

    if (mysqli_num_rows($result4) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result4)) {
            $_SESSION['single4'] =  $row["single"];
            $_SESSION['avg4'] = $row["avg"];
        }
    } else {
        $_SESSION['single4'] =  0;
        $_SESSION['avg4'] = 0;
    }

    $sql5 = "SELECT * FROM cube5 Where compsId='".$compsID."' ";

    $result5 = mysqli_query($connection, $sql5);

    if (mysqli_num_rows($result5) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result5)) {
            $_SESSION['single5'] = $row["single"];
            $_SESSION['avg5'] = $row["avg"];
        }
    } else {
        $_SESSION['single5'] = 0;
        $_SESSION['avg5'] = 0;
    }


} else {
    $_SESSION['compName'] =  "comName";
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
header("Location: profile.php");

?>
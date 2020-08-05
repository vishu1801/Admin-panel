<?php
function OpenCon(){
    $host_name = "localhost";
    $user_name = "vishucs";
    $user_pass = "vishu8979";
    $db_name = "attendancesystem";
    $conn = mysqli_connect($host_name,$user_name,$user_pass,$db_name) or die("connection failed: %s\n".$conn->error);

    return $conn;
}

function CloseCon($con){
    $con->close();
}
?>
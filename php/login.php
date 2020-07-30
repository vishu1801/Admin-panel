<?php
error_reporting(0);
$username = $_POST['username'];
$password = $_POST['password'];
include 'connection.php';
$conn = OpenCon();
if(isset($_POST['login'])){
    if(empty($username) || empty($password)){
        echo "<script>alert('Enter all The fields'); window.location='../index.html'</script>";
    }else{
        $result=mysqli_query($conn,"SELECT *FROM admin WHERE username='$username'");
        $rows=mysqli_fetch_assoc($result);
        if($rows<1){
            echo"<script>alert('You are not a vaild user.'); window.location='../index.html'</script>";
            exit();
        }else{
            if($username==$rows['username']){
                if($password==$rows['password']){
                    header("location: ../home.html");;
                    exit(); 
                }else{
                    echo"<script>alert('Enter the valid password.'); window.location='../index.html'</script>";
                    exit();
                }
            }else{
                echo"<script>alert('Enter the valid username'); window.location='../index.html'</script>";
                exit();
            }
        }
    }
}else{
    header("location: ../index.html"); 
    exit();
}

CloseCon($conn);
?>
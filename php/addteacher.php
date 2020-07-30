<?php
include "connection.php";
$conn = OpenCon();
$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
if(isset($_POST['add'])){
    if(empty($name)||empty($password)||empty($email)||empty($username)){
        echo "<script>alert('Please Fill All the fields!'); window.location='../addteacher.html'</script>";
    }else{
        $stmt=$conn->prepare("insert into teachers(name,email,username,password) values(?,?,?,?)");
        $stmt->bind_param("ssss",$name,$email,$username,$password);
        $stmt->execute();
        echo "<script>alert('Data stored successfully.'); window.location='../addteacher.html'</script>";
    }
}else{
    header("location: ../addteacher.html");
    exit();
}
?>


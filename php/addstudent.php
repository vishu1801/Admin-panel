<?php
include "connection.php";
$conn = OpenCon();
$class=$_POST['class'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$address=$_POST['address'];
$phone=$_POST['phone'];

if(isset($_POST['add'])){
    if(empty($class)||$class=="--CLASSES--"){
        echo "<script>alert('Enter the class.'); window.location='../addstudent.html'</script>";
        exit();
    }
    elseif(empty($firstname)||empty($lastname)||empty($address)||empty($phone)){
        echo "<script>alert('Please enter all the fields.'); window.location='../addstudent.html'</script>";
        exit();
    }else{
        $stmt=$conn->prepare("insert into studentlist(firstname,lastname,address,phone,class) values(?,?,?,?,?)");
        $stmt->bind_param("sssis",$firstname,$lastname,$address,$phone,$class);
        $stmt->execute();
        echo "<script>alert('Data stored successfully.'); window.location='../addstudent.html'</script>";
    }
}else{
    header("location: ../addstudent.html");
    exit();
}

?>
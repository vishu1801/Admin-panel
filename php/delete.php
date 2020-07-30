<?php
    include 'connection.php';
    $conn = OpenCon();
    if(isset($_GET['del'])){
        $id=$_GET['del'];
        $result=mysqli_query($conn,"DELETE FROM teachersallotted WHERE id=$id");
        if($result==true){
            echo "<script>alert('Record deleted successfully.'); window.location='teacherallotted.php'</script>";
            exit();
        }else{
            echo"<script>alert('Record didn't deleted due to some technical issue! Please try again'); window.location='teacherallotted.php'</script>";
            exit();
        }
    }else{
        header("location: 'teacherallotted.php' ");
    }
?>
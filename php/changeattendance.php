<?php
    session_start();
    include 'connection.php';
    $conn=OpenCon();
    if(isset($_GET['id'])){
        $_SESSION['id']=$_GET['id'];
        $id=$_GET['id'];
        $result=mysqli_query($conn,"SELECT *FROM attandance WHERE id=$id ");
        $rows=mysqli_fetch_assoc($result);
    }else if(isset($_POST['update'])){
        $modify=$_POST['modify'];
        $id=$_POST['id'];
        $result=mysqli_query($conn,"UPDATE attandance SET attandance='$modify' WHERE id=$id ");
        if($result==true){
            echo"<script>alert('Attendance Modified'); window.location='../checkattendance.html'</script>";
            exit(); 
        }else{
            echo"<script>alert('Some internet issue! Please try again later.'); </script>";
        }
    }else{
        header("loaction: ../checkattandance.html ");
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>CCSS</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<html>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a href="home.html" class="navbar-brand">ATTENDANCE SYSTEM</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-items"><a href="../home.html" class="nav-link">Home</a></li>
                <li class="nav-items"><a href="../view_teacher.html" class="nav-link">Teacher</a></li>
                <li class="nav-items"><a href="../view_student.html" class="nav-link">Student</a></li>
                <li class="nav-items"><a href="logout.php" class="nav-link">Logout</a></li>
            </ul>
        </nav>

        <form class="form" action="changeattendance.php" method="POST">
            <input type="hidden" value="<?php echo $rows['id'];?>" name="id">
            <input readonly value="<?php echo $rows['firstname']; ?> ">
            <input readonly value="<?php echo $rows['lastname']; ?> ">
            <input readonly value="<?php echo $rows['date']; ?> ">
            <input readonly value="<?php echo $rows['class']; ?> ">
            <select name='modify' aria-placeholder="<?php echo $rows['attandance'];?>">
            <?php if($rows['attandance']=="Present"){ ?>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            <?php }else{ ?>
                <option value="Absent">Absent</option>
                <option value="Present">Present</option>
            <?php }?>
            </select>
            <button name="update">Update</button>
            
        </form>


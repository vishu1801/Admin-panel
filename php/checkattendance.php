<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Students</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a href="home.html" class="navbar-brand">ATTENDANCE SYSTEM</a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-items"><a href="../home.html" class="nav-link">Home</a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">Teacher</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="viewteacher.php">View Teachers</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="../addteacher.html">Add Teacher</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="teacherallotted.php">Teachers Allotted</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="../checkattendance.html">Check Attendance</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">Student</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="../viewstudent.html">View Students</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="../addstudent.html">Add Student</a>
				</div>
			</li>
			<li class="nav-items"><a href="logout.php" class="nav-link">Logout</a></li>
		</ul>
	</nav>
<?php
include 'connection.php';
$conn=OpenCon();
$subject=$_POST['subject'];
$class=$_POST['class'];
$date=$_POST['date'];
if(isset($_POST['submit'])){
    if(empty($date)||$class=="--CLASSES--"||$subject=="--SUBJECTS--"||empty($class)||empty($subject)){
        echo "<script>alert('Please fill all the boxes. ');window.location='../checkattendance.html'</script>";
    }else{
        $result=mysqli_query($conn,"SELECT *FROM attandance WHERE subject='$subject' AND class='$class' AND date='$date' ");
        $rows=mysqli_fetch_assoc($result);
        if($rows<1){
            echo "<script>alert('Attendance not uploaded yet. '); window.location='../checkattendance.html'</script>";
            exit();
        }else{
?>
<table class="table">
    <tr>
        <th>S.No</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Date</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Attendance</th>
        <th>Modify</th>
    </tr>
    <?php
        $result=mysqli_query($conn,"SELECT *FROM attandance WHERE subject='$subject' AND class='$class' AND date='$date' ORDER BY firstname ");
        $count=0;
        while($rows=mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo ++$count; ?></td>
        <td><?php echo $rows['firstname']; ?></td>
        <td><?php echo $rows['lastname']; ?></td>
        <td><?php echo $rows['date']; ?></td>
        <td><?php echo $rows['class']; ?></td>
        <td><?php echo $rows['subject']; ?></td>
        <td><?php echo $rows['attandance']; ?></td>
        <td><a href="changeattendance.php?id=<?php echo $rows['id']; ?>" class="btn btn-success" >Edit</a></td>
    </tr>
<?php 
        }
?>
</table>

<?php
        }
    }
}else{
    header("location: ../checkattendance.html ");
    exit();
}
?>
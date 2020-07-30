<?php

include "connection.php";
$conn = OpenCon();

$class = $_POST['class'];

if(isset($_POST['submit'])){
    if($class=="--CLASSES--"){
        echo "<script>alert('Please select the class.'); window.location='../viewstudent.html'</script>";
        exit();
    }else{
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>CCSS</title>
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
    <label class="mr-2 ml-2">Class:</label>
        <select disabled="disabled">
            <option><?php echo $class; ?></option>
            <option>--CLASSES--</option>
        </select>

    <table class="table table-hover">
        <tr>
            <th>S.No</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Class</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Modify</th>
        </tr>

        <?php 
            $result = mysqli_query($conn,"SELECT *FROM studentlist WHERE class = '$class' ORDER BY firstname");
            $count=0;
            while($rows=mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo ++$count; ?></td>
            <td><?php echo $rows['firstname']; ?></td>
            <td><?php echo $rows['lastname']; ?></td>
            <td><?php echo $rows['class']; ?></td>
            <td><?php echo $rows['address']; ?></td>
            <td><?php echo $rows['phone']; ?></td>
            <td><a href="modifydetails.php?id=<?php echo $rows['id'];?>" class="btn btn-success">Modify</a></td>
        </tr>
        <?php
            }
        }
    }else{
        header("location: ../viewstudent.html ");
        exit();
    }
        ?>
    </table>
    <?php CloseCon($conn)?>
</body>
</html>
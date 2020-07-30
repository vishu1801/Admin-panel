<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Admin Login</title>

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
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a href="home.html" class="navbar-brand">ATTENDANCE SYSTEM</a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-items"><a href="../home.html" class="nav-link">Home</a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">Teacher</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="">View Teachers</a>
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
    
    <table class="table table-hover">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php

            include "connection.php";
            $conn = OpenCon();
            $result = mysqli_query($conn,"SELECT *FROM teachers ORDER BY name");
            while($rows=mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $rows['name'];?></td>
            <td><?php echo $rows['email'];?></td>
            <td><?php echo $rows['username'];?></td>
            <td><?php echo $rows['password'];?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>

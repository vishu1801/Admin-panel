<?php
    include 'connection.php';
    $conn=OpenCon();
    if(isset($_GET['ed'])){
        $id=$_GET['ed'];
        $result=mysqli_query($conn,"SELECT *FROM teachersallotted WHERE id= $id ");
        $rows=mysqli_fetch_assoc($result);
    }

    if(isset($_POST['update'])){
        $id=$_POST['id'];
        $class=$_POST['class'];
        $subject=$_POST['subject'];
        if(empty($class)||empty($subject)||$subject=="--SUBJECTS--"||$class=="--CLASSES--"){
            echo "<script>alert('Please Enter all the Fields. '); window.location='edit.php?ed=$id'</script>";
            exit();
        }else{
            $sql="UPDATE teachersallotted SET class='$class', subject='$subject' where id=$id ";
            $result=mysqli_query($conn,$sql);
            if($result==true){
                echo "<script>alert ('Details updated'); window.location='teacherallotted.php'</script>";
            }
        }
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
        <form class="form" action="edit.php" method="POST">
            <div class="form-group"><input type="hidden" value="<?php echo $rows['id']?>" name="id"></div>
            <select name="class" style="margin-right: 180px;">
                <option>--CLASSES--</option>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
                <option value="VI">VI</option>
                <option value="VII">VII</option>
                <option value="VIII">VIII</option>
                <option value="IX">IX</option>
                <option value="X">X</option>
            </select>
            <label class="mr-2">Select Subject:</label>
            <select name="subject" style="margin-right: 50px;">
                <option>--SUBJECTS--</option>
                <option value="Hindi">Hindi</option>
                <option value="English">English</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Science">Science</option>
                <option value="Social Science">Social Science</option>
                <option value="Computer">Computer</option>
                <option value="Sanskrit">Sanskrit</option>
                <option value="General Knowledge">General Knowledge</option>
                <option value="Moral Science">Moral Science</option>
            </select>
            <div class="form-group"><input disabled="disabled" type="text" value="<?php echo $rows['name'] ?>" name="name"></div>
            <div class="form-group"><button name="update">UPDATE</button></div>
        </form>
    </body>
</html>
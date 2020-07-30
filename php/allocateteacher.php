<?php
include 'connection.php';
$conn = OpenCon();
$name = $_POST['techername'];
$class = $_POST['class'];
$subject = $_POST['subject'];

if(isset($_POST['allocate'])){
    $result=mysqli_query($conn,"SELECT id FROM teachers WHERE name= '$name' ");
    $rows=mysqli_fetch_assoc($result);
    if (empty($name)||$class=="--CLASSES--"||$subject=="--SUBJECTS--") {
        echo "<script>alert('Please enter all the fields! '); window.location='../allocateteacher.html'</script>";
        exit();
    }
    elseif($rows<1){
        echo "<script>alert('This teacher is not in the record. '); window.location='../allocateteacher.html'</script>";
        exit();
    }
    else{
        $id=$rows['id'];
        $stmt=$conn->prepare("insert into teachersallotted(teacher_id,name,class,subject) values(?,?,?,?)");
        $stmt->bind_param("isss",$id,$name,$class,$subject);
        $result=$stmt->execute();
        if($result==true){
            echo "<script>alert('Record has been save successfully.'); window.location='teacherallotted.php'</script>";
            exit();
        }else{
            echo "<script>alert('Record didn't saved due to some technical issues! Please try again later.'); window.location='../allocateteacher.html'</script>";
            exit();
        }
    }
}else{
    header("location: '../allocateteacher.html' ");
    exit();
}

?>
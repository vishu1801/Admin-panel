<?php
    include '../php/connection.php';
    
    $request_method=$_SERVER['REQUEST_METHOD'];
    $response=array();
    switch ($request_method) {
        case 'GET':
            response(doGet());
            break;
    }

    function doGet(){
        $class=$_GET['class'];
        $subject = $_GET['subject'];
        $date = $_GET['date'];
        $conn=OpenCon();
        $result=mysqli_query($conn,"SELECT *FROM attandance WHERE class='$class' AND subject='$subject' AND date='$date' ");
        $rows=mysqli_fetch_assoc($result);
        if($rows>0){
            $response[]=array("message"=>"no attempt left","firstname"=>"no","lastname"=>"no");
        }else{
            $result=mysqli_query($conn,"SELECT * FROM `studentlist` WHERE class='$class' ");
            $rows=mysqli_fetch_assoc($result);
            if($rows<1){
                $response[]=array("message"=>"no student found","firstname"=>"no","lastname"=>"no");
            }else{
                $result=mysqli_query($conn,"SELECT * FROM `studentlist` WHERE class='$class' ORDER BY firstname ");
                while($rows=mysqli_fetch_assoc($result)){
                    $response[]=array("message"=>"success","firstname"=>$rows['firstname'],"lastname"=>$rows['lastname']);
                }
            }
        }
        return $response;
    }

    function response($response){
        echo json_encode($response);
    }
?>
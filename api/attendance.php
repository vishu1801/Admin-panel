<?php
    session_start();
    include '../php/connection.php';
    $request_method=$_SERVER['REQUEST_METHOD'];
    $response[]=array();
    $_SESSION['temp']=array();
    switch ($request_method) {
        case 'GET':
        response(doPost());
        break;
    }

    function doPost(){
        $conn=OpenCon();

        $firstname=$_GET['firstname'];
        $lastname=$_GET['lastname'];
        $date=$_GET['date'];
        $class=$_GET['class'];
        $subject=$_GET['subject'];
        $attendance=$_GET['attendance'];
        $stmt=$conn->prepare("insert into attandance(firstname,lastname,date,class,subject,attandance) values(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$firstname,$lastname,$date,$class,$subject,$attendance);
        if($stmt->execute()){
            $response[]=array("message"=>"success");
        }else{
            $response[]=array("message"=>"Failed");
        }
        return $response;

    }
    function response($response){
        echo json_encode($response);
    }
?>
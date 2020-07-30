<?php
    $request_method = $_SERVER['REQUEST_METHOD'];
    $response[] = array();
    switch ($request_method) {
        case 'GET':
            response(doGet());
            break;    
    }

    function doGet(){
        include '../php/connection.php';
        $conn=OpenCon();

        $id=$_GET['id'];

        if(empty($id)){
            $response = array("message"=>"please send the id","classs"=>"no","subject"=>"no");
        }else{
            $result=mysqli_query($conn,"SELECT *FROM teachersallotted WHERE teacher_id = $id");
            $rows=mysqli_fetch_assoc($result);
            if($rows<1){
                $response[]=array("message"=>"no record found","Classs"=>"no","subject"=>"no");
            }
            else{
                $result=mysqli_query($conn,"SELECT *FROM teachersallotted WHERE teacher_id = $id");
                while($rows=mysqli_fetch_assoc($result)){
                    $response[]=array("message"=>"success","classs"=>"$rows[class]","subject"=>"$rows[subject]");
                }
            }
        }
        return $response;
    }
    function response($response){
        echo json_encode($response);
    }

?>
<?php 
    $request_method = $_SERVER['REQUEST_METHOD'];
    $response[] = array();
    switch ($request_method) {
        case 'GET':
            response(doGet());
            break;
    }

    function doGet(){
        include "../php/connection.php";
        $conn = OpenCon();
        @$username = $_GET['username'];
        @$password = $_GET['password'];

        if(empty($username)||empty($password)){
            $response[]=array("message"=>"empty");
        }else{

            $result=mysqli_query($conn,"SELECT *FROM teachers WHERE username='$username'");
            $rows=mysqli_fetch_assoc($result);
            if($rows<1){
                $response[]=array("message"=>"invalid user");
            }
            elseif ($password!=$rows['password']) {
                $response[]=array("message"=>"wrong password");
            }
            else{
                $response[]=array("message"=>"$rows[id]");
            }
        }
        return $response;
    }

    function response($response){
        echo json_encode($response);
    }
?>
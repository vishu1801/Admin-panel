<?php
    session_start();
    include 'connection.php';
    $conn=OpenCon();
    extract($_POST);
    if(isset($_SESSION['loggedin'])){
        $duration=$_SESSION['loggedin']['duration'];
        $start=$_SESSION['loggedin']['start'];
        if((time()-$start)>$duration){
            unset($_SESSION['loggedin']['duration']);
            unset($_SESSION['loggedin']['start']);
            unset($_SESSION['loggedin']);
            unset($_SESSION['name']);
            echo "<script>alert('Your session has been experied. Please login again'); window.location='index.html';</script>";
            exit;
        }else{
            if(isset($_POST['classs']) && isset($_POST['read'])){
                $classs=$_POST['classs'];
                if($classs!="--CLASSES--"){
                    $data =  '<table class="table table-hover">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Class</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Modify</th>
                                    </tr>';
                    $result=mysqli_query($conn,"SELECT *FROM studentlist WHERE class='$classs' ORDER BY firstname");
                    if(mysqli_num_rows($result)>0){
                        $count=0;
                        while($rows=mysqli_fetch_assoc($result)){
                            $data .='<tr>
                            <td>'.++$count.'</td>
                            <td>'.$rows['firstname'].'</td>
                            <td>'.$rows['lastname'].'</td>
                            <td>'.$rows['class'].'</td>
                            <td>'.$rows['address'].'</td>
                            <td>'.$rows['phone'].'</td>
                            <td><button class="btn btn-success" onclick="editrecord('.$rows['id'].')">Edit</button>
                            <button class="btn btn-danger" onclick="deleterecord('.$rows['id'].')">Delete</button></td>
                            </tr>';
                        }
                    }
                    $data .='</table>';
                    echo $data;
                }
                else{
                    echo "<script>alert('select class');</script>";
                }
            }
        
            if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['classs']) && isset($_POST['address']) && isset($_POST['phone'])){
                $response=array();
                $firstname=$_POST['firstname'];
                $classs =$_POST['classs'];
                $result=mysqli_query($conn,"SELECT * FROM `studentlist` WHERE class='$classs' AND firstname='$firstname' ");
                if(mysqli_num_rows($result)>0){
                    $response['message']="same firstname";
                }else{
                    $result=mysqli_query($conn,"INSERT INTO `studentlist`(`firstname`, `lastname`, `address`, `phone`, `class`) VALUES ( '$firstname' , '$lastname' , '$address' , '$phone' , '$classs')");
                    if($result){
                        $response['message']="success";
                    }else{
                        $response['message']="some internet issue";
                    }
                }
            
                echo json_encode($response);
            }
        
            if(isset($_POST['deleteid'])){
                $result=mysqli_query($conn,"DELETE FROM `studentlist` WHERE id =$deleteid");
            }
        
            if(isset($_POST['editid']) && isset($_POST['editid'])!=""){
                $response=array();
                $result=mysqli_query($conn,"SELECT *FROM `studentlist` WHERE id='$editid' ");
                if(mysqli_num_rows($result)>0){
                    while($rows=mysqli_fetch_assoc($result)){
                        $response=$rows;
                    }
                }
                else{
                    $response['status']=200;
                    $response['message']="Data not Found";
                }
        
                echo json_encode($response);
            }else{
                $response['status']=200;
                $response['message']="Invalid Id";
            }
        
            if(isset($_POST['updatekey'])){
                $updatekey=$_POST['updatekey'];
                $updatedphone=$_POST['updatedphone'];
                $updatedaddress=$_POST['updatedaddress'];
                $updatedclasss=$_POST['updatedclasss'];
                $updatedlastname=$_POST['updatedlastname'];
                $updatedfirstname=$_POST['updatedfirstname'];
                $result=mysqli_query($conn,"UPDATE `studentlist` SET `firstname`='$updatedfirstname',`lastname`='$updatedlastname',`address`='$updatedaddress',`phone`='$updatedphone',`class`='$updatedclasss' WHERE id='$updatekey' ");
                
            }
        }
    }else{
        echo "<script>alert('Please login first.'); window.location='index.html'</script>";
    }
    

?>
<?php
    include 'connection.php';
    $conn=OpenCon();
    extract($_POST);
    if(isset($_POST['classs'])){
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
        $result=mysqli_query($conn,"INSERT INTO `studentlist`(`firstname`, `lastname`, `address`, `phone`, `class`) VALUES ( '$firstname' , '$lastname' , '$address' , '$phone' , '$classs')");
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

?>
<?php
    include 'connection.php';
    $conn=OpenCon();
    extract($_POST);
    if(isset($_POST['read'])){
        $data =  '<table class="table table-hover">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Mobile</th>
                            <th>Modify</th>
                        </tr>';
        $result=mysqli_query($conn,"SELECT *FROM teachers ORDER BY name");
        if(mysqli_num_rows($result)>0){
            $count=0;
            while($rows=mysqli_fetch_assoc($result)){
                $data .='<tr>
                <td>'.++$count.'</td>
                <td>'.$rows['name'].'</td>
                <td>'.$rows['email'].'</td>
                <td>'.$rows['username'].'</td>
                <td>'.$rows['password'].'</td>
                <td>'.$rows['mobile'].'</td>
                <td><button class="btn btn-success" onclick="editrecord('.$rows['id'].')">Edit</button>
                <button class="btn btn-danger" onclick="deleterecord('.$rows['id'].')">Delete</button></td>
                </tr>';
            }
        }
        $data .='</table>';
        echo $data;
    }

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['mobile'])){
        $response=array();
        $name=$_POST['name'];
        $result=mysqli_query($conn,"SELECT * FROM `teachers` WHERE name='$name' ");
        if(mysqli_num_rows($result)>0){
            $response['message']="already teacher";
        }else{
            $result=mysqli_query($conn,"INSERT INTO `teachers`(`name`, `email`, `username`, `password`, `mobile`) VALUES ( '$name' , '$email' , '$username' , '$password' , '$mobile')");
            $response['message']="success";
        }
        echo json_encode($response);
    }

    if(isset($_POST['deleteid'])){
        $result=mysqli_query($conn,"DELETE FROM teachers WHERE id =$deleteid");
        $results=mysqli_query($conn,"DELETE FROM `teachersallotted` WHERE teacher_id=$deleteid");
    }

    if(isset($_POST['editid']) && isset($_POST['editid'])!=""){
        $response=array();
        $result=mysqli_query($conn,"SELECT *FROM teachers WHERE id='$editid' ");
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
        $updatedmobile=$_POST['updatedmobile'];
        $updatedpassword=$_POST['updatedpassword'];
        $updatedusername=$_POST['updatedusername'];
        $updatedemail=$_POST['updatedemail'];
        $updatedname=$_POST['updatedname'];
        $result=mysqli_query($conn,"UPDATE `teachers` SET `name`='$updatedname',`email`='$updatedemail',`username`='$updatedusername',`password`='$updatedpassword',`mobile`='$updatedmobile' WHERE id='$updatekey' ");
        
    }

?>
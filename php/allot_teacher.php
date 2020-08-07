<?php
    session_start();
    include 'connection.php';
    $conn=OpenCon();

    if(isset($_SESSION['loggedin'])){
        $duration=$_SESSION['loggedin']['duration'];
        $start=$_SESSION['loggedin']['start'];
        if((time()-$start)>$duration){
            unset($_SESSION['loggedin']['duration']);
            unset($_SESSION['loggedin']['start']);
            unset($_SESSION['loggedin']);
            unset($_SESSION['name']);
            echo "<script>alert('Your session has been expired. Please login again.'); window.location='index.html'</script>";
            exit;
        }else{

            if(isset($_POST['read'])){
                $result=mysqli_query($conn,"SELECT * FROM `teachersallotted` ORDER BY name ");
                $data = '<table class="table table-hover">
                            <tr>
                                <th>S.No</th>
                                <th>Teacher Name</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Modify</th>
                            </tr>';
                            if(mysqli_num_rows($result)>0){
                                $count=0;
                                while($rows=mysqli_fetch_assoc($result)){
                                    $data .='<tr>
                                                <td>'.++$count.'</td>
                                                <td>'.$rows['name'].'</td>
                                                <td>'.$rows['subject'].'</td>
                                                <td>'.$rows['class'].'</td>
                                                <td><button class="btn btn-success" onclick="editrecord('.$rows['id'].')">Edit</button>
                                                <button class="btn btn-danger" onclick="deleterecord('.$rows['id'].','.$rows['teacher_id'].')">Delete</button></td>
                                            </tr>';
                                }
                            }
                            $data .='</table>';
                            echo $data;
            }elseif(isset($_POST['editid'])){
        
                $response=array();
                $editid=$_POST['editid'];
                $result=mysqli_query($conn,"SELECT * FROM `teachersallotted` WHERE id=$editid");
                if(mysqli_num_rows($result)>0){
                    while($rows=mysqli_fetch_assoc($result)){
                        $response=$rows;
                    }
                }else{
                    $response['status']=200;
                    $response['message']="No Data found";
                }
                echo json_encode($response);
                
            }elseif(isset($_POST['key']) && isset($_POST['updateclasss']) && isset($_POST['updatesubject']) && isset($_POST['updateteachername'])){
                $response=array();
                $key=$_POST['key'];
                $updateclasss=$_POST['updateclasss'];
                $updatesubject=$_POST['updatesubject'];
                $updateteachername=$_POST['updateteachername'];
        
                $result=mysqli_query($conn,"SELECT * FROM `teachers` WHERE name='$updateteachername' ");
                if(mysqli_num_rows($result)>0){
                    $rows=mysqli_fetch_assoc($result);
                    $teacher_id=$rows['id'];
                    $result=mysqli_query($conn,"UPDATE `teachersallotted` SET `teacher_id`=$teacher_id,`name`='$updateteachername',`class`='$updateclasss',`subject`='$updatesubject' WHERE id=$key ");
                    $response['message']="success";
        
                }else{
                    $response['message']="not found";
                }
                echo json_encode($response);
        
            }elseif(isset($_POST['deleteid'])){
                $deleteid = $_POST['deleteid'];
                $result=mysqli_query($conn,"DELETE FROM `teachersallotted` WHERE id = $deleteid ");
        
            }elseif(isset($_POST['classs']) && isset($_POST['subject']) && isset($_POST['teachername'])){
                $response=array();
                $classs=$_POST['classs'];
                $subject=$_POST['subject'];
                $teachername=$_POST['teachername'];
        
                $result=mysqli_query($conn,"SELECT * FROM `teachers` WHERE name='$teachername' ");
                if(mysqli_num_rows($result)>0){
                    $results=mysqli_query($conn,"SELECT * FROM `teachersallotted` WHERE subject='$subject' AND class='$classs' ");
                    if(mysqli_num_rows($results)>0){
                        $row=mysqli_fetch_assoc($results);
                        $nam=$row['name'];
                        $response['message']="already";
                        $response['nam']=$nam;                
                    }else{
                        $rows=mysqli_fetch_assoc($result);
                        $teacher_id=$rows['id'];
                        $result=mysqli_query($conn,"INSERT INTO `teachersallotted`(`teacher_id`, `name`, `class`, `subject`) VALUES ($teacher_id,'$teachername', '$classs','$subject') ");
                        $response['message']="success";
                    }
        
                }else{
                    $response['message']="not found";
                }
                echo json_encode($response);
            }

        }
    }else{
        echo "<script>alert('Please login first.'); window.location='index.html'</script>";
    }
    
?>
<?php
    include 'connection.php';
    $conn=OpenCon();

    if(isset($_POST['classs']) && isset($_POST['subject']) && isset($_POST['date'])){
        $classs=$_POST['classs'];
        $subject=$_POST['subject'];
        $date=$_POST['date'];

        $result=mysqli_query($conn,"SELECT * FROM `attandance` WHERE date='$date' AND class='$classs' AND subject='$subject' ORDER BY firstname");
        if(mysqli_num_rows($result)>0){
            $data = '<table class="table table-hover">
                        <tr>
                            <th>S.No</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Attendance</th>
                            <th>Modify</th>
                        </tr>';
                        $count=0;
                        while($rows=mysqli_fetch_assoc($result)){
                            $data .='<tr>
                                        <td>'.++$count.'</td>
                                        <td>'.$rows['firstname'].'</td>
                                        <td>'.$rows['lastname'].'</td>
                                        <td>'.$rows['class'].'</td>
                                        <td>'.$rows['subject'].'</td>
                                        <td>'.$rows['date'].'</td>
                                        <td>'.$rows['attandance'].'</td>
                                        <td><button class="btn btn-success" onclick="change('.$rows['id'].')">Change</button></td>
                                    </tr>';
                        }
                        $data .='</table>';
                        echo $data;           
        }else{
            $data="";
        }
    }elseif(isset($_POST['id'])){
        $id=$_POST['id'];
        $result=mysqli_query($conn,"SELECT * FROM `attandance` WHERE id='$id' ");
        $response=array();
        
        if(mysqli_num_rows($result)>0){
            while($rows=mysqli_fetch_assoc($result)){
                $response=$rows;
            }
        }else{
            $response['status']=200;
            $response['message']="Data not found";
        }
        echo json_encode($response);

    }elseif(isset($_POST['key'])&&isset($_POST['attendance'])){
        $key=$_POST['key'];
        $attendance=$_POST['attendance'];
        $result=mysqli_query($conn,"UPDATE `attandance` SET `attandance`='$attendance' WHERE id='$key' ");
    }
?>
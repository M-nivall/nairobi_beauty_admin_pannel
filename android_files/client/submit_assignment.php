<?php

 if($_SERVER['REQUEST_METHOD']=='POST'){

    include '../../include/connections.php';


         $userId=$_POST['userId'];
         //$subjectId=$_POST['subjectId'];
         //$title=$_POST['title'];
         //$details=$_POST['details'];
        $originalImgName= $_FILES['filename']['name'];
        $tempName= $_FILES['filename']['tmp_name'];
        $folder="../submited_assignments/";
        
                // get Trainee details where id = $userId
                $select = "SELECT first_name,last_name FROM clients WHERE client_id='$userId'";
                $qury = mysqli_query($con, $select);
                $row = mysqli_fetch_array($qury);
                $names =  $row['first_name'].' '.$row['last_name']; //full names

        if(move_uploaded_file($tempName,$folder.$originalImgName)){
                $query = "INSERT INTO submitted_assignment (trainee_id,full_names, assignment_name)
                     VALUES ('$userId','$names','$originalImgName')";
                if(mysqli_query($con,$query)){
                $response['status']='1';
                $response['message']='Assignment Submited Successfully';

                }else{
                    $response['status']='0';
                    $response['message']='Failed to submit assignment';
                }
        	//echo "moved to ".$url;
        }else{
            $response['status']='0';
            $response['message']='Failed to save pdf file';
        }
        print json_encode($response);
  }
?>
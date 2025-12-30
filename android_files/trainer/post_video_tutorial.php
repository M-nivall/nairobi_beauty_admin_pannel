<?php

 if($_SERVER['REQUEST_METHOD']=='POST'){

    include '../../include/connections.php';
  	  	

         $userID=$_POST['userId'];
         $subjectId=$_POST['subjectId'];
         $title=$_POST['title'];
         $details=$_POST['details'];
        $originalImgName= $_FILES['filename']['name'];
        $tempName= $_FILES['filename']['tmp_name'];
        $folder="../upload_videos/";
        
        if(move_uploaded_file($tempName,$folder.$originalImgName)){
                $query = "INSERT INTO tutorials(unit_id,emp_id, title, details, video_link,tutorial_status)
                     VALUES ('$subjectId','$userID','$title','$details','$originalImgName','Video')";
                if(mysqli_query($con,$query)){
                $response['status']='1';
                $response['message']='Submitted successfully';

                }else{
                    $response['status']='0';
                    $response['message']='Failed to submit advert';
                }
        	//echo "moved to ".$url;
        }else{
            $response['status']='0';
            $response['message']='Failed to save video file';
        }
        print json_encode($response);
  }
?>
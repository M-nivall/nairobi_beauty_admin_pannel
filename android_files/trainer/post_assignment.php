<?php

 if($_SERVER['REQUEST_METHOD']=='POST'){

    include '../../include/connections.php';


         $userId=$_POST['userId'];
         //$subjectId=$_POST['subjectId'];
         $title=$_POST['title'];
         //$details=$_POST['details'];
        $originalImgName= $_FILES['filename']['name'];
        $tempName= $_FILES['filename']['tmp_name'];
        $folder="../upload_assignments/";
       // $url = "https://www.demonuts.com/Demonuts/JsonTest/Tennis/uploadedFiles/".$originalImgName; //update path as per your directory structure
//        $url = "http://192.168.232.225/hustle_free/pdf_upload/uploadedFiles/".$originalImgName;
        if(move_uploaded_file($tempName,$folder.$originalImgName)){
                $query = "INSERT INTO assignments (emp_id, title, pdf_name,status)
                     VALUES ('$userId','$title','$originalImgName','Assignment')";
                if(mysqli_query($con,$query)){
                $response['status']='1';
                $response['message']='Assignment Uploaded Successfully';

                }else{
                    $response['status']='0';
                    $response['message']='Failed to Upload';
                }
        	//echo "moved to ".$url;
        }else{
            $response['status']='0';
            $response['message']='Failed to Upload';
        }
        print json_encode($response);
  }
?>
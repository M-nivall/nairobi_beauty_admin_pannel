<?php

 if($_SERVER['REQUEST_METHOD']=='POST'){

    include '../../include/connections.php';


         $userId=$_POST['userId'];
         $subjectId=$_POST['subjectId'];
         $title=$_POST['title'];
         $details=$_POST['details'];
        $originalImgName= $_FILES['filename']['name'];
        $tempName= $_FILES['filename']['tmp_name'];
        $folder="../upload_pdf/";
       // $url = "https://www.demonuts.com/Demonuts/JsonTest/Tennis/uploadedFiles/".$originalImgName; //update path as per your directory structure
//        $url = "http://192.168.232.225/hustle_free/pdf_upload/uploadedFiles/".$originalImgName;
        if(move_uploaded_file($tempName,$folder.$originalImgName)){
                $query = "INSERT INTO tutorials (emp_id,unit_id, title, details, pdf_notes,tutorial_status)
                     VALUES ('$userId','$subjectId','$title','$details','$originalImgName','Pdf')";
                if(mysqli_query($con,$query)){
                $response['status']='1';
                $response['message']='Pdf submitted successfully';

                }else{
                    $response['status']='0';
                    $response['message']='Failed to submit PDF details';
                }
        	//echo "moved to ".$url;
        }else{
            $response['status']='0';
            $response['message']='Failed to save pdf file';
        }
        print json_encode($response);
  }
?>
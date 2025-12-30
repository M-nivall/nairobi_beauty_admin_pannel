<?php

include "../../include/connections.php";


     $update="UPDATE request SET request_status='Approved'";

     if(mysqli_query($con,$update)){

         $response['status']=1;
         $response['message']='Item Request Approved';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
     
?>
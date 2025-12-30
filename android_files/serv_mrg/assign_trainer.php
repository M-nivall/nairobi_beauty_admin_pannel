<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $bookingID=$_POST['bookingID'];
     $clientID=$_POST['clientID'];
     $username=$_POST['username'];

     $select="SELECT * FROM employees WHERE username='$username'";
     $query=mysqli_query($con,$select);
     $row=mysqli_fetch_array($query);

     $trainerID=$row['emp_id'];

     $update = "UPDATE bookings SET booking_status = '3' WHERE booking_id='$bookingID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO trainer_sessions ( trainer_id, booking_id, client_id) VALUES ('$trainerID','$bookingID','$clientID')";
         mysqli_query($con,$insert);

         $response['status']=1;
         $response['message']='Assigned Successfully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>
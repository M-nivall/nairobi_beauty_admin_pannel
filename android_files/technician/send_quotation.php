<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $amount=$_POST['amount'];
     $materials=$_POST['materials'];


     $update="UPDATE bookings SET order_status='4'WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $update="UPDATE assign SET assign_status='Arrived' , materials ='$materials' WHERE order_id='$orderID'";
         mysqli_query($con,$update);

        $update2="UPDATE order_items SET item_price='$amount' WHERE order_id='$orderID'";
         mysqli_query($con,$update2);

         $response['status']=1;
         $response['message']='Quotation Sent, Client Will Recieve an Invoice :Materials requested from Stock Manager ';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>
<?php

include '../../include/connections.php';

$supplier=$_POST['supplier'];
$item=$_POST['item'];
$quantity=$_POST['quantity'];

$request_date = date("Y-m-d");

  $select="SELECT * FROM clients WHERE username = '$supplier'";
  $query=mysqli_query($con,$select);
  $row=mysqli_fetch_array($query);
  $id=$row["client_id"];

   $insert="INSERT INTO request (client_id, items, quantity, request_date)VALUES ('$id','$item','$quantity', '$request_date')";
  if(mysqli_query($con,$insert)){
    $response['status']=1;
    $response['message']='Request Sent successfully';
    }else{
    $response['status']=0;
    $response['message']='Please try again. Something went wrong';
  }
echo json_encode($response);

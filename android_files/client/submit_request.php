<?php
include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$clientID=$_POST['clientID'];
$course=$_POST['course'];
$courseID=$_POST['courseID'];
$studyMode=$_POST['studyMode'];
$paymentMethod=$_POST['paymentMethod'];
$paymentCode=$_POST['payment_code'];
$fee=$_POST['fee'];
$duration=$_POST['duration'];
$startingDate=$_POST['startingDate'];

$bookingDate = date("Y-m-d");

$insert = "INSERT INTO bookings (client_id, course, course_id, study_mode, fee, duration, starting_date, payment_method, payment_code, booking_date) 
               VALUES ('$clientID', '$course', '$courseID', '$studyMode', '$fee', '$duration', '$startingDate', '$paymentMethod', '$paymentCode', '$bookingDate')";
if(mysqli_query($con,$insert)){

    $response['status']=1;
    $response['message']='Submited Successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>
<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

//$id=$_POST['requestID'];

$update="UPDATE  exam_status SET status='unlocked' ";
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Trainees are now allowed to take exam quiz';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>
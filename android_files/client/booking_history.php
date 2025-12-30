<?php

include '../../include/connections.php';

$clientID=$_POST['clientID'];

$select = "SELECT b.booking_id,b.course,b.study_mode,b.fee,b.duration,b.starting_date,b.payment_method,b.payment_code,b.booking_date,
          b.booking_status,c.first_name,c.last_name,c.phone_no,c.phone_no,c.remarks
          FROM bookings b 
          RIGHT JOIN clients c on b.client_id = c.client_id 
          WHERE b.client_id = '$clientID' 
          ORDER BY b.booking_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Booking History";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['bookingID'] = $row['booking_id'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];
          $temp['phoneNo'] = $row['phone_no'];
          $temp['course'] = $row['course'];
          $temp['studyMode'] = $row['study_mode'];
          $temp['fee'] = $row['fee'];
          $temp['duration'] = $row['duration'];
          $temp['startingDate'] = $row['starting_date'];
          $temp['paymentMethod'] = $row['payment_method'];
          $temp['paymentCode'] = $row['payment_code'];
          $temp['bookingDate'] = $row['booking_date'];
          $temp['remarks'] = $row['remarks'];
         

        if($row['booking_status']==1){
            $temp['bookingStatus'] = "Pending Aprroval";
        }elseif ($row['booking_status']==2){
            $temp['bookingStatus'] = "Approved";
        }elseif ( $row['booking_status']==3){
            $temp['bookingStatus'] = "Learning";
        }elseif ($row['booking_status']==4){
            $temp['bookingStatus'] = "Completed";
        }elseif ($row['booking_status']==5){
            $temp['bookingStatus'] = "Graduated";
        }


          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing found";

}
//displaying the result in json format
echo json_encode($results);

?>
<?php

include '../../include/connections.php';




//creating a query
$select = "SELECT b.booking_id,b.client_id,b.course,b.course_id,b.study_mode,b.fee,b.duration,
          b.starting_date,b.payment_method,b.payment_code,b.booking_date,c.first_name,c.last_name,c.phone_no
          FROM bookings b 
          INNER JOIN clients c on b.client_id = c.client_id 
          WHERE b.booking_status = '1'
          ORDER BY b.booking_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="New Payments";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['bookingID'] = $row['booking_id'];
          $temp['clientID'] = $row['client_id'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];
          $temp['course'] = $row['course'];
          $temp['studyMode'] = $row['study_mode'];
          $temp['fee'] = $row['fee'];
          $temp['duration'] = $row['duration'];
          $temp['startingDate'] = $row['starting_date'];
          $temp['paymentMethod'] = $row['payment_method'];
          $temp['paymentCode'] = $row['payment_code'];
          $temp['bookingDate'] = $row['booking_date'];
          $temp['phoneNo'] = $row['phone_no'];
          $temp['bookingStatus'] = "Pending Approval";

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No record found";

}
//displaying the result in json format
echo json_encode($results);


?>
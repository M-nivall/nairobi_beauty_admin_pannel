<?php

include '../../include/connections.php';

$trainerID=$_POST['trainerID'];

// creating a query
$select = "SELECT t.client_id, t.trainer_id, c.first_name, c.last_name, c.email, c.phone_no,b.starting_date
           FROM trainer_sessions t 
           INNER JOIN clients c on t.client_id = c.client_id
           INNER JOIN bookings b ON t.booking_id = b.booking_id
           WHERE t.trainer_id = '$trainerID'
           ORDER BY c.client_id ASC";

$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {
    $results = array();
    $results['status'] = "1";
    $results['responseData'] = array(); 
    $results['message'] = "Assigned Trainees";

    while ($row = mysqli_fetch_array($query)) {
        $temp = array();

        $temp['trainee_id'] = $row['client_id'];
        $temp['traineeNames'] = $row['first_name'] . ' ' . $row['last_name'];
        $temp['email'] = $row['email'];
        $temp['phone_no'] = $row['phone_no'];
         $temp['starting_date'] = $row['starting_date'];

        array_push($results['responseData'], $temp); // Push to 'responseData'
    }

} else {
    $results['status'] = "0";
    $results['message'] = "Nothing more found";
}

// displaying the result in JSON format
echo json_encode($results);

// Closing the database connection
mysqli_close($con);

?>

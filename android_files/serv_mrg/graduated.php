<?php

include '../../include/connections.php';

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Creating a query
$select = "
    SELECT 
        b.booking_id,
        b.client_id,
        b.course,
        b.study_mode,
        b.fee,
        b.duration,
        b.starting_date,
        b.payment_method,
        b.payment_code,
        b.booking_date,
        b.rating,
        e.exam_marks,
        e.theory_marks,
        a.marks,
        cert.certificate_no,
        c.first_name,
        c.last_name,
        c.phone_no
    FROM 
        bookings b
    INNER JOIN 
        clients c ON b.client_id = c.client_id  
    INNER JOIN 
        exam_scores e ON b.client_id = e.trainee_id 
    INNER JOIN 
        assignment_marks a ON b.client_id = a.trainee_id  
    INNER JOIN 
        certificate_details cert ON b.client_id = cert.trainee_id      
    WHERE
         b.booking_status = '4'  
";

$query = mysqli_query($con, $select);

// Check for query execution errors
if (!$query) {
    $results['status'] = "0";
    $results['message'] = "Query error: " . mysqli_error($con);
    echo json_encode($results);
    exit;
}

if (mysqli_num_rows($query) > 0) {
    $results = array();
    $results['status'] = "1";
    $results['responseData'] = array();
    $results['message'] = "Trainees Grades";

    while ($row = mysqli_fetch_array($query)) {
        $temp = array();
        $temp['bookingID'] = $row['booking_id'];
        $temp['clientID'] = $row['client_id'];
        $temp['course'] = $row['course'];
        $temp['studyMode'] = $row['study_mode'];
        $temp['fee'] = $row['fee'];
        $temp['duration'] = $row['duration'];
        $temp['traineeNames'] = $row['first_name'] . ' ' . $row['last_name']; 
        $temp['phoneNo'] = $row['phone_no'];
        $temp['startingDate'] = $row['starting_date'];
        $temp['paymentMethod'] = $row['payment_method'];
        $temp['paymentCode'] = $row['payment_code'];
        $temp['bookingDate'] = $row['booking_date'];
        $temp['rating'] = $row['rating'];
        $temp['examMarks'] = $row['exam_marks'];
        $temp['practicalMarks'] = $row['theory_marks'];
        $temp['assignmentMarks'] = $row['marks'];
        $temp['finalScore'] = $row['exam_marks'] + $row['theory_marks'] + $row['marks'];;
        $temp['certificateNo'] = $row['certificate_no'];

        array_push($results['responseData'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "Nothing more found";
}

// Displaying the result in JSON format
echo json_encode($results);

// Closing the database connection
mysqli_close($con);

?>

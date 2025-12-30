<?php
include '../../include/connections.php';

// Initialize response array
$response = array();

// SQL query with INNER JOIN
$sql = "SELECT a.id, a.topic, a.trainer_id, a.session_date, a.attendance_status, e.f_name, e.l_name
        FROM attendance_session a 
        INNER JOIN employees e ON a.trainer_id = e.emp_id";

$select = mysqli_query($con, $sql);

// Check if any records are found
if (mysqli_num_rows($select) > 0) {
    $response['status'] = 1;
    $response['responseData'] = array();

    // Fetch data from the query result
    while ($row = mysqli_fetch_assoc($select)) {
        $index = array();
        $index['Id'] = $row['id'];
        $index['topic'] = $row['topic'];
        $index['instructorID'] = $row['trainer_id'];
        $temp['instructorName'] = $row['f_name'].' '.$row['l_name'];
        $index['sessionDate'] = $row['session_date'];

        // Add the record to the response data array
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "Nothing found";
}

// Output the JSON response
echo json_encode($response);

// Close the database connection
$con->close();
?>

<?php

include '../../include/connections.php';

$clientID = $_POST['userID'];

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Creating a query
$select = "
    SELECT 
        e.trainee_id,
        e.exam_marks,
        c.client_id,
        c.first_name,
        c.last_name,
        e.theory_marks,
        a.marks
    FROM 
        exam_scores e    
    INNER JOIN 
        clients c ON e.trainee_id = c.client_id 
    INNER JOIN assignment_marks a ON e.trainee_id = a.trainee_id
    WHERE a.trainee_id = '$clientID' AND e.theory_marks != 0   
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
        $temp['trainee_id'] = $row['trainee_id'];
        $temp['traineeNames'] = $row['first_name'] . ' ' . $row['last_name']; // Combine first and last names
        $temp['assignment_marks'] = $row['marks'];
        $temp['exam_marks'] = $row['exam_marks'];
        $temp['theory_marks'] = $row['theory_marks'];
        $temp['totalScore'] = $row['theory_marks'] +  $row['exam_marks'] +  $row['marks'];

        array_push($results['responseData'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "Nothing found";
}

// Displaying the result in JSON format
echo json_encode($results);

// Closing the database connection
mysqli_close($con);

?>

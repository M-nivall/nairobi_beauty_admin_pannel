<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $traineeID = $_POST['traineeID'];
    $marks = $_POST['marks'];

    // Prepare current date (YYYY-MM-DD format)
    $currentDate = date('Y-m-d');

    // Check for missing fields
    if (empty($traineeID) || empty($marks)) {
        $response = [
            'status' => 0,
            'message' => 'Missing required fields'
        ];
        echo json_encode($response);
        exit;
    }

    // SQL query to insert data into assignment_marks table
    $sql = "INSERT INTO assignment_marks (trainee_id, marks, date_submitted) 
            VALUES ('$traineeID', '$marks', '$currentDate')";

    // Execute query
    if (mysqli_query($con, $sql)) {
        $response = [
            'status' => 1,
            'message' => 'Marks submitted successfully'
        ];
    } else {
        $response = [
            'status' => 0,
            'message' => 'Failed to submit marks: ' . mysqli_error($con)
        ];
    }

    // Return response in JSON format
    echo json_encode($response);
} else {
    // Handle invalid request method
    $response = [
        'status' => 0,
        'message' => 'Invalid request method'
    ];
    echo json_encode($response);
}

// Close database connection
mysqli_close($con);
?>

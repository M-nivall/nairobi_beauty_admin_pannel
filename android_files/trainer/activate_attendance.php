<?php
include '../../include/connections.php';

// Set headers for JSON response
header('Content-Type: application/json');

// Initialize response array
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST parameters
    $topic = isset($_POST['topic']) ? $_POST['topic'] : '';
    $instructorID = isset($_POST['instructorID']) ? $_POST['instructorID'] : '';
    
    // Check if required fields are not empty
    if (!empty($topic) && !empty($instructorID)) {
        // Get the current date in 'Y-m-d' format
        $currentDate = date('Y-m-d');

        // Prepare the SQL statement to insert data
        $sql = "INSERT INTO attendance_session (topic, trainer_id, session_date) VALUES (?, ?, ?)";
        
        // Prepare and execute the statement
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("sss", $topic, $instructorID, $currentDate);

            // Execute the statement and check if the insertion was successful
            if ($stmt->execute()) {
                $response['status'] = "1";
                $response['message'] = "Attendance session activated successfully";
            } else {
                $response['status'] = "0";
                $response['message'] = "Failed to activate attendance session";
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            $response['status'] = "0";
            $response['message'] = "SQL error: Could not prepare statement";
        }
    } else {
        $response['status'] = "0";
        $response['message'] = "All fields are required";
    }
} else {
    $response['status'] = "0";
    $response['message'] = "Invalid request method";
}

// Output the JSON response
echo json_encode($response);

// Close the database connection
$con->close();
?>

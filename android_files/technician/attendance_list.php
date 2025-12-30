<?php
include '../../include/connections.php';

// Create an empty response array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if sessionId is set
    if (isset($_POST['sessionId'])) {
        $sessionId = $_POST['sessionId'];

    
        $sql = "SELECT client_id, full_name FROM attendance_list WHERE session_id = ?";
        
        // Prepare the statement
        if ($stmt = $con->prepare($sql)) {
            // Bind the parameter
            $stmt->bind_param("s", $sessionId);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $result = $stmt->get_result();

            // Check if data is found
            if ($result->num_rows > 0) {
                $responseData = array();
                
                while ($row = $result->fetch_assoc()) {
                    $data = array(
                        "traineeId" => $row['client_id'],
                        "traineeName" => $row['full_name']
                    );
                    array_push($responseData, $data);
                }

                // Response success
                $response['status'] = 1;
                $response['message'] = "Data retrieved successfully";
                $response['responseData'] = $responseData;
            } else {
                // No data found
                $response['status'] = 0;
                $response['message'] = "No data found for this session";
            }
            $stmt->close();
        } else {
            // Error preparing the SQL statement
            $response['status'] = 0;
            $response['message'] = "Failed to prepare SQL statement";
        }
    } else {
        // sessionId not provided in the request
        $response['status'] = 0;
        $response['message'] = "Missing sessionId parameter";
    }
} else {
    // Invalid request method
    $response['status'] = 0;
    $response['message'] = "Invalid request method";
}

// Send JSON response
echo json_encode($response);

// Close the database connection
$con->close();
?>

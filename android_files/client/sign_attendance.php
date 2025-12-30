<?php
include '../../include/connections.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionId = $_POST['sessionId'];
    $userID = $_POST['userID'];

    // Check if attendance already exists
    $checkQuery = "SELECT * FROM attendance_list WHERE session_id = ? AND client_id = ?";
    $checkStmt = $con->prepare($checkQuery);
    $checkStmt->bind_param("ss", $sessionId, $userID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $response['status'] = '0';
        $response['message'] = 'Attendance already signed';
    } else {
        // Fetch full name from clients table
        $query = "SELECT first_name, last_name FROM clients WHERE client_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $userID);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fullName = $row['first_name'] . ' ' . $row['last_name'];
                $currentDate = date('Y-m-d H:i:s');

                // Insert into attendance_list
                $insertQuery = "INSERT INTO attendance_list (session_id, client_id, full_name, attendance_date) 
                                VALUES (?, ?, ?, ?)";
                $insertStmt = $con->prepare($insertQuery);
                $insertStmt->bind_param("ssss", $sessionId, $userID, $fullName, $currentDate);

                if ($insertStmt->execute()) {
                    $response['status'] = '1';
                    $response['message'] = 'Attendance signed successfully';
                } else {
                    $response['status'] = '0';
                    $response['message'] = 'Failed to sign attendance';
                }
                $insertStmt->close();
            } else {
                $response['status'] = '0';
                $response['message'] = 'User not found';
            }
            $stmt->close();
        } else {
            $response['status'] = '0';
            $response['message'] = 'Failed to fetch user details';
        }
    }
    $checkStmt->close();
} else {
    $response['status'] = '0';
    $response['message'] = 'Invalid request method';
}

$con->close();
echo json_encode($response);
?>

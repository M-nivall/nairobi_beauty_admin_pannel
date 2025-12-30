<?php
include '../../include/connections.php';

$response = array();

if (isset($_POST['bookingID']) && isset($_POST['trainerID']) && isset($_POST['rating'])) {
    
    $bookingID = $_POST['bookingID'];
    $trainerID = $_POST['trainerID'];
    $rating = $_POST['rating'];

    // Prepare the SQL query to update the rating
    $sql = "UPDATE bookings SET rating = ? WHERE booking_id = ? AND client_id = ?";

    if ($stmt = $con->prepare($sql)) {
        
        $stmt->bind_param("sss", $rating, $bookingID, $trainerID);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                
                // Now update booking_status to 4
                $sql_update_status = "UPDATE bookings SET booking_status = 4 WHERE booking_id = ? AND client_id = ?";
                if ($stmt2 = $con->prepare($sql_update_status)) {
                    
                    $stmt2->bind_param("ss", $bookingID, $trainerID);

                    if ($stmt2->execute()) {
                        if ($stmt2->affected_rows > 0) {
                            $response['status'] = "success";
                            $response['message'] = "Thank you for choosing Nairobi Beauty World.";
                        } else {
                            $response['status'] = "failure";
                            $response['message'] = "Rating saved but booking status not updated.";
                        }
                    } else {
                        $response['status'] = "failure";
                        $response['message'] = "Failed to update booking status.";
                    }

                    $stmt2->close();
                } else {
                    $response['status'] = "failure";
                    $response['message'] = "Failed to prepare booking status update.";
                }

            } else {
                $response['status'] = "failure";
                $response['message'] = "Something went wrong.";
            }
        } else {
            $response['status'] = "failure";
            $response['message'] = "Failed to execute rating update.";
        }

        $stmt->close();
    } else {
        $response['status'] = "failure";
        $response['message'] = "Failed to prepare rating update.";
    }

} else {
    $response['status'] = "failure";
    $response['message'] = "Something went wrong....";
}

echo json_encode($response);

$con->close();
?>

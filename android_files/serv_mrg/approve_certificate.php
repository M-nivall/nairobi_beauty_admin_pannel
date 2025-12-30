<?php
include "../../include/connections.php";

// Set response header to JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainee_id = $_POST['trainee_id'];

    // Generate certificate number
    $datePart = date("Ymd");
    $randomPart = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
    $certificate_code = "CERT-" . $datePart . "-" . $randomPart;

    // Insert into certificate_details table
    $sql_insert = "INSERT INTO certificate_details (trainee_id, certificate_no) 
                   VALUES ('$trainee_id', '$certificate_code')";

    if ($con->query($sql_insert) === TRUE) {
        // First update exam_scores
        $sql_update_exam = "UPDATE exam_scores SET grading_status = 2 WHERE trainee_id = '$trainee_id'";

        if ($con->query($sql_update_exam) === TRUE) {
            // Second update bookings
            $sql_update_clients = "UPDATE clients SET remarks = 2 WHERE client_id = '$trainee_id'";

            if ($con->query($sql_update_clients) === TRUE) {
                echo json_encode(array(
                    "status" => "success",
                    "message" => "Certificate Approved Successfully",
                    "certificate_code" => $certificate_code
                ));
            } else {
                echo json_encode(array(
                    "status" => "error",
                    "message" => "Failed to update booking status: " . $con->error
                ));
            }
        } else {
            echo json_encode(array(
                "status" => "error",
                "message" => "Failed to update exam scores: " . $con->error
            ));
        }
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Error inserting certificate: " . $con->error
        ));
    }
} else {
    echo json_encode(array(
        "status" => "error",
        "message" => "Invalid Request"
    ));
}

$con->close();
?>

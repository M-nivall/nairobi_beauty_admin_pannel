<?php
include '../../include/connections.php';

// Set response header to JSON
header('Content-Type: application/json');

$clientID = $_POST['userID'];

// Creating a query with LEFT JOINs to avoid missing records
$select = "
    SELECT 
        c.client_id,
        CONCAT(c.first_name, ' ', c.last_name) AS fullName,
        cd.certificate_no 
    FROM clients c
    INNER JOIN certificate_details cd ON c.client_id = cd.trainee_id
    WHERE cd.cert_status = 'Approved'
    AND cd.trainee_id = '$clientID'";

// Execute the query
$query = mysqli_query($con, $select);

// Check if the query was successful
if ($query === false) {
    // Return error if the query failed
    echo json_encode(array("status" => "error", "message" => "Query Error: " . mysqli_error($con)));
    exit();
}

// Check if any rows were returned
if (mysqli_num_rows($query) > 0) {
    $results = array();
    $results['status'] = "1";
    $results['details'] = array();
    $results['message'] = "Certificate details";

    $currentDate = date('d-m-Y');

    while ($row = mysqli_fetch_array($query)) {
        $temp = array();

        // Populate the temp array with the fetched data
        $temp['fullName'] = $row['fullName'] ?? null; // Ensure username exists
        $temp['certificateNo'] = $row['certificate_no'] ?? null; // Ensure licence_no exists
        $temp['dateOfIssue'] = $currentDate;

        array_push($results['details'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "Not met the requirements to get certifcate";
}

// Displaying the result in JSON format
echo json_encode($results);

// Close the database connection
$con->close();
?>

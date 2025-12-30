<?php
// Database connection
include '../../include/connections.php';

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$response = array();

// Directly execute the query without checking for 'category'
$sql = "SELECT material_id, material_name, quantity FROM materials";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $response['status'] = 1;  // Indicating success
    $response['responseData'] = array();

    while ($row = $result->fetch_assoc()) {
        $index['stockID'] = $row['material_id'];
        $index['productName'] = $row['material_name'];
        $index['price'] = $row['quantity'];
        $index['stock'] = $row['quantity'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = 0;  // Indicating failure
    $response['message'] = "Nothing found";
}

// Return the stock as a JSON response
echo json_encode($response);
$con->close();
?>

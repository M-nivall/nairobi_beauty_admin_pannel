<?php
include '../../include/connections.php';

//header('Content-Type: application/json');

$trainerID = $_POST['trainerID'];
// $packageId = $_POST['packageId'];

$select = mysqli_query($con, "SELECT * FROM units");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['unitId'] = $row['unit_id'];
        $index['unitName'] = $row['unit_name'];
        $index['unitStatus'] = $row['unit_status'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "No assigned subject found";
}
print json_encode($response);
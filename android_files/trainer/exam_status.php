<?php
include "../../include/connections.php";

$query = "SELECT status FROM exam_status"; 
$result = $con->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(array("exam_status" => $row['status']));
} else {
    echo json_encode(array("exam_status" => "not found"));
}
?>

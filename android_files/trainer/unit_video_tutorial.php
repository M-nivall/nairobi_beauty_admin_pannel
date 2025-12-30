<?php
include '../../include/connections.php';

//header('Content-Type: application/json');

$subjectId = $_POST['subjectId'];
$userId = $_POST['userId'];

$select = mysqli_query($con, "SELECT * FROM units u INNER JOIN tutorials t ON u.unit_id=t.unit_id
 WHERE t.unit_id='$subjectId' AND tutorial_status='Video'");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['id'] = $row['id'];
        $index['subjectId'] = $row['unit_id'];
        $index['subjectName'] = $row['unit_name'];
        $index['title'] = $row['title'];
        $index['videoLink'] = $row['video_link'];
        $index['details'] = $row['details'];
        $index['datePosted'] = $row['date_posted'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "No record found";
}
print json_encode($response);
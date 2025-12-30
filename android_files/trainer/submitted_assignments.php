<?php
include '../../include/connections.php';

//header('Content-Type: application/json');


//$subjectId = $_POST['subjectId'];
//$userId = $_POST['userId'];

$select = mysqli_query($con, "SELECT trainee_id,full_names, assignment_name, status FROM submitted_assignment");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['trainee_id'] = $row['trainee_id'];
        $index['names'] = $row['full_names'];
        $index['pdfLink'] = $row['assignment_name'];
        $index['state'] = $row['status'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "No record found";
}
print json_encode($response);
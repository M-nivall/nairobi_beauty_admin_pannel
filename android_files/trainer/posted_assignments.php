<?php
include '../../include/connections.php';

//header('Content-Type: application/json');


//$subjectId = $_POST['subjectId'];
//$userId = $_POST['userId'];

$select = mysqli_query($con, "SELECT id,emp_id, title,pdf_name,date_posted,status FROM assignments");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['id'] = $row['id'];
        $index['title'] = $row['title'];
        $index['date_posted'] = $row['date_posted'];
        $index['pdfLink'] = $row['pdf_name'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "No record found";
}
print json_encode($response);
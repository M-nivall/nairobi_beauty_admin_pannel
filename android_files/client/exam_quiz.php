<?php
include '../../include/connections.php';

$response = array();

$select = mysqli_query($con, "SELECT s.question_id,s.correct_answer,s.multiple_1,s.multiple_2,q.question
FROM selected_questions s INNER JOIN questions q ON s.question_id = q.id");
if ($select) {
    if (mysqli_num_rows($select) > 0) {
        $response['status'] = 1;
        $response['responseData'] = array();
        
        while ($row = mysqli_fetch_array($select)) {
            $index = array(); // Reset index array for each question
            $index['id'] = $row['question_id'];
            $index['question'] = $row['question'];
            $index['correct_answer'] = $row['correct_answer'];
            $index['multiple_1'] = $row['multiple_1'];
            $index['multiple_2'] = $row['multiple_2']; // Added second multiple choice
            
            array_push($response['responseData'], $index);
        }
    } else {
        $response['status'] = 0;
        $response['message'] = "No records found";
    }
} else {
    $response['status'] = 0;
    $response['message'] = "Query failed: " . mysqli_error($con);
}

echo json_encode($response);
?>

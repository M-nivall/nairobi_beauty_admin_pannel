<?php
include '../../include/connections.php';

$response = array();

$select = mysqli_query($con, "SELECT id, question, multiple_1, multiple_2, correct_answer FROM questions");
if ($select) {
    if (mysqli_num_rows($select) > 0) {
        $response['status'] = 1;
        $response['responseData'] = array();
        
        while ($row = mysqli_fetch_array($select)) {
            $index = array(); // Reset index array for each question
            $index['id'] = $row['id'];
            $index['question'] = $row['question']; // Question text
            $index['multiple_1'] = $row['multiple_1']; // First multiple choice
            $index['multiple_2'] = $row['multiple_2']; // Second multiple choice
            $index['correct_answer'] = $row['correct_answer']; // Correct answer
            
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

<?php
include '../../include/connections.php';

$response = array();

if (isset($_POST['traineeId']) && isset($_POST['totalMarks'])) {
    $traineeId = $_POST['traineeId'];
    $totalMarks = $_POST['totalMarks'];

    // Check if the trainee already submitted
    $checkQuery = "SELECT * FROM exam_scores WHERE trainee_id = '$traineeId'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Already submitted
        $response['status'] = 0;
        $response['message'] = "You have already Attempted this Exam. Only one attempt is allowed.";
    } else {
        // Insert the score
        $query = "INSERT INTO exam_scores (trainee_id, exam_marks) VALUES ('$traineeId', '$totalMarks')";
        if (mysqli_query($con, $query)) {
            $response['status'] = 1;
            $response['message'] = "Score submitted successfully!";
        } else {
            $response['status'] = 0;
            $response['message'] = "Failed to submit score: " . mysqli_error($con);
        }
    }
} else {
    $response['status'] = 0;
    $response['message'] = "Invalid parameters";
}

echo json_encode($response);
?>

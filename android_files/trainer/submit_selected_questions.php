<?php
include '../../include/connections.php';

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedQuestions = $_POST['selectedQuestions'];
    $instructorId = $_POST['instructorId'];

    if (empty($selectedQuestions) || empty($instructorId)) {
        echo json_encode(array("status" => "0", "message" => "Missing parameters."));
        exit();
    }

    // Decode the JSON array of selected questions
    $questionsArray = json_decode($selectedQuestions, true);

    if (empty($questionsArray)) {
        echo json_encode(array("status" => "0", "message" => "No questions to insert."));
        exit();
    }

    // Prepare an SQL insert query
    $stmt = $con->prepare("INSERT INTO selected_questions (trainer_id, question_id, multiple_1, multiple_2, correct_answer) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(array("status" => "0", "message" => "Failed to prepare statement."));
        exit();
    }

    $rowsInserted = 0;

    // Bind and execute for each question
    foreach ($questionsArray as $question) {
        $questionId = $question['quiz_id'];
        $multiple1 = $question['multiple_1'];
        $multiple2 = $question['multiple_2'];
        $correctAnswer = $question['correct_answer'];

        // Ensure the question ID is numeric
        if (!is_numeric($questionId)) {
            continue; // Skip non-numeric IDs
        }

        $stmt->bind_param("iisss", $instructorId, $questionId, $multiple1, $multiple2, $correctAnswer);
        if ($stmt->execute()) {
            $rowsInserted++;
        } else {
            echo json_encode(array("status" => "0", "message" => "Error executing query: " . $stmt->error));
            $stmt->close();
            $con->close();
            exit();
        }
    }

    if ($rowsInserted > 0) {
        $response = array("status" => "1", "message" => "Questions saved successfully.");
    } else {
        $response = array("status" => "0", "message" => "Failed to save questions.");
    }

    $stmt->close();
    $con->close();

    echo json_encode($response);
} else {
    echo json_encode(array("status" => "0", "message" => "Invalid request method."));
}

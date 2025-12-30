<?php
include '../../include/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $traineeIds = explode(',', $_POST['trainee_ids']);
    $theoryMarks = explode(',', $_POST['theory_marks']);

    // Check if both arrays are of the same length
    if (count($traineeIds) === count($theoryMarks)) {
        $response = array('status' => '1', 'message' => 'Marks updated successfully');

        // Prepare the SQL statement for updating
        $sql = "UPDATE exam_scores SET theory_marks = CASE trainee_id ";

        foreach ($traineeIds as $index => $traineeId) {
            $sql .= "WHEN ? THEN ? ";
        }

        $sql .= "END WHERE trainee_id IN (" . implode(',', array_fill(0, count($traineeIds), '?')) . ")";

        if ($stmt = $con->prepare($sql)) {
            // Bind parameters
            // 'si' for each trainee_id (string) and theory_marks (integer)
            $types = str_repeat('si', count($traineeIds));
            $params = [];
            foreach ($traineeIds as $index => $traineeId) {
                $params[] = $traineeId; // trainee_id
                $params[] = (int)$theoryMarks[$index]; // theory_marks
            }
            // Add the IDs again for the IN clause
            $params = array_merge($params, $traineeIds);
            // Use correct types for the IN clause
            $stmt->bind_param($types . str_repeat('s', count($traineeIds)), ...$params);

            if ($stmt->execute()) {
                echo json_encode($response);
            } else {
                $response['status'] = '0';
                $response['message'] = 'Failed to update marks: ' . $stmt->error; // Include error message
                echo json_encode($response);
            }
            $stmt->close();
        } else {
            $response = array('status' => '0', 'message' => 'SQL statement error: ' . $con->error);
            echo json_encode($response);
        }
    } else {
        $response = array('status' => '0', 'message' => 'Mismatched data length');
        echo json_encode($response);
    }
}
?>

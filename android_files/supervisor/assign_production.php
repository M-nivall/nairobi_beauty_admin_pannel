<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $batch_no = $_POST['batch_no'];
    $username = $_POST['username'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $productionDate = $_POST['productionDate'];

    // Fetch employee ID based on username
    $select = "SELECT * FROM employees WHERE username='$username'";
    $query = mysqli_query($con, $select);
    $row = mysqli_fetch_array($query);
    $empID = $row['emp_id'];

        $update = "UPDATE production_duties SET production_status = 'Assigned' WHERE batch_no='$batch_no'";
        
        if (mysqli_query($con, $update)) {
            // Assign Technician
            $insert = "INSERT INTO production_tasks (batch_no, tech_id, product, quantity, production_date) VALUES ('$batch_no', '$empID', '$product', '$quantity', '$productionDate')";
            mysqli_query($con, $insert);

            $response['status'] = 1;
            $response['message'] = 'Assigned Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }

    echo json_encode($response);
}
?>

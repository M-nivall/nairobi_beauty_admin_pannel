<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $batch_no = $_POST['batch_no'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];

        $update = "UPDATE production_duties SET production_status = 'Stocked' WHERE batch_no='$batch_no'";
        
        if (mysqli_query($con, $update)) {
            // Assign Technician
            $update1 = "UPDATE production_tasks SET production_state = 'Stocked' WHERE batch_no='$batch_no'";
            mysqli_query($con, $update1);

            $update2="UPDATE stock SET stock = stock + $quantity WHERE product_name = '$product'";
            mysqli_query($con, $update2);

            $response['status'] = 1;
            $response['message'] = 'Stock Updated Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }

    echo json_encode($response);
}
?>

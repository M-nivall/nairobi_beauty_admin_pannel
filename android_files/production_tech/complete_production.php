<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $batch_no = $_POST['batch_no'];
    $produced_qty = $_POST['produced_qty'];


        $update = "UPDATE production_duties SET production_status = 'Completed' WHERE batch_no='$batch_no'";
        
        if (mysqli_query($con, $update)) {
            // Assign Technician
              $update1 = "UPDATE production_tasks SET produced_quantity = '$produced_qty', production_state = 'Completed' WHERE batch_no='$batch_no'";
            mysqli_query($con, $update1);

            $response['status'] = 1;
            $response['message'] = 'Submited Successfully, Awaiting Supervisor approval';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }

    echo json_encode($response);
}
?>

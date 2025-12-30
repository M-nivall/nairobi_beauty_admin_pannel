<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $batch_no = $_POST['batch_no'];

        $update = "UPDATE production_duties SET production_status = 'Ready stock' WHERE batch_no='$batch_no'";
        
        if (mysqli_query($con, $update)) {
            // Assign Technician
            $update1 = "UPDATE production_tasks SET production_state = 'Ready stock' WHERE batch_no='$batch_no'";
            mysqli_query($con, $update1);

            $response['status'] = 1;
            $response['message'] = 'Approved Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }

    echo json_encode($response);
}
?>

<?php
header('Content-Type: application/json'); // Make sure response is JSON
include '../../include/connections.php';

$userID = $_POST['userID'] ?? '';

$response = [];

$sql = "SELECT DISTINCT pd.batch_no, pd.product, pd.produce_qty, pd.production_date, pd.production_status 
        FROM production_duties pd 
        INNER JOIN production_tasks pt ON pd.batch_no = pt.batch_no
        WHERE pt.production_state IN ('Assigned', 'In Progress') AND pd.production_status IN ('Assigned', 'In Progress') AND pt.tech_id = '$userID'";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $response['status'] = "1";
    $response['message'] = "Pending Batches";
    $response['details'] = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $batch_no = $row['batch_no'];

        // Get materials for each batch
        $materials_query = "SELECT material_name, quantity, unit FROM production_duties WHERE batch_no = ?";
        $stmt = $con->prepare($materials_query);
        $stmt->bind_param("s", $batch_no);
        $stmt->execute();
        $materials_result = $stmt->get_result();

        $materials = [];
        while ($material = $materials_result->fetch_assoc()) {
            $materials[] = $material;
        }

        $response['details'][] = [
            'batch_no' => $batch_no,
            'product' => $row['product'],
            'produce_qty' => $row['produce_qty'],
            'production_date' => $row['production_date'],
            'production_status' => $row['production_status'],
            'materials' => $materials
        ];
    }
} else {
    $response['status'] = "0";
    $response['message'] = "Nothing found";
    $response['details'] = [];
}

echo json_encode($response);
?>

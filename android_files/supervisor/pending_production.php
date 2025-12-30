<?php
include '../../include/connections.php';

$sql = "SELECT DISTINCT batch_no, product, produce_qty, production_date, production_status 
        FROM production_duties 
        WHERE production_status = 'Pending'";
$result = mysqli_query($con, $sql);

$response = [];

if (mysqli_num_rows($result) > 0) {
    $response['status'] = "1";
    $response['message'] = "Pending Batches";
    $response['details'] = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $batch_no = $row['batch_no'];
        $product = $row['product'];
        $produce_qty = $row['produce_qty'];
        $production_date = $row['production_date'];
        $production_status = $row['production_status'];

        // Get all materials for this batch
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
            'product' => $product,
            'produce_qty' => $produce_qty,
            'production_date' => $production_date,
            'production_status' => $production_status,
            'materials' => $materials
        ];
    }
} else {
    $response['status'] = "0";
    $response['message'] = "Nothing found";
    $response['details'] = [];
}

// Display JSON output
echo json_encode($response);
?>

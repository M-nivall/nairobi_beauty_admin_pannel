<?php
include '../../include/connections.php';

$sql = "SELECT DISTINCT pd.batch_no, pd.product, pd.produce_qty, pd.production_date, pd.production_status, pt.produced_quantity, e.f_name, e.l_name, e.contact 
        FROM production_duties pd 
        INNER JOIN production_tasks pt
        INNER JOIN employees e ON pt.tech_id = e.emp_id
        WHERE pd.production_status IN('In Progress', 'Completed', 'Ready stock') AND pt.production_state IN('In Progress', 'Completed', 'Ready stock')";
$result = mysqli_query($con, $sql);

$response = [];

if (mysqli_num_rows($result) > 0) {
    $response['status'] = "1";
    $response['message'] = "Completed Production";
    $response['details'] = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $batch_no = $row['batch_no'];
        $product = $row['product'];
        $produce_qty = $row['produce_qty'];
        $production_date = $row['production_date'];
        $production_status = $row['production_status'];
        $techName = $row['f_name'].' '.$row['l_name'];
        $techNo = $row['contact'];
        $produced_quantity = $row['produced_quantity'];

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
            'techName' => $techName,
            'techNo' => $techNo,
            'produced_quantity' => $produced_quantity,
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

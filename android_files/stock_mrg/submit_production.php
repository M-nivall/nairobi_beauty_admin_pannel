<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = $_POST['product'];
    $produce_quantity = $_POST['produce_quantity'];
    $batch_no = $_POST['batch_no'];
    $production_date = $_POST['production_date'];
    $materials = $_POST['material'];

    include '../../include/connections.php';

    foreach ($materials as $item) {
        $name = $item['name'];
        $qty = $item['qty'];
        $unit = $item['unit'];

        // 1. Insert into production_duties
        $stmt = $con->prepare("INSERT INTO production_duties (product, batch_no, material_name, quantity, unit, produce_qty, production_date) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $product, $batch_no, $name, $qty, $unit, $produce_quantity, $production_date);
        $stmt->execute();

        // 2. Directly reduce the material quantity
        $updateStmt = $con->prepare("UPDATE materials SET quantity = quantity - ? WHERE material_name = ?");
        $updateStmt->bind_param("ds", $qty, $name);
        $updateStmt->execute();
    }

    echo json_encode(["status" => "success"]);
}
?>

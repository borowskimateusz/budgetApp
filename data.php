<?php
header('Content-Type: application/json');

require_once ('dbbudget.php');

$sqlQuery = "SELECT id_transaction,id_category,money
                FROM transactions 
                    ORDER BY id_transaction";

$result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>
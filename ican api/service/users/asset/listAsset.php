<?php
try {
    $ID = isset($_GET['id_user']) ? $_GET['id_user'] : ''; // Check if $_POST['id_user'] exists, if not, set it to empty string

    // Query for the first table
    $sql = "SELECT * FROM `Userasset_id` INNER JOIN Asset ON Asset.AssetID = Userasset_id.AssetID INNER JOIN UsersData_Asset ON UsersData_Asset.AssetID = Userasset_id.AssetID WHERE Userasset_id.id_user = :id_user";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id_user', $ID);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Query for the second table
    $sqll = "SELECT * FROM UsersLiability_id INNER JOIN Liability ON Liability.DebtID = UsersLiability_id.DebtID INNER JOIN UsersData_Liability ON UsersData_Liability.DebtID = UsersLiability_id.DebtID WHERE UsersLiability_id.id_user = :id_user";
    $statementt = $conn->prepare($sqll);
    $statementt->bindParam(':id_user', $ID);
    $statementt->execute();
    $resultt = $statementt->fetchAll(PDO::FETCH_ASSOC);

    // Combine both result sets into a single associative array
    $combinedResult = array(
        'Asset' => $result,
        'Liability' => $resultt
        // 'UsersData_Prosses' => $resultt
    );

    // Check if either result set has data
    if ($result || $resultt) {
        $response->success($combinedResult, 'Success', 200);
    } else {
        $response->error('No data found', 404);
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}


?>

<?php

include("config.php");
$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
    echo json_encode(array("message" => "Invalid Request Method.", "status" => false));
}

if (is_array($data)) {
    $ids = array_map(function ($entry) {
        return $entry['id'];
    }, $data);
    $ids = array_filter($ids, 'is_numeric');

    if (count($ids) > 0) {
        $idString = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM user WHERE id IN ($idString)";
        $stmt = $con->prepare($sql);
        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Deleted records successfully.", "deleted_ids" => $ids]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
        }
        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Invalid ID.", "status" => false));
    }
} else {
    echo json_encode(array("message" => "Invalid Request Data Format.", "status" => false));
}
?>
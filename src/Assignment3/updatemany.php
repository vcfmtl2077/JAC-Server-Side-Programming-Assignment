<?php
include("config.php");
$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] != "PUT") {
    echo json_encode(array("message" => "Invalid Request Method.", "status" => false));
}
if (is_array($data)) {
    // Begin transaction
    $con->begin_transaction();

    $updateSuccess = true;
    $stmt = $con->prepare("UPDATE user SET name = ?, email = ?, age = ? WHERE id = ?");

    foreach ($data as $user) {
        $id = (int) $user['id'];
        $name = $user['name'];
        $email = $user['email'];
        $age = (int) $user['age'];

        if ($id && $name && $email && $age !== null) {
            // Bind parameters and execute the statement
            $stmt->bind_param('ssii', $name, $email, $age, $id);
            $updateSuccess = $updateSuccess && $stmt->execute();
        } else {
            // Handle invalid data
            $updateSuccess = false;
            echo json_encode(["success" => false, "message" => "Invalid data format for entry with ID $id."]);
            $conn->rollback();
            $stmt->close();
            $conn->close();
            exit;
        }
    }

    if ($updateSuccess) {
        $con->commit();
        echo json_encode(["success" => true, "message" => "Batch update successful."]);
    } else {
        $con->rollback();
        echo json_encode(["success" => false, "message" => "Batch update failed."]);
    }
    $stmt->close();
} else {
    echo json_encode(array("message" => "Invalid Request Data Format.", "status" => false));
}

?>
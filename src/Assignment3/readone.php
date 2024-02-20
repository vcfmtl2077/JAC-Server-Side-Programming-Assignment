<?php

include("config.php");

header("Content-Type: application/json");
// $data = json_decode(file_get_contents ("php://input"),true);
$userId = $_GET['id'];
if ($userId != null) {
    $id = (int) $userId;
} else {
    echo json_encode(array("message" => "Invalid User ID.", "status" => false));
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "GET") {
    $sql = "SELECT id,name,email,age  FROM user WHERE id = ?";
    if ($stmt = mysqli_prepare($con, $sql)) {
        $stmt->bind_param("s", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $user = $result->fetch_assoc();
            $response['id'] = $user['id'];
            $response['name'] = $user['name'];
            $response['email'] = $user['email'];
            $response['age'] = $user['age'];
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array("message" => "No result found.", "status" => false));
        }
        mysqli_stmt_close($stmt);
    }


} else {
    echo json_encode(array("message" => "Invalid Request Method.", "status" => false));
}


?>
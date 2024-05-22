<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "performance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM emp";
        $result = $conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    case 'POST':
        $id = $input['id'];
        $score = $input['score'];
        $behavior = $input['behavior'];
        $goal = $input['goal'];

        $sql = "INSERT INTO emp (id, score, behavior, goal) VALUES ('$id', '$score', '$behavior', '$goal')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Record added successfully"]);
        } else {
            echo json_encode(["error" => "Error adding record: " . $conn->error]);
        }
        break;

    case 'PUT':
        $id = $input['id'];
        $score = $input['score'];
        $behavior = $input['behavior'];
        $goal = $input['goal'];

        $sql = "UPDATE emp SET score='$score', behavior='$behavior', goal='$goal' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Record updated successfully"]);
        } else {
            echo json_encode(["error" => "Error updating record: " . $conn->error]);
        }
        break;

    case 'DELETE':
        $id = $input['id'];

        $sql = "DELETE FROM emp WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Record deleted successfully"]);
        } else {
            echo json_encode(["error" => "Error deleting record: " . $conn->error]);
        }
        break;
}

$conn->close();
?>
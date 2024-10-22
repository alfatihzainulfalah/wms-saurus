<?php
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "db_wms_saurus");

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

$qry = "SELECT * FROM master_user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $qry);

if (mysqli_num_rows($result) > 0) {
    $response = ["success" => true, "message" => "Username and password found"];
} else {
    $response = ["success" => false, "message" => "Invalid username and password"];
}

echo json_encode($response);
?>
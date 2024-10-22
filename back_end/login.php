<?php

header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$servername = "192.168.0.120";
$username = "root";
$password = "";
$dbname = "db_descension";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

if (isset($_GET['username']) && isset($_GET['password'])) {
    $user = $_GET['username'];
    $pass = $_GET['password'];

    $query = "SELECT * FROM t_users WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(["success" => true, "message" => "Username and password found"]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid username or password"]);
    }

    mysqli_close($conn);
}else{
    echo json_encode(["success" => false, "message" => "hi"]);

}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate username format
    if (!preg_match('/^[A-Z][a-z]+\.[A-Z][a-z]+$/', $username)) {
        echo "Error: Username must be in the format FirstName.SurName";
        exit();
    }

    // Validate password
    $length_check = strlen($password) >= 8;
    $uppercase_check = preg_match('/[A-Z]/', $password);
    $lowercase_check = preg_match('/[a-z]/', $password);
    $number_check = preg_match('/\d/', $password);
    $special_check = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

    if (!($length_check && $uppercase_check && $lowercase_check && $number_check && $special_check)) {
        echo "Error: Password does not meet all requirements.";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful. Your username is: " . $username;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
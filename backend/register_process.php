<?php
// फाइल का पाथ: backend/register_process.php

require_once "config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)";

if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);

    if($stmt->execute()){
        // रजिस्ट्रेशन सफल होने पर लॉगिन पेज पर भेजें
        header("location: ../login.php?status=success");
    } else{
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
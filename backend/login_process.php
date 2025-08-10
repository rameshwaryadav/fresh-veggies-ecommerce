<?php
// फाइल का पाथ: backend/login_process.php

require_once "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, name, password, user_type FROM users WHERE email = ?";

if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 1){
        $stmt->bind_result($id, $name, $hashed_password, $user_type);
        if($stmt->fetch()){
            if(password_verify($password, $hashed_password)){
                // सेशन में जानकारी स्टोर करें
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["name"] = $name;
                $_SESSION["user_type"] = $user_type;

                // यूज़र टाइप के आधार पर रीडायरेक्ट करें
                if($user_type == 'seller'){
                    header("location: ../seller_dashboard.php");
                } else {
                    header("location: ../index.php");
                }
            } else{
                echo "Invalid password.";
            }
        }
    } else{
        echo "No account found with that email.";
    }
    $stmt->close();
}
$conn->close();
?>
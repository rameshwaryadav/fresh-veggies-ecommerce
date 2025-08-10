<?php
require_once 'config.php';

if(!isset($_SESSION["loggedin"]) || $_SESSION["user_type"] != 'seller'){
    header("location: ../login.php");
    exit;
}

$seller_id = $_SESSION["id"];
$product_name = $_POST["product_name"];
$description = $_POST["description"];
$category = $_POST["category"];
$price = $_POST["price"];
$image_name = "";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $image_name = time() . '_' . basename($_FILES["image"]["name"]);
    $target_dir = "../uploads/"; 
    $target_file = $target_dir . $image_name;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
        $image_name = "";
    }
}

$sql = "INSERT INTO products (seller_id, product_name, description, category, price, image) VALUES (?, ?, ?, ?, ?, ?)";
    
if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("isssds", $seller_id, $product_name, $description, $category, $price, $image_name);
    
    if($stmt->execute()){
        header("location: ../seller_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
<?php
require_once "config.php";

// सुरक्षा जांच: उपयोगकर्ता लॉग इन है और एक विक्रेता है?
if(!isset($_SESSION["loggedin"]) || $_SESSION["user_type"] != 'seller'){
    header("location: ../login.php");
    exit;
}

// प्रोडक्ट आईडी प्राप्त करें
if(isset($_GET["id"]) && !empty($_GET["id"])){
    $product_id = $_GET["id"];
    $seller_id = $_SESSION["id"];

    // सबसे ज़रूरी सुरक्षा जांच: क्या यह प्रोडक्ट इसी विक्रेता का है?
    $sql = "DELETE FROM products WHERE product_id = ? AND seller_id = ?";
    
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("ii", $product_id, $seller_id);
        
        if($stmt->execute()){
            // सफल होने पर डैशबोर्ड पर वापस जाएं
            header("location: ../seller_dashboard.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    $stmt->close();
} else {
    // अगर आईडी नहीं मिली तो वापस भेज दें
    header("location: ../seller_dashboard.php");
    exit();
}
?>
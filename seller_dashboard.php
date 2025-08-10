<?php
// backend फोल्डर से कॉन्फ़िगरेशन और सेशन को शामिल करें
require_once 'backend/config.php';

// सुरक्षा जांच: क्या उपयोगकर्ता लॉग इन है और एक विक्रेता है?
// अगर नहीं, तो उसे लॉगिन पेज पर वापस भेज दें।
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != 'seller'){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard - Fresh Veggies</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS, Fonts, and Icons -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- ======== NAVBAR ======== -->
    <!-- यह सुनिश्चित करता है कि डैशबोर्ड पर भी नेविगेशन बार सुसंगत रहे -->
    <nav class="navbar">
        <div class="logo"><i class="fas fa-leaf"></i>Fresh Veggies</div>
        <div class="nav-links">
            <a href="index.php">View Store</a>
        </div>
        <div class="auth-links">
            <p style="color: white; margin-right: 15px;">Welcome, <strong><?php echo htmlspecialchars($_SESSION["name"]); ?></strong>!</p>
            <a href="logout.php" class="button logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

    <!-- ======== PAGE CONTAINER FOR DASHBOARD CONTENT ======== -->
    <div class="page-container">
        
        <!-- डैशबोर्ड का हेडर -->
        <div class="header">
            <h2><i class="fas fa-tachometer-alt"></i> Seller Dashboard</h2>
            <a href="add_product.php" class="button"><i class="fas fa-plus-circle"></i> Add New Product</a>
        </div>
        
        <hr style="margin: 25px 0; border-top: 1px solid #eee;">
        
        <h3><i class="fas fa-store"></i> Your Listed Products</h3>
        
        <!-- उत्पादों को दिखाने के लिए ग्रिड -->
        <div class="product-grid">
            <?php
            // केवल इस विक्रेता के उत्पादों को प्राप्त करें
            $seller_id = $_SESSION["id"];
            // अब हम product_id और category भी सेलेक्ट कर रहे हैं
            $sql = "SELECT product_id, product_name, category, description, price, image FROM products WHERE seller_id = ? ORDER BY added_date DESC";
            
            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("i", $seller_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    // प्रत्येक उत्पाद के लिए एक कार्ड बनाएं
                    while($row = $result->fetch_assoc()){
                        echo "<div class='product-card'>";
                        
                        // इमेज का पाथ सेट करें
                        $image_path = 'uploads/' . htmlspecialchars($row['image']);
                        
                        // जांचें कि इमेज मौजूद है और खाली नहीं है
                        if (!empty($row['image']) && file_exists($image_path)) {
                            echo "<img src='" . $image_path . "' alt='" . htmlspecialchars($row['product_name']) . "' class='product-card-img'>";
                        } else {
                            echo "<div class='product-placeholder'><i class='fas fa-seedling'></i></div>";
                        }
                        
                        // उत्पाद की जानकारी
                        echo "<div class='product-info'>";
                        echo "<span class='category-tag'>" . htmlspecialchars($row['category']) . "</span>"; // कैटेगरी दिखाना
                        echo "<h4>" . htmlspecialchars($row['product_name']) . "</h4>";
                        echo "<p class='description'>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p class='price'>₹ " . htmlspecialchars($row['price']) . "</p>";
                        
                        // एक्शन बटन: एडिट और डिलीट
                        echo "<div class='action-buttons'>";
                        // अभी एडिट का बटन सिर्फ डिज़ाइन है, आप इसे बाद में बना सकते हैं
                        echo "<a href='#' class='button cart-btn'><i class='fas fa-edit'></i> Edit</a>";
                        // डिलीट बटन जो backend/delete_product.php को कॉल करेगा
                        echo "<a href='backend/delete_product.php?id=" . $row['product_id'] . "' class='button delete-btn' onclick=\"return confirm('Are you sure you want to delete this item? This action cannot be undone.');\"><i class='fas fa-trash'></i> Delete</a>";
                        echo "</div>"; // action-buttons का अंत
                        
                        echo "</div>"; // .product-info का अंत
                        echo "</div>"; // .product-card का अंत
                    }
                } else {
                     // अगर कोई उत्पाद नहीं मिला
                     echo "<p style='grid-column: 1 / -1; text-align: center;'>You haven't added any products yet. Click 'Add New Product' to get started!</p>";
                }
                $stmt->close();
            }
            $conn->close();
            ?>
        </div>
    </div>

</body>
</html>
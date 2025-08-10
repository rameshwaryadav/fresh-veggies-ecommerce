<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <!-- Links to CSS, Fonts, Icons -->
</head>
<body>
    <div class="form-container">
        <h2><i class="fas fa-carrot"></i> Add a New Product</h2>
        <form action="backend/add_product_process.php" method="post" enctype="multipart/form-data">
            
            <label>Product Name</label>
            <input type="text" name="product_name" required>

            <!-- नया कैटेगरी ड्रॉपडाउन -->
            <label>Category</label>
            <select name="category" required>
                <option value="Vegetables">Vegetables</option>
                <option value="Fruits">Fruits</option>
                <option value="Grains">Grains</option>
                <option value="Dairy">Dairy</option>
            </select>

            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>

            <label>Price (₹)</label>
            <input type="number" step="0.01" name="price" required>

            <label>Product Image (Optional)</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit"><i class="fas fa-plus"></i> Add Product</button>
            <p><a href="seller_dashboard.php">Back to Dashboard</a></p>
        </form>
    </div>
</body>
</html>
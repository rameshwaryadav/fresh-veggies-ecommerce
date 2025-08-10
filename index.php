<?php require_once 'backend/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fresh Veggies - Delicious & Fresh Food Delivered</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body class="main-site-body">

    <header class="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand"><i class="fas fa-leaf"></i> Fresh Veggies</a>
            <nav>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Shop</a></li>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                        <li class="nav-item"><a href="logout.php" class="button">Logout</a></li>
                         <?php if($_SESSION["user_type"] == 'seller'): ?>
                            <li class="nav-item"><a href="seller_dashboard.php" class="button">Dashboard</a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item"><a href="login.php" class="button">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-text">
                    <h1>Delicious & <span>Fresh</span> Food Delivered To You</h1>
                    <p>Welcome to our online store! Find the freshest vegetables and fruits, sourced directly from local farms.</p>
                    <a href="#products" class="button">Shop Now <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="hero-image">
                    <img src="assets/images/carousel-2.jpg" alt="Basket of fresh vegetables">
                </div>
            </div>
        </section>

        <section class="section product-listing" id="products">
            <div class="container">
                <h2 class="section-title">Our Products</h2>
                <div class="filter-controls">
                    <button class="filter-btn active" data-filter="all">All</button>
                    <button class="filter-btn" data-filter="Leafy-Green">Leafy Green</button>
                    <button class="filter-btn" data-filter="Root-Vegetable">Root Vegetable</button>
                    <button class="filter-btn" data-filter="Cruciferous">Cruciferous</button>
                    <button class="filter-btn" data-filter="Fruit">Fruit</button>
                    <button class="filter-btn" data-filter="Other">Other</button>
                </div>
                <div class="product-grid">
                    <?php
                    $sql = "SELECT p.product_name, p.category, p.price, p.image, u.name as seller_name 
                            FROM products p JOIN users u ON p.seller_id = u.id ORDER BY p.added_date DESC";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $category_class = str_replace(' ', '-', $row['category']);
                            echo "<div class='product-card' data-category='" . htmlspecialchars($category_class) . "'>";
                            $image_path = 'uploads/' . htmlspecialchars($row['image']);
                            if (!empty($row['image']) && file_exists($image_path)) {
                                echo "<img src='{$image_path}' alt='" . htmlspecialchars($row['product_name']) . "' class='product-card-img'>";
                            } else {
                                echo "<div class='product-placeholder'><i class='fas fa-seedling'></i></div>";
                            }
                            echo "<div class='product-info'>";
                            echo "<h4>" . htmlspecialchars($row['product_name']) . "</h4>";
                            echo "<p class='seller'><i class='fas fa-user-tag'></i> Sold by: " . htmlspecialchars($row['seller_name']) . "</p>";
                            echo "<p class='price'>₹ " . htmlspecialchars($row['price']) . "</p>";
                            echo "</div></div>";
                        }
                    } else { echo "<p>No products available right now.</p>"; }
                    ?>
                </div>
            </div>
        </section>

        <section class="section farmer-spotlight">
            <div class="container">
                <h2 class="section-title">Meet Our Hardworking Farmers</h2>
                <div class="swiper farmer-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><div class="farmer-card"><img src="assets/images/farmer-1.jpg" alt="Farmer 1"></div></div>
                        <div class="swiper-slide"><div class="farmer-card"><img src="assets/images/farmer-2.jpg" alt="Farmer 2"></div></div>
                        <div class="swiper-slide"><div class="farmer-card"><img src="assets/images/farmer-3.jpg" alt="Farmer 3"></div></div>
                        <div class="swiper-slide"><div class="farmer-card"><img src="assets/images/farmer-4.jpg" alt="Farmer 4"></div></div>
                        <div class="swiper-slide"><div class="farmer-card"><img src="assets/images/farmer-5.jpg" alt="Farmer 5"></div></div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <section class="section testimonials">
            <div class="container">
                <h2 class="section-title">What Our Customers Say</h2>
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><div class="testimonial-card"><p class="quote">"The vegetables were incredibly fresh! Will definitely order again."</p><div class="testimonial-author"><img src="assets/images/customer 1.png" alt="Priya S."><h4>Rameshwar yadav.</h4></div></div></div>
                        <div class="swiper-slide"><div class="testimonial-card"><p class="quote">"Fast delivery and excellent quality. The carrots were so sweet!"</p><div class="testimonial-author"><img src="assets/images/customer 2.png" alt="Amit K."><h4>Bholu</h4></div></div></div>
                        <div class="swiper-slide"><div class="testimonial-card"><p class="quote">"A fantastic service for anyone who wants fresh, healthy food."</p><div class="testimonial-author"><img src="assets/images/customer 3.png" alt="rameshwar."><h4>Rameshwar.</h4></div></div></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        
        <footer class="site-footer">
            <div class="container">
                <div class="footer-grid">
                     <div class="footer-col"><h4>About Us</h4><p>We are a community-focused store connecting local farmers with customers.</p></div>
                    <div class="footer-col"><h4>Quick Links</h4><ul><li><a href="#">About</a></li><li><a href="#">Shop</a></li><li><a href="#">Contact</a></li></ul></div>
                    <div class="footer-col"><h4>Contact</h4><p><i class="fas fa-phone"></i> +91 12345 67890</p><p><i class="fas fa-envelope"></i> support@freshveggies.com</p></div>
                    <div class="footer-col"><h4>Follow Me</h4><div class="social-icons"><a href="https://www.linkedin.com/in/rameshwar01" target="_blank"><i class="fab fa-linkedin"></i></a><a href="https://github.com/rameshwaryadav" target="_blank"><i class="fab fa-github"></i></a></div></div>
                </div>
                <div class="footer-bottom"><p>&copy; <?php echo date("Y"); ?>  Fresh Veggies. All Rights Reserved. Developed by Rameshwar Yadav.</p></div>
            </div>
            </div>
        </footer>
    </main>
    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".farmer-swiper", {
            slidesPerView: 1, spaceBetween: 30, loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                768: { slidesPerView: 3, spaceBetween: 30 },
                1024: { slidesPerView: 4, spaceBetween: 30 },
            }
        });

        new Swiper(".testimonial-swiper", {
            slidesPerView: 1, spaceBetween: 30, loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const productCards = document.querySelectorAll('.product-grid .product-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    const filterValue = this.getAttribute('data-filter');

                    productCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        if (filterValue === 'all' || cardCategory === filterValue) {
                            card.classList.remove('hide');
                        } else {
                            card.classList.add('hide');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
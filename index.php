
<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drought Prediction System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="loader">
        <div class="spinner"></div>
    </div>

    <header>
        <nav class="navbar">
            <span class="logo">
                <i class="fas fa-cloud-sun-rain"></i>
                <span>Drought Prediction System</span>
            </span>
            <span class="menu-toggle">
                <i class="fas fa-bars"></i>
            </span>
            <?php
                   $currentPage = $_GET['page'] ?? 'home';
            ?>

          <ul class="nav-links">
    <li><a href="index.php" class="<?= ($currentPage == 'home') ? 'active' : '' ?>"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="?page=researchers" class="<?= ($currentPage == 'researchers') ? 'active' : '' ?>"><i class="fas fa-users"></i> Researchers</a></li>
    <li><a href="?page=news" class="<?= ($currentPage == 'news') ? 'active' : '' ?>"><i class="fas fa-newspaper"></i> News</a></li>
    <li><a href="?page=events" class="<?= ($currentPage == 'events') ? 'active' : '' ?>"><i class="fas fa-calendar"></i> Events</a></li>
    <li><a href="?page=thematic" class="<?= ($currentPage == 'thematic') ? 'active' : '' ?>"><i class="fas fa-chart-line"></i> Thematic Focus</a></li>
    <li><a href="?page=stories" class="<?= ($currentPage == 'stories') ? 'active' : '' ?>"><i class="fas fa-book-open"></i> Stories</a></li>
    <?php if(isset($_SESSION['is_admin'])): ?>
    <li><a href="admin/dashboard.php"><i class="fas fa-user-shield"></i> Admin</a></li>
    <?php endif; ?>
</ul>

        </nav>
    </header>

    <main>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search content...">
            <button id="searchBtn"><i class="fas fa-search"></i></button>
        </div>

        <div class="content-container">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            include("pages/$page.php");
            ?>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Dedicated to providing accurate drought predictions and research information.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Drought Prediction System. All rights reserved.</p>
        </div>
    </footer>

    <button id="scrollToTop" title="Go to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="js/main.js"></script>
</body>
</html>

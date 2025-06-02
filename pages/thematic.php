<?php


// Fetch themes and related post counts
$sql = "SELECT t.*, COUNT(p.id) as post_count 
        FROM themes t 
        LEFT JOIN posts p ON t.id = p.theme_id 
        GROUP BY t.id 
        ORDER BY t.priority ASC";

$result = $db->query($sql);
$themes = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $themes[] = $row;
    }
}

// Define SITE_URL if not defined
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/your_project_folder'); // adjust this to your actual site URL
}
?>

<!-- HTML Output -->

<div class="page-header">
    <h1>Thematic Focus Areas</h1>
    <p>Explore our key research areas in drought prediction</p>
</div>

<div class="themes-container">
    <?php if (!empty($themes)): ?>
        <?php foreach ($themes as $theme): ?>
            <div class="theme-card">
                <div class="theme-icon">
                    <i class="<?php echo htmlspecialchars($theme['icon']); ?>"></i>
                </div>
                <div class="theme-content">
                    <h2><?php echo htmlspecialchars($theme['name']); ?></h2>
                    <p><?php echo htmlspecialchars($theme['description']); ?></p>
                    <div class="theme-stats">
                        <span><?php echo (int)$theme['post_count']; ?> Research Papers</span>
                    </div>
                    <a href="theme.php?id=<?php echo (int)$theme['id']; ?>" class="btn btn-outline">
                        Explore Research <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No thematic areas available at the moment.</p>
    <?php endif; ?>
</div>

<section class="research-highlights">
    <h2>Research Highlights</h2>
    <div class="highlights-slider">
        <!-- You can use Swiper.js, Slick Slider, or any JS slider here -->
        <!-- Example placeholder -->
        <div class="highlight-placeholder">Coming Soon...</div>
    </div>
</section>

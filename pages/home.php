<?php
$featured_posts = [];
$recent_posts = [];

$result1 = $db->query("SELECT * FROM posts WHERE featured = 1 ORDER BY created_at DESC LIMIT 3");
if ($result1) {
    while ($row = $result1->fetch_assoc()) {
        $featured_posts[] = $row;
    }
}

$result2 = $db->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 6");
if ($result2) {
    while ($row = $result2->fetch_assoc()) {
        $recent_posts[] = $row;
    }
}
?>

<div class="hero-section">
    <div class="hero-content">
        <h1>Drought Prediction System</h1>
        <p>Advanced analytics and research for drought prediction and management</p>
        <a href="#latest-research" class="btn btn-primary">Explore Research</a>
    </div>
</div>

<section class="featured-section">
    <div class="section-header">
        <h2>Featured Research</h2>
        <p>Latest breakthrough findings in drought prediction</p>
    </div>

    <div class="featured-grid">
        <?php foreach ($featured_posts as $post): ?>
            <div class="featured-card">
                
                <div class="card-content">
                    <span class="category-tag"><?php echo htmlspecialchars($post['category']); ?></span>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo substr(strip_tags($post['content']), 0, 150) . '...'; ?></p>
                    <a href="post.php?id=<?php echo $post['id']; ?>" class="read-more">Read More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="latest-research" class="recent-posts-section">
    <div class="section-header">
        <h2>Recent Updates</h2>
        <p>Stay informed with our latest research and findings</p>
    </div>

    <div class="posts-grid">
        <?php foreach ($recent_posts as $post): ?>
            <!-- <?php include 'templates/post-card.php'; ?> -->
        <?php endforeach; ?>
    </div>

    <div class="section-footer">
        <a href="archive.php" class="btn btn-secondary">View All Posts</a>
    </div>
</section>

<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <i class="fas fa-flask"></i>
            <h3>Research Projects</h3>
            <span class="counter">50+</span>
        </div>
        <div class="stat-item">
            <i class="fas fa-users"></i>
            <h3>Researchers</h3>
            <span class="counter">25+</span>
        </div>
        <div class="stat-item">
            <i class="fas fa-globe"></i>
            <h3>Study Regions</h3>
            <span class="counter">30+</span>
        </div>
        <div class="stat-item">
            <i class="fas fa-chart-line"></i>
            <h3>Accuracy Rate</h3>
            <span class="counter">95%</span>
        </div>
    </div>
</section>

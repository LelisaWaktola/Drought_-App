<?php

// --- Fetch Success Stories with Author Info ---
$sql = "SELECT s.*, u.first_name, u.last_name 
        FROM stories s 
        JOIN users u ON s.author_id = u.id 
        ORDER BY s.created_at DESC";

$result = $db->query($sql);
$success_stories = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $success_stories[] = $row;
    }
}

// --- Define SITE_URL if not already defined ---
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/your_project_folder'); // <-- Replace as needed
}
?>

<!-- HTML Content -->

<div class="page-header">
    <h1>Success Stories</h1>
    <p>Real-world impact of our drought prediction research</p>
</div>

<div class="stories-grid">
    <?php if (!empty($success_stories)): ?>
        <?php foreach ($success_stories as $story): ?>
            <article class="story-card">
                <div class="story-image">
                     <img src="<?= 'images/'.$story['image_path']?>" alt="">
                    <div class="story-category">
                        <span><?php echo htmlspecialchars($story['category']); ?></span>
                    </div>
                </div>

                <div class="story-content">
                    <h2><?php echo htmlspecialchars($story['title']); ?></h2>
                    <div class="story-meta">
                        <span class="author"><i class="far fa-user"></i>
                            <?php echo htmlspecialchars($story['first_name'] . ' ' . $story['last_name']); ?>
                        </span>
                        <span class="date"><i class="far fa-calendar"></i>
                            <?php echo date('M j, Y', strtotime($story['created_at'])); ?>
                        </span>
                    </div>
                    <p><?php echo substr(strip_tags($story['content']), 0, 200) . '...'; ?></p>
                    <div class="story-footer">
                        <a href="story.php?id=<?php echo $story['id']; ?>" class="read-more">
                            Read Full Story
                        </a>
                        <div class="story-stats">
                            <span><i class="far fa-eye"></i> <?php echo (int)$story['views']; ?></span>
                            <span><i class="far fa-heart"></i> <?php echo (int)$story['likes']; ?></span>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No success stories available at the moment.</p>
    <?php endif; ?>
</div>

<div class="share-story">
    <h2>Share Your Story</h2>
    <p>Have you benefited from our drought prediction research? We'd love to hear your story!</p>
    <a href="submit-story.php" class="btn btn-primary">Submit Your Story</a>
</div>

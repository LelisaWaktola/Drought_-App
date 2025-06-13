<?php


// Define SITE_URL if not already set
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/drought_prediction'); // Adjust as needed
}

// --- Pagination Setup ---
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$per_page = 9;
$offset = ($page - 1) * $per_page;

// --- Total Posts Count ---
$total_result = $db->query("SELECT COUNT(*) AS total FROM posts WHERE category = 'news'");
$total_row = $total_result->fetch_assoc();
$total_news = $total_row['total'];
$total_pages = ceil($total_news / $per_page);

// --- Get Paginated News Posts ---
$news_posts = [];
$query = "
    SELECT p.*, u.first_name, u.last_name 
    FROM posts p 
    JOIN users u ON p.user_id = u.id 
    WHERE p.category = 'news' 
    ORDER BY p.created_at DESC 
    LIMIT $offset, $per_page
";
$result = $db->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $news_posts[] = $row;
    }
}
?>

<!-- HTML Starts Here -->

<div class="page-header">
    <h1>Latest News</h1>
    <p>Stay updated with the latest developments in drought prediction</p>
</div>

<div class="news-filters">
    <div class="search-box">
        <input type="text" id="newsSearch" placeholder="Search news...">
        <button><i class="fas fa-search"></i></button>
    </div>
    <div class="filter-options">
        <select id="yearFilter">
            <option value="">All Years</option>
            <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <select id="monthFilter">
            <option value="">All Months</option>
            <?php
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March',
                4 => 'April', 5 => 'May', 6 => 'June',
                7 => 'July', 8 => 'August', 9 => 'September',
                10 => 'October', 11 => 'November', 12 => 'December'
            ];
            foreach ($months as $num => $name): ?>
                <option value="<?php echo $num; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="news-grid" id="newsGrid">
    <?php if (empty($news_posts)): ?>
        <p>No news articles found.</p>
    <?php else: ?>
        <?php foreach ($news_posts as $post): ?>
            <article class="news-card">
                <?php if (!empty($post['image_path'])): ?>
                    <div class="news-image">
                        <img src="<?="images/".$post['image_path']; ?>"
                             alt="<?php echo htmlspecialchars($post['title']); ?>" loading="lazy">
                    </div>
                <?php endif; ?>
                <div class="news-content">
                    <div class="news-meta">
                        <span class="date">
                            <i class="far fa-calendar"></i>
                            <?php echo date('M j, Y', strtotime($post['created_at'])); ?>
                        </span>
                        <span class="author">
                            <i class="far fa-user"></i>
                            <?php echo htmlspecialchars($post['first_name'] . ' ' . $post['last_name']); ?>
                        </span>
                    </div>
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo substr(strip_tags($post['content']), 0, 200) . '...'; ?></p>
                    <a href="post.php?id=<?php echo $post['id']; ?>" class="read-more">
                        Read Full Article <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=news&p=<?php echo ($page - 1); ?>" class="prev">
                <i class="fas fa-chevron-left"></i> Previous
            </a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=news&p=<?php echo $i; ?>" class="<?php echo ($i === $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=news&p=<?php echo ($page + 1); ?>" class="next">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script src="js/news-filters.js"></script>

<?php
// session_start();
// if(!isset($_SESSION['admin_id'])) {
//     header('Location: login.php');
//     exit();
// }
include '../includes/admin-header.php';
?>

<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>
    
    <div class="dashboard-stats">
        <?php
        include '../config.php';
        
        $stats = [
            'researchers' => $pdo->query("SELECT COUNT(*) FROM researchers")->fetchColumn(),
            'news' => $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn(),
            'events' => $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn(),
            'stories' => $pdo->query("SELECT COUNT(*) FROM stories")->fetchColumn()
        ];
        
        foreach($stats as $key => $value) {
            echo "<div class='stat-card'>";
            echo "<h3>" . ucfirst($key) . "</h3>";
            echo "<p>$value</p>";
            echo "</div>";
        }
        ?>
    </div>
    
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <a href="add-news.php" class="btn">Add News</a>
        <a href="add-event.php" class="btn">Add Event</a>
        <a href="add-researcher.php" class="btn">Add Researcher</a>
        <a href="add-story.php" class="btn">Add Story</a>
    </div>
</div>

<?php include '../includes/admin-footer.php'; ?>

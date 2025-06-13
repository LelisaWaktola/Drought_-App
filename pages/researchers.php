<?php

// --- Fetch Researchers with Post Count ---
$sql = "SELECT u.*, COUNT(p.id) AS post_count
        FROM users u
        LEFT JOIN posts p ON u.id = p.user_id
        WHERE u.role = 'researcher'
        GROUP BY u.id
        ORDER BY u.last_name ASC";

$result = $db->query($sql);
$researchers = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $researchers[] = $row;
    }
}

// --- Helper Function (if not defined elsewhere) ---
function get_avatar_url($avatar_filename) {
    if (!$avatar_filename) {
        return 'assets/images/default-avatar.png'; // fallback avatar
    }
    return 'assets/uploads/avatars/' . $avatar_filename;
}
?>

<!-- HTML Content -->

<div class="page-header">
    <h1>Our Research Team</h1>
    <p>Meet our dedicated team of drought prediction researchers</p>
</div>

<div class="researchers-grid">
    <?php if (!empty($researchers)): ?>
        <?php foreach ($researchers as $researcher): ?>
            <div class="researcher-card">
                <div class="researcher-image">
                    <img src="<?='images/'.$researcher['avatar'] ?>" alt="">
                </div>
                <div class="researcher-info">
                    <h3><?php echo htmlspecialchars($researcher['first_name'] . ' ' . $researcher['last_name']); ?></h3>
                    <span class="researcher-title">
                        <?php echo htmlspecialchars($researcher['title']); ?>
                    </span>
                    <p><?php echo nl2br(htmlspecialchars($researcher['bio'])); ?></p>

                    <div class="researcher-stats">
                        <span><i class="fas fa-file-alt"></i>
                            <?php echo $researcher['post_count']; ?> Publications
                        </span>
                    </div>

                    <div class="researcher-social">
                        <?php if (!empty($researcher['linkedin'])): ?>
                            <a href="<?php echo htmlspecialchars($researcher['linkedin']); ?>" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($researcher['twitter'])): ?>
                            <a href="<?php echo htmlspecialchars($researcher['twitter']); ?>" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No researchers found at the moment.</p>
    <?php endif; ?>
</div>

<!-- Previous admin dashboard code with added styling and features -->
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <div class="stats">
            <div class="stat-card">
                <i class="fas fa-file-alt"></i>
                <span>Total Posts: <?php echo $totalPosts; ?></span>
            </div>
            <div class="stat-card">
                <i class="fas fa-eye"></i>
                <span>Total Views: <?php echo $totalViews; ?></span>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <!-- Add post form with rich text editor -->
        <div class="form-section">
            <h2>Add New Post</h2>
            <form action="add_post.php" method="POST" enctype="multipart/form-data">
                <!-- Previous form fields -->
                <div class="form-group">
                    <label>Featured Image:</label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Content:</label>
                    <textarea id="editor" name="content" required></textarea>
                </div>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-plus"></i> Add Post
                </button>
            </form>
        </div>

        <!-- Posts management section -->
        <div class="posts-section">
            <h2>Manage Posts</h2>
            <div class="posts-grid">
                <!-- Display existing posts with edit/delete options -->
            </div>
        </div>
    </div>
</div>

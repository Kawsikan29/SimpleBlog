<?php
include 'db.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Delete Blog Posts</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Blog</a>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" href="createblog.php">Create Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="viewblog.php">View Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="deleteblog.php">Delete Blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    

    <div class="container mt-5">
        <h2 class="mb-4">Delete Blog Posts</h2>

        <!-- Success/Error Messages -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['message']) ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <!-- Blog Posts -->
        <div class="row">
            <?php
            // Fetch all blog posts
            $query = "SELECT * FROM posts ORDER BY timestamp DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0):
                while ($post = mysqli_fetch_assoc($result)):
            ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                        <p class="card-text"><small class="text-muted">Posted on: <?= htmlspecialchars($post['timestamp']) ?></small></p>
                        <!-- Delete Button -->
                        <a href="deleteblog_action.php?id=<?= $post['id'] ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this post?');">
                           Delete
                        </a>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            else:
            ?>
            <p class="text-center">No blog posts found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>

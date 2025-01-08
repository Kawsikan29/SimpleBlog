<?php
include 'db.php'; // Include database connection

// Check if 'id' is set
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $post_id = intval($_GET['id']); 
    // Delete the post
    $query = "DELETE FROM posts WHERE id = $post_id";
    if (mysqli_query($conn, $query)) {
        //success message
        header("Location: deleteblog.php?message=Post successfully deleted!");
        exit();
    } else {
        //error message
        header("Location: deleteblog.php?error=Failed to delete the post.");
        exit();
    }
} else {
    // Redirect to deleteblog.php with an error message
    header("Location: deleteblog.php?error=Invalid post ID.");
    exit();
}
?>

<?php
if(!isset($_SESSION)) { 
    session_start(); 
}

class Gallery {
    public function __construct() {}

    public static function checkValidUser() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }
    }

    public static function displayGallery($page_display=0, $page_counter=PHP_INT_MAX) : array {
        global $connection;

        $query = "SELECT * FROM photos ";
        $query .= "LEFT JOIN users ON photos.user_id = users.user_id ";
        $query .= "LEFT JOIN followers ON photos.user_id = followers.followed_user_id ";
        $query .= "WHERE users.profile_status = 'public' ";
        $query .= "OR followers.user_id = {$_SESSION['user_id']} ";
        $query .= "ORDER BY photos.photo_upload_date DESC ";
        $query .= "LIMIT $page_display, $page_counter";
        
        $result = mysqli_query($connection, $query);
        $posts = [];
        while($row = mysqli_fetch_assoc($result)){
            $posts[] = $row;
        }
        return $posts;
    }

    public static function addComment($comment, $photo_id) : bool {
        global $connection;
        $user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
        $username = mysqli_real_escape_string($connection, $_SESSION['username']);
        $comment = mysqli_real_escape_string($connection, $comment);
        
        $query = "INSERT INTO comments (photo_id, user_id, username, comment, comment_date) VALUES ($photo_id, '$user_id', '$username', '$comment', NOW())";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function checkPostLike($user_id, $photo_id) : bool {
        global $connection;
        $query = "SELECT * FROM likes WHERE user_id = $user_id AND photo_id = $photo_id";
        $result = mysqli_query($connection, $query);
        return mysqli_num_rows($result) > 0;
    }

    public static function checkPostBookmark($user_id, $photo_id) : bool {
        global $connection;
        $query = "SELECT * FROM bookmarks WHERE user_id = $user_id AND photo_id = $photo_id";
        $result = mysqli_query($connection, $query);
        return mysqli_num_rows($result) > 0;
    }

    public static function checkNumberOfComments($photo_id) : int {
        global $connection;
        $query = "SELECT * FROM comments WHERE photo_id = $photo_id";
        $result = mysqli_query($connection, $query);
        return mysqli_num_rows($result);
    }

    public static function displayUserProfileGallery($user_id) : array {
        global $connection;
        $query = "SELECT * FROM photos WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $posts = [];
        while($row = mysqli_fetch_assoc($result)){
            $posts[] = $row;
        }
        return $posts;
    }

    public static function deletePost($photo_id) : bool {
        global $connection;
        $query = "DELETE FROM photos WHERE photo_id = $photo_id";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}
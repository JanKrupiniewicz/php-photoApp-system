<?php
session_start();
include "../includes/db.php";
header('Content-Type: application/json');

if (isset($_POST['action'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];

    if ($action === 'like') {
        $query = "INSERT INTO likes (photo_id, user_id, like_date) VALUES ('$post_id', '$user_id', NOW())";
        $query_like = mysqli_query($connection, $query);

        if (!$query_like) {
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            return;
        }
        $response = ['success' => true];
        echo json_encode($response);
    } else if ($action === 'unlike') {
        $query = "DELETE FROM likes WHERE photo_id = '$post_id' AND user_id = '$user_id'";
        $query_unlike = mysqli_query($connection, $query);
    
        if (!$query_unlike) {
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            return;
        }
    
        $response = ['success' => true];
        echo json_encode($response);
    } else if ($action === 'bookmark') {
        $query = "INSERT INTO bookmarks (photo_id, user_id, bookmark_date) VALUES ('$post_id', '$user_id', NOW())";
        $query_bookmark = mysqli_query($connection, $query);

        if (!$query_bookmark) {
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            return;
        }
        $response = ['success' => true];
        echo json_encode($response);

    } else if ($action === 'unbookmark') {
        $query = "DELETE FROM bookmarks WHERE photo_id = '$post_id' AND user_id = '$user_id'";
        $query_unbookmark = mysqli_query($connection, $query);
    
        if (!$query_unbookmark) {
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            return;
        }
        $response = ['success' => true];
        echo json_encode($response);
    } else if ($action === 'show_comments') {
        $query = "SELECT * FROM comments WHERE photo_id = '$post_id'";
        $query_comments = mysqli_query($connection, $query);

        if(!$query_comments){
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            return;
        }

        if(mysqli_num_rows($query_comments) === 0){
            $response = ['success' => true, 'comments' => []];
            echo json_encode($response);
            return;
        }
        
        $response = ['success' => true, 'comments' => mysqli_fetch_all($query_comments, MYSQLI_ASSOC)];
        echo json_encode($response);
    }
}

<?php
session_start();
include "../includes/db.php";
header('Content-Type: application/json');

if (isset($_POST['follow_action'])) {
    $user_id = $_SESSION['user_id'];
    $followed_user_id = $_POST['usr_id'];
    $action = $_POST['follow_action'];

    if ($action === 'follow') {
        $query = "INSERT INTO followers (user_id, followed_user_id) VALUES ('$user_id', '$followed_user_id')";
        $query_follow = mysqli_query($connection, $query);
    
        if (!$query_follow) {
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            exit;
        }
    
        $response = ['success' => true];
        echo json_encode($response);
        die();
    } else if ($action === 'unfollow') {
        $query = "DELETE FROM followers WHERE user_id = '$user_id' AND followed_user_id = '$followed_user_id'";
        $query_unfollow = mysqli_query($connection, $query);
    
        if (!$query_unfollow) {
            $response = ['success' => false, 'error' => 'Query failed.'];
            echo json_encode($response);
            exit;
        }
    
        $response = ['success' => true];
        echo json_encode($response);
        die();
    }
}

<?php
class Post {
    public function __construct() {}

    public static function createPost($title, $description, $user_id) : bool {
        global $connection;
        $title = mysqli_real_escape_string($connection, $title);
        $content = mysqli_real_escape_string($connection, $description);
        $user_id = mysqli_real_escape_string($connection, $user_id);

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($post_image_temp, "img/post_img/$post_image");

        $query = "INSERT INTO photos (photo_title, photo_description, photo, photo_upload_date, user_id) VALUES ('$title', '$content', '$post_image', NOW(), '$user_id')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public static function getPost($id) : array {
        global $connection;
        $query = "SELECT * FROM posts WHERE post_id = $id";
        $result = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result);
        return $post;
    }

    public static function deletePost($id) : bool {
        global $connection;
        $query = "DELETE FROM posts WHERE post_id = $id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public static function updatePost($id, $title, $content, $image) : bool {
        global $connection;
        $title = mysqli_real_escape_string($connection, $title);
        $content = mysqli_real_escape_string($connection, $content);
        $image = mysqli_real_escape_string($connection, $image);
        $query = "UPDATE posts SET post_title = '$title', post_content = '$content', post_image = '$image' WHERE post_id = $id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }
}
<?php
class User {
    public function __construct() {}

    public static function unfollowUser($followed_user_id) : bool {
        global $connection;
        $user_id = $_SESSION['user_id'];
        $query = "DELETE FROM followers WHERE user_id = $user_id AND followed_user_id = $followed_user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public static function getFollowing() : array {
        global $connection;
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM ";
        $query .= "users LEFT JOIN followers ON followers.followed_user_id = users.user_id ";
        $query .= "WHERE followers.user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $following = [];
        while($row = mysqli_fetch_assoc($result)){
            $following[] = $row;
        }
        return $following;
    }

    public static function getFollowers() : array {
        global $connection;
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM ";
        $query .= "users LEFT JOIN followers ON followers.user_id = users.user_id ";
        $query .= "WHERE followers.followed_user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $followers = [];
        while($row = mysqli_fetch_assoc($result)){
            $followers[] = $row;
        }
        return $followers;
    }

    public static function getProfileStatus() {
        global $connection;
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['profile_status'];
    }

    public static function changeProfileInfo($name, $email, $password, $cpassword) {
        global $connection;

        if($name === "") {
            $name = $_SESSION['username'];
        }
        if($email === "") {
            $email = $_SESSION['user_email'];
        }
        if($password === "") {
            if (!self::validate($name, $email)) {
                return false;
            }
            $get_password_query = "SELECT user_password FROM users WHERE user_id = {$_SESSION['user_id']}";
            $get_password_result = mysqli_query($connection, $get_password_query);
            $row = mysqli_fetch_assoc($get_password_result);
            $password = $row['user_password'];

        } else {
            if (!self::validate($name, $email, $password, $cpassword)) {
                return false;
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $user_id = $_SESSION['user_id'];
        $query = "UPDATE users SET username = '$name', user_email = '$email', user_password = '$password' WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public static function changeSessionInformation($name, $email) : void {
        $_SESSION['username'] = $name;
        $_SESSION['user_email'] = $email;
    }

    public static function changeProfileStatus($profile_status) : bool {
        global $connection;
        $user_id = $_SESSION['user_id'];
        $query = "UPDATE users SET profile_status = '$profile_status' WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public static function registerUser($name, $email, $password, $cpassword) : bool {
        global $connection;
        if (!self::validate($name, $email, $password, $cpassword)) {
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, user_email, user_password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public static function logoutUser() : void {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header("Location: index.php");
        exit();
    }

    public static function loginUser($user_data, $password) : void {
        global $connection;
        $query = "SELECT * FROM users ";
        $query .= "WHERE username = '$user_data' OR user_email = '$user_data' ";
        $select_user_query = mysqli_query($connection, $query);

        if(!$select_user_query){
            return;
        }

        $select_user = mysqli_fetch_assoc($select_user_query);
        if($select_user === null) {
            return;
        }

        $db_username = $select_user['username'];
        $db_user_mail = $select_user['user_email'];
        $db_user_password = $select_user['user_password'];

        if(($user_data !== $db_username && $user_data !== $db_user_mail) || !password_verify($password, $db_user_password)) {
            return;
        }

        $_SESSION['user_id'] = $select_user['user_id'];
        $_SESSION['username'] = $db_username;
        $_SESSION['user_email'] = $db_user_mail;
        header("Location: gallery.php");
        exit();
    }

    public static function getNumberFollowers($user_id) : int {
        global $connection;
        $query = "SELECT * FROM followers WHERE followed_user_id = $user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return 0;
        }
        return mysqli_num_rows($result);
    }

    public static function searchUsers($search) : array {
        global $connection;
        $query = "SELECT * FROM users WHERE username LIKE '%$search%' AND user_id != {$_SESSION['user_id']}";
        $result = mysqli_query($connection, $query);
        $users = [];
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
        return $users;
    }

    public static function checkFollow($user_id, $followed_user_id) : bool {
        global $connection;
        $query = "SELECT * FROM followers WHERE user_id = $user_id AND followed_user_id = $followed_user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        return mysqli_num_rows($result) > 0;
    }   

    public static function getNumberFollowing($user_id) : int {
        global $connection;
        $query = "SELECT * FROM followers WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return 0;
        }
        return mysqli_num_rows($result);
    }

    private static function validate(&$name, &$email, &$password="some_valid_password123", $cpassword="some_valid_password123") : bool {
        if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
            return false;
        } 
        
        $name = self::test_input($name);
        $email = self::test_input($email);
        $password = self::test_input($password);
        $cpassword = self::test_input($cpassword);

        if($password !== $cpassword) {
            return false;
        }

        if(strlen($password) < 2) {
            return false;
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/",$name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function getUserByID($user_id) : array {
        global $connection;
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    private static function test_input($data) : string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
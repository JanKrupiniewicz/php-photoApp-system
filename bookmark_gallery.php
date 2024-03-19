<?php 
include "includes/header.php"; 
include "includes/navbar.php";

Gallery::checkValidUser();
?>
<body class="d-flex flex-column min-vh-100">
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-10">
                <?php
                    $page = "";
                    $page_counter = 5;
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } 

                    if($page == "" || $page == 1) {
                        $page_display = 0;
                    } else {
                        $page_display = $page * $page_counter - $page_counter;
                    }

                    $query = "SELECT * FROM bookmarks WHERE user_id = {$_SESSION['user_id']}";
                    $select_all_query = mysqli_query($connection, $query);
                    $posts_number = mysqli_num_rows($select_all_query);
                    $posts_number = ceil($posts_number / $page_counter);

                    if (mysqli_num_rows($select_all_query) == 0) {
                        echo "<h1 class='text-center display-4 m-5 p-5' > No posts available. </h1>";
                    } else {
                        $query = "SELECT * FROM bookmarks WHERE user_id = {$_SESSION['user_id']} ";
                        $query .= " LIMIT $page_display, $page_counter";
                        $select_limit_query = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_assoc($select_limit_query)) {
                            $query = "SELECT * FROM photos WHERE photo_id = {$row['photo_id']}";
                            $select_photo_query = mysqli_query($connection, $query);
                            $photo = mysqli_fetch_assoc($select_photo_query);

                            $post_id = $photo['photo_id'];
                            $post_title = $photo['photo_title'];
                            $post_author = User::getUserByID($photo['user_id'])['username'];
                            $post_date = $photo['photo_upload_date'];
                            $post_image = $photo['photo'];
                            $post_content = $photo['photo_description'];
                            ?>
                            <div class="pt-3">
                                <div class="p-2 shadow">
                                    <div class="row align-items-center justify-content-between">   
                                        <div class="col-md text-end">
                                            <p class="lead">
                                                <?php echo $post_author . ' '?> <i class="bi bi-three-dots-vertical"></i> <?php echo ' '.  $post_date ?>
                                            </p>
                                        </div>
                                    </div>
                                    <a href="post.php?p_id=<?= $post_id ?>">
                                        <img class="img-fluid" src="img/post_img/<?= $post_image ?>" alt="">
                                    </a>
                                    <div class="card-body text-start pt-2">
                                        <h5 class="d-inline"><?php echo $post_title; ?> <i class="bi bi-caret-right"></i> </h5>
                                        <p class="d-inline"><?php echo $post_content; ?></p>
                                    </div>
                                </div>
                            </div>
                <?php } } ?>

                <ul class="pager text-center m-5">
                    <?php 
                        for($i = 1; $i <= $posts_number; $i++) {
                            if ($i == $page) {
                                echo "<a class='btn btn-dark active_link m-2' href='gallery.php?page={$i}'>{$i}</a>";
                            } else {
                                echo "<a class='btn btn-light' href='gallery.php?page={$i}'>{$i}</a>";
                            }
                            
                            if($i % 10 == 0) {
                                echo '<br>';
                            }
                        }
                    ?>
                </ul>                        
            </div>
        </div>
    </div>
</body>

<?php include "includes/bg-dark_footnote.php"; ?>
<?php include "includes/footer.php"; ?>
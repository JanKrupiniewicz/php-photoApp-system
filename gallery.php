<?php 
include "includes/header.php"; 
include "includes/navbar.php";

Gallery::checkValidUser();

if(isset($_POST['add_comment'])) {
    Gallery::addComment($_POST['comment'], $_POST['photo_id']);
}

?>

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

                $posts = Gallery::displayGallery();
                $posts_number = count($posts)/$page_counter;

                if (count($posts) == 0) {
                    echo "<h1 class='text-center m-3' > No posts available. </h1>";
                } else {
                    $query = "SELECT * FROM photos ";
                    $query .= "LEFT JOIN users ON photos.user_id = users.user_id ";
                    $query .= "WHERE users.profile_status = 'public' ";
                    $query .= "ORDER BY photos.photo_upload_date DESC ";
                    $query .= "LIMIT $page_display, $page_counter";
                    $select_limit_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_limit_query)) { ?>
                        <div class="pt-3">
                            <div class="p-2 shadow">
                                <div class="row align-items-center justify-content-between">   
                                    <div class="col-md text-end">
                                        <p class="lead">
                                            <?= User::getUserByID($row['user_id'])['username'] . ' '?> <i class="bi bi-three-dots-vertical"></i> <?= ' '.  $row['photo_upload_date'] ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="post.php?p_id=<?= $row['photo_id'] ?>">
                                    <img class="img-fluid" src="img/post_img/<?= $row['photo'] ?>" alt="">
                                </a>
                                <div class="row align-items-center justify-content-between mt-3">
                                    <div class="col-md text-start">
                                        <div class="card-body text-start">
                                            <h4 
                                                class="d-inline" 
                                                id="like_button_<?php echo $row['photo_id']; ?>" 
                                                onclick="likePostAsync('<?php echo $row['photo_id']; ?>')" > 
                                                <?php if(Gallery::checkPostLike($_SESSION['user_id'], $row['photo_id'])): ?>
                                                    <i class="bi bi-hand-thumbs-up-fill"></i>
                                                <?php else: ?>
                                                    <i class="bi bi-hand-thumbs-up"></i>
                                                <?php endif; ?>
                                            </h4>
                                            <h4 
                                                class="d-inline" 
                                                id="comment_button_<?php echo $row['photo_id']; ?>" 
                                                onclick="commentPostAsync('<?php echo $row['photo_id']; ?>')"> 
                                                <i class="bi bi-chat-right"></i>
                                            </h4>
                                            <?php if(Gallery::checkNumberOfComments($row['photo_id']) == 0): ?>
                                                <small> No comments available. </small>
                                            <?php else: ?>
                                                <small> View all <?= Gallery::checkNumberOfComments($row['photo_id'])?> comments ... </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>    
                                    <div class="col-md text-start">
                                        <h4 
                                            class="text-end" 
                                            id="bookmark_button_<?php echo $row['photo_id']; ?>" 
                                            onclick="bookmarkPostAsync('<?php echo $row['photo_id']; ?>')"> 
                                            <?php if(Gallery::checkPostBookmark($_SESSION['user_id'], $row['photo_id'])): ?>
                                                <i class="bi bi-bookmark-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-bookmark"></i>
                                            <?php endif; ?>
                                        </h4>
                                    </div>    
                                </div>
                                <div class="card-body text-start pt-2">
                                    <h5 class="d-inline"><?= $row['photo_title'] ?> <i class="bi bi-caret-right"></i> </h5>
                                    <p class="d-inline"><?= $row['photo_description'] ?></p>
                                </div>

                                <div class="mt-3 border-top border-black text-start">
                                    <form action="gallery.php" method="post">
                                        <div class="input-group mt-2">
                                            <input type="hidden" name="photo_id" value="<?= $row['photo_id'] ?>">
                                            <input type="text" name="comment" class="form-control" placeholder="Add a comment ... " aria-label="Add a comment" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <input class="btn btn-outline-secondary" name="add_comment" type="submit" value="Add"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="pt-2" id="comments_container_<?=$row['photo_id']?>"> 
                                    
                            
                                </div>
                            </div>
                        </div>
            <?php } } ?>

            <ul class="pager text-center m-5">
                <?php 
                    for($i = 1; $i <= $posts_number; $i++) {
                        if ($i == $page || $page == "" && $i == 1) {
                            echo "<a class='btn btn-dark active_link m-2' href='gallery.php?page={$i}'>{$i}</a>";
                        } else {
                            echo "<a class='btn btn-light m-1' href='gallery.php?page={$i}'>{$i}</a>";
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

<footer class="p-5 bg-dark text-white text-center position-relative">
    <div class="container">
        <p class="lead">Copyright  &copy; 2024 PhotoApp </p>
    </div>
</footer>

<?php include "includes/footer.php"; ?>
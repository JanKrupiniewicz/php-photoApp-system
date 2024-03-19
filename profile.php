<?php
include "includes/header.php"; 
include "includes/navbar.php";

Gallery::checkValidUser();
$user_posts = Gallery::displayUserProfileGallery($_SESSION['user_id']);

if(isset($_GET['delete'])){
    $photo_id = $_GET['delete'];
    Gallery::deletePost($photo_id);
    header("Location: profile.php");
    exit;
}

if(isset($_POST["create_post"])) {
    if(Post::createPost($_POST['title'], $_POST['content'], $_SESSION['user_id'])) {
        header("Location: profile.php");
        exit;
    }
}

if(isset($_POST['change_profile_status'])) {
    if(User::changeProfileStatus($_POST['profile_status'])) {
        header("Location: profile.php");
        exit;
    }
}

if(isset($_POST['change_profile_info'])) {
    if(User::changeProfileInfo($_POST['name'], $_POST['email'], $_POST['password'], $_POST['cpassword'])) {
        User::changeSessionInformation($_POST['name'], $_POST['email']);
        header("Location: profile.php");
        exit;
    } 
}

if(isset($_POST['unfollow_user'])) {
    if(User::unfollowUser($_POST['unfollow'])) {
        header("Location: profile.php");
        exit;
    }
}

include "modals/edit_profile_modal.php";
include "modals/add_post_modal.php";
include "modals/show_followers_modal.php";
include "modals/show_following_modal.php";
?>

<body class="d-flex bg-light flex-column min-vh-100">
    <section class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 m-5 pt-5">
                <div class="row shadow">
                    <div class="col-sm-4 bg-primary">
                        <div class="card-block text-center text-white">
                            <h2 class="font-weight-bold mt-4"><?= $_SESSION['username'] ?></h2>
                            <p><?= $_SESSION['user_email'] ?></p>
                            <h1><i class="bi bi-journal-bookmark-fill"></i></h1>
                            <a 
                                href="#" 
                                data-bs-toggle="modal" 
                                data-bs-target="#edit_profile_modal" 
                                class="btn btn-light text-primary m-3"> 
                                <i class="bi bi-gear-fill"></i> Edit 
                            </a>
                            <a href="#" class="btn btn-light text-primary m-3"> <i class="bi bi-bar-chart-steps"></i> Activity</a>
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white">
                        <h3 class="mt-3 text-center">Your Profile</h3>
                        <table class="table text-center">
                            <tr>
                                <td>Your Posts</td>
                                <td><?= count($user_posts) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <a 
                                    href="#"
                                    class="text-decoration-none text-dark"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#show_followers_modal">
                                    Followers 
                                    </a>    
                                </td>
                                <td><?= User::getNumberFollowers($_SESSION['user_id']) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <a 
                                    href="#"
                                    class="text-decoration-none text-dark"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#show_following_modal">
                                    Following 
                                    </a>    
                                </td>
                                <td><?= User::getNumberFollowing($_SESSION['user_id']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md py-3">
                    <div class="shadow h-100 w-100 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <div class="p-2"> <h1> <i class="bi bi-plus-square"></i> <h1> </div>
                            <div class="p-2">
                                <a 
                                    href="#"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#add_new_post_modal"  
                                    class="btn btn-primary m-2">
                                    Add New Post
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php for ($i = 0; $i < 2; $i++): ?>
                    <?php if (count($user_posts) > $i): ?>
                        <div class="col-md py-3">
                            <div class="bg-grey shadow text-black h-100">
                                <div class="card-body text-center">
                                    <img src="img/post_img/<?= $user_posts[$i]['photo'] ?>" class="img-fluid" alt="">
                                    <h4 class="pt-3">
                                        <?= $user_posts[$i]['photo_title'] ?>
                                    </h4>

                                    <p class="card-text lead">
                                        <i class="bi bi-calendar3"></i> <?= $user_posts[$i]['photo_upload_date'] ?>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-caret-right"></i> <?= $user_posts[$i]['photo_description'] ?>
                                    </p>
                                    <a href="profile.php?delete=<?=$user_posts[$i]['photo_id']?>" class="btn btn-primary m-2">Delete Post</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

            <?php for ($i = 1; $i < count($user_posts) / 3 + 1; $i++): ?>
                <div class="row">
                    <?php for ($j = 0; $j < 3; $j++): ?>
                        <?php $index = 3 * $i + $j - 1; ?>
                        <?php if (count($user_posts) > $index): ?>
                            <div class="col-md py-3">
                                <div class="bg-grey shadow text-black h-100">
                                    <div class="card-body text-center">
                                        <img src="img/post_img/<?= $user_posts[$index]['photo'] ?>" class="img-fluid" alt="">
                                        <h4 class="pt-3">
                                            <?= $user_posts[$index]['photo_title'] ?>
                                        </h4>

                                        <p class="card-text lead">
                                            <i class="bi bi-calendar3"></i> <?= $user_posts[$index]['photo_upload_date'] ?>
                                        </p>
                                        <p class="card-text">
                                            <i class="bi bi-caret-right"></i> <?= $user_posts[$index]['photo_description'] ?>
                                        </p>
                                        <a href="profile.php?delete=<?=$user_posts[$index]['photo_id']?>" class="btn btn-primary m-2">Delete Post</a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-md py-3"></div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
    </section>
</body>

<?php include "includes/bg-dark_footnote.php"; ?>
<?php include "includes/footer.php"; ?>

<?php
include "includes/header.php"; 
include "includes/navbar.php";

Gallery::checkValidUser();
$user_posts = Gallery::displayUserProfileGallery($_GET['u_id']);
$viewd_user = User::getUserByID($_GET['u_id']);

if($_SESSION['user_id'] == $_GET['u_id']) {
    header("Location: profile.php");
    exit;
}

if(isset($_POST["create_post"])) {
    Post::createPost($_POST['title'], $_POST['content'], $_SESSION['user_id']);
}
?>
<body class="d-flex flex-column bg-light min-vh-100">
    <section class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 m-5 pt-5">
                <div class="row shadow">
                    <div class="col-sm-4 bg-primary">
                        <div class="card-block text-center text-white">
                            <i class="bi bi ri-person-circle fs-1"></i>
                            <h2 class="font-weight-bold mt-4"><?= $viewd_user['username'] ?></h2>
                            <p><?= $viewd_user['user_email'] ?></p>
                            <button 
                                class="btn btn-light text-primary m-3" 
                                id="follow_button_<?= $viewd_user['user_id'] ?>" 
                                onclick="followUserAsync('<?= $viewd_user['user_id'] ?>')" 
                                type="submit"> 
                                <?php if(!User::checkFollow($_SESSION['user_id'], $viewd_user['user_id'])): ?>
                                    Follow
                                <?php else: ?>
                                    Unfollow
                                <?php endif; ?>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white">
                        <h3 class="mt-3 text-center"><?= $viewd_user['username'] ?> Profile</h3>
                        <table class="table text-start">
                            <tr>
                                <td>Post's</td>
                                <td><?= count($user_posts) ?></td>
                            </tr>
                            <tr>
                                <td>Followers</td>
                                <td id="followers_counter_<?= $viewd_user['user_id'] ?>"><?= User::getNumberFollowers($viewd_user['user_id']) ?></td>
                            </tr>
                            <tr>
                                <td>Following</td>
                                <td><?= User::getNumberFollowing($viewd_user['user_id']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if($viewd_user['profile_status'] == 'private' && !User::checkFollow($_SESSION['user_id'], $_GET['u_id'])): ?>
        <section class="bg-ligh m-5 p-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="display-4">This profile is private</h1>
                        <p class="lead">You need to follow this user to see their posts.</p>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="bg-light">
            <div class="container">
                <div class="row">
                    <?php for ($i = 0; $i < count($user_posts) / 3; $i++): ?>
                        <div class="row">
                            <?php for ($j = 0; $j < 3; $j++): ?>
                                <?php $index = 3 * $i + $j; ?>
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
                                                <p class="card-text p-2">
                                                    <i class="bi bi-caret-right"></i> <?= $user_posts[$index]['photo_description'] ?>
                                                </p>
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
            </div>
        </section>
    <?php endif; ?>
</body>

<?php include "includes/bg-dark_footnote.php"; ?>
<?php include "includes/footer.php"; ?>

<?php
include "includes/header.php"; 
include "includes/navbar.php";

Gallery::checkValidUser();
?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col-8">
            <?php
                if(!isset($_POST["search"])) {
                    header("Location: index.php");
                    exit;
                }

                $users = User::searchUsers($_POST["search"]);
                if(count($users) == 0) {
                    echo "<h1 class='text-center m-3'> No users found. </h1>";
                    include "includes/footer.php";
                    exit;
                }

                foreach($users as $user): ?>
                    <div class="pt-3">
                        <div class="row align-items-center justify-content-between shadow pb-3">
                            <div class="col-md-auto">
                                <a href="show_profile.php?u_id=<?= $user['user_id'] ?>">
                                    <i class="bi bi-person-circle fs-1"></i>
                                </a>
                            </div>

                            <div class="col-md text-start">
                                <div class="p-2">
                                    <p class="lead">
                                        <?php echo $user['username'] . ' '?> <i class="bi bi-three-dots-vertical"></i> <?php echo ' '.  $user['user_email'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
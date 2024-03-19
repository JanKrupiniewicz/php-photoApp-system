<?php  
$following = User::getFollowing(); 
?>

<div class="modal" id="show_following_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Creators you Follow</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php foreach ($following as $follower): ?>
                        <li class="list-group-item">
                        <div class="row">
                            <div class="col-md py-3">
                                <a href="show_profile.php?u_id=<?= $follower['followed_user_id'] ?>" class="text-decoration-none text-dark">
                                    <?= $follower['username'] ?>
                                </a>
                            </div>
                            <div class="col-md py-3">
                                <form action="profile.php" method="post">
                                    <input type="hidden" name="unfollow" value="<?= $follower['followed_user_id'] ?>">
                                    <input type="submit" class="btn btn-danger" name="unfollow_user" value="Unfollow">
                                </form>
                            </div>
                        </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
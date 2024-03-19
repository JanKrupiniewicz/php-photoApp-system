<?php  
$followers = User::getFollowers(); 
?>

<div class="modal" id="show_followers_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Your Followers</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php foreach ($followers as $follower): ?>
                        <li class="list-group-item">
                            <a href="show_profile.php?u_id=<?= $follower['user_id'] ?>" class="text-decoration-none text-dark">
                                <?= $follower['username'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
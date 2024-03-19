<div class="modal" id="edit_profile_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Profile</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4"> 
                    <p class="lead text-center"> Profile Status </p>
                    <p class="small text-center"> <?php echo "Current status: " . User::getProfileStatus() ?> </p>
                    <form action="profile.php" method="post">
                    <div class="form-group">
                    <select name="profile_status" class="form-control">
                        <option value="private">Private</option>
                        <option value="public">Public</option>
                    </select>
                    <input type="submit" name="change_profile_status" class="btn btn-primary mt-2" value="Change Profile Status">
                    </div>
                </form>
                </div>

                <div class="mb-4 border-top">
                    <p class="lead text-center">Profile Informations</p>
                    <form action="profile.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="change_profile_info" class="btn btn-primary" value="Change Profile Informations">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
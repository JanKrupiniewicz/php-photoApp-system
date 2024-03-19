<div class="modal" id="add_new_post_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Post</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="profile.php" method="post" enctype="multipart/form-data">
                    <div class="form-group"> 
                        <input class="btn" type="file" name="image">
                    </div>

                    <div class="form-group"> 
                        <label for="title"> Post Title </label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="form-group"> 
                        <label for="content"> Post Content </label>
                        <textarea class="form-control" name="content" id="summernote" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group text-center my-2">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="btn btn-primary btn-block" type="submit" name="create_post" value="Publish Post">
                            </div>
                            <div class="col-md-6">
                                <input class="btn btn-outline-primary btn-block" type="reset" value="Clear Changes">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
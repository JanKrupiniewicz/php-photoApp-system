<?php 
include "includes/header.php"; 
include "includes/navbar.php";

Gallery::checkValidUser();
if(isset($_POST["create_post"])) {
    Post::createPost($_POST['title'], $_POST['content'], $_SESSION['user_id']);
}

?>

<section class="bg-primary text-light p-4">
    <div class="container mt-5"> 
        <div class="d-md-flex align-items-center justify-content-between">
            <h3 class="mb-3 mb-md-0"> Add new post to your profile </h3>
        </div>
    </div>
</section>

<div class="col-md-9 mx-auto px-2 py-2">
    <div class="card">
        <div class="card-header">
            <h4>Create new Post</h4>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- display selected photo -->

                <!-- <div class="text-center">
                    <label for="image">
                        <img class="img-fluid mx-auto" src="img\website_img\undraw_projections_re_ulc6.svg">
                    </label>
                </div> -->

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

<?php include "includes/footer.php"; ?>
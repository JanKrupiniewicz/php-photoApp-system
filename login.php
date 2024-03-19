<?php 
include "includes/header.php"; 
include "includes/navbar.php";

if (isset($_POST["login"])) {
    User::loginUser($_POST["name"], $_POST["password"]);
}

?>

<section class="bg-primary text-light p-4">
    <div class="container mt-5"> 
        <div class="d-md-flex align-items-center justify-content-between">
            <h3 class="mb-3 mb-md-0"> Login </h3>
        </div>
    </div>
</section>

<div class="col-md-6 mx-auto px-2 py-5">
    <div class="card">
        <div class="card-header">
            <h4>Login Form</h4>
        </div>
        <div class="card-body">
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nickname or Email</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" name="login" class="btn btn-primary" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
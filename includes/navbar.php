<?php 
if (isset($_POST['logout'])) {
    User::logoutUser();
}
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 fixed-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">PhotoGallery App</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <?php if (!isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="gallery.php" class="nav-link">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="bookmark_gallery.php" class="nav-link">Saved</a>
                    </li>
                    <form method="post" action="">
                        <li class="nav-item">
                            <button type="submit" class="nav-link text-primary" name="logout">Logout</button>
                        </li>
                    </form>
                <?php endif; ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="col-sm">
                <form class="d-flex" action="search.php" method="post">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</nav>

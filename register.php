<?php 
include "includes/header.php"; 
include "includes/navbar.php";

if (isset($_POST["register"])) {
    $status = User::registerUser($_POST["name"], $_POST["email"], $_POST["password"], $_POST["cpassword"]);
}

?>

<section class="bg-primary text-light p-5">
    <div class="container mt-5"> 
        <div class="d-md-flex align-items-center justify-content-between">
            <h3 class="mb-3 mb-md-0">Still having thoughts about registering ?</h3>
        </div>
    </div>
</section>

<!-- questions accordion -->
<section class="pt-5"> 
    <div class="container">
        <h2 class="text-center mb-4">Advantages of using our website</h2>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    Connectivity and Communication
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliquam?
                    <br><br>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliquam?
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    Information and Awareness
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliqu
                    <br><br>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliquam?
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    Personal Expression and Creativity
                </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliqu
                    <br><br>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliquam?
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    Entertainment
                </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                <div class="accordion-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliqu
                    <br><br>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptas amet deleniti, doloremque veniam odio adipisci. Quas nobis vitae amet, 
                    qui facilis officiis corrupti, maxime nam consequatur quia repudiandae voluptate nulla magnam nesciunt. 
                    Illum, animi? Voluptatibus quasi itaque magnam suscipit modi inventore. Iure, porro? Quod perferendis 
                    blanditiis id a ipsum aliquam?
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="col-md-6 mx-auto px-2 py-5">
    <div class="card">
        <div class="card-header">
            <h4>Register Form</h4>
        </div>
        <div class="card-body">
            <form action="register.php" method="post">
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
                    <input type="submit" name="register" class="btn btn-primary" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>


<footer class="p-5 bg-dark text-white text-center position-relative">
    <div class="container">
        <p class="leaad">Copyright  &copy; 2024 PhotoApp </p>
    </div>
</footer>

<?php include "includes/footer.php"; ?>
<?php
    session_start();
    $page_title = "Sign up";
    require "includes/header.php";
?>

<?php require "includes/nav.php"; ?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                    if(isset($_SESSION["status"])) {
                ?>
                <div class="alert alert-warning">
                    <h4><?= $_SESSION["status"]; ?></h4>
                </div>
                <?php unset($_SESSION["status"]); }?>
                <?php
                    if(isset($_SESSION["success-status"])) {
                ?>
                <div class="alert alert-success">
                    <h4><?= $_SESSION["success-status"]; ?></h4>
                </div>
                <?php unset($_SESSION["success-status"]); }?>
                <div class="card shadow">
                    <div class="card-header">
                        <h1>Sign up</h1>
                    </div>
                    <div class="card-body">
                        <form action="includes/signup.inc.php" method="post">
                        <?php if(isset($_GET["firstname"])) {  $firstname = $_GET["firstname"]; ?>
                            <div class="form-group mb-3">
                                <label for="firstname">First name</label>
                                <input type="text" name="firstname" id="firstname" placeholder="First name" value="<?= $firstname ?>">
                            </div>
                        <?php } else { ?>
                            <div class="form-group mb-3">
                                <label for="firstname">First name</label>
                                <input type="text" name="firstname" id="firstname" placeholder="First name">
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET["lastname"])) { $lastname = $_GET["lastname"];?>
                            <div class="form-group mb-3">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" placeholder="Last name" value="<?= $lastname ?>">
                            </div>
                        <?php } else { ?>
                            <div class="form-group mb-3">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" placeholder="Last name">
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET["email"])) { $email = $_GET["email"];?>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" value="<?= $email ?>">
                            </div>
                        <?php } else { ?>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email">
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET["username"])) { $username = $_GET["username"];?>
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username" value="<?= $username ?>">
                            </div>
                        <?php } else { ?>
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username">
                            </div>
                        <?php } ?>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
<?php
    session_start();
    $page_title = "Log in";
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
                <?php unset($_SESSION["status"]); } ?>
                <?php
                    if(isset($_SESSION["success-status"])) {
                ?>
                <div class="alert alert-success">
                    <h4><?= $_SESSION["success-status"]; ?></h4>
                </div>
                <?php unset($_SESSION["success-status"]); } ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h1>Login</h1>
                    </div>
                    <div class="card-body">
                        <form action="includes/login.inc.php" method="post">
                            <div class="form-group mb-3">
                                <label for="email_username">Email or Username</label>
                                <input type="text" name="username" id="username" placeholder="Email or username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Log in</button>
                            </div>
                            <div class="form-group">
                                <p>Did not receive your Verification Email <a href="resendEmailVerify.php">Click this to Resend</a></p>
                            </div>
                            <div class="form-group">
                                <a href="forgotPassword.php">Forgot Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
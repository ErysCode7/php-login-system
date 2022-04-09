<?php session_start(); ?>

<?php $page_title ="Forgot Password"; ?>

<?php require "includes/header.php"; ?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if(isset($_SESSION["status"])) { ?>
                <div class="alert alert-warning">
                    <h4><?= $_SESSION["status"]; ?></h4>
                </div>
                <?php unset($_SESSION["status"]); } ?>
                <?php if(isset($_SESSION["success-status"])) { ?>
                <div class="alert alert-success">
                    <h4><?= $_SESSION["success-status"]; ?></h4>
                </div>
                <?php unset($_SESSION["success-status"]); } ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h1>Forgot Password</h1>
                        <p>Enter your email to send a reset password</p>
                    </div>
                    <div class="card-body">
                        <form action="includes/forgotPassword.inc.php" method="post">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email here...">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Send reset password link to my email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
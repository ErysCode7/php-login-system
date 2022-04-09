<?php
    require "includes/authentication.php";
    $page_title = "Dashboard";
    require "includes/header.php";
?>

<?php require "includes/nav.php"; ?>

<?php
    require "includes/config.php";
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                        <h1>Upload</h1>
                    </div>
                    <div class="card-body">
                        <form action="includes/dashboard-upload.php" method="post" enctype="multipart/form-data">
                        <?php 
                            $sql = "SELECT * FROM profileimage WHERE usersid = ?";
                            $stmt = mysqli_stmt_init($con);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                $_SESSION["status"] = "Something went wrong";
                                header("Location: dashboard.php");
                                exit();
                            } else {
                                $usersid = $_SESSION["auth_user"]["id"];
                                mysqli_stmt_bind_param($stmt, "s", $usersid);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                $row = $result->fetch_assoc();
                            }
                        ?>
                            <?php if(!isset($row["status"]) || $row["status"] == 0) { ?>
                                <img src="../assets/Images/placeholder.png" alt="Profile image" class="profile-image">
                            <?php } else { ?>
                                <?php 
                                    $fileName = "includes/uploads/PROFILE".$usersid."*";
                                    $fileInfo = glob($fileName);
                                    $fileExt = explode(".", $fileInfo[0]);
                                    $fileExtension = $fileExt[1];
                                    print_r($fileExtension);
                                ?>
                                <img src="includes/uploads/PROFILE<?php echo $usersid; ?>.<?php echo $fileExtension; ?>?<?php echo mt_rand();?>" alt="Profile image" class="profile-image">
                            <?php } ?>
                            <div class="profile-upload">
                                <div class="form-group mb-3">
                                    <input type="file" name="profile-image" id="profile-image">
                                </div>
                            </div>
                            <div class="profile-upload">
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                        <form action="includes/dashboard-delete.php" method="post">
                            <div class="profile-upload">
                                <div class="form-group mb-3">
                                    <button type="submit" name="delete" class="btn btn-danger">Delete Profile Image</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(isset($_SESSION["success-status"])) {
                ?>
                <div class="alert alert-success">
                    <h4><?= $_SESSION["success-status"]; }?></h4>
                </div>
                <?php unset($_SESSION["success-status"]); ?>
                <div class="card">
                    <div class="card-header">
                         <h4>User Dashboard</h4>
                     </div>
                     <div class="card-body">
                         <h4>Access When you are Logged in</h4>
                         <hr>
                         <h5>ID: <?php echo $_SESSION["auth_user"]["id"]; ?></h5>
                         <h5>FIRST NAME: <?php echo $_SESSION["auth_user"]["first_name"]; ?></h5>
                         <h5>LAST NAME: <?php echo $_SESSION["auth_user"]["last_name"]; ?></h5>
                         <h5>EMAIL: <?php echo $_SESSION["auth_user"]["email"]; ?></h5>
                         <h5>USERNAME: <?php echo $_SESSION["auth_user"]["username"]; ?></h5>
                         <h5>CREATED AT: <?php echo $_SESSION["auth_user"]["created_at"]; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(isset($_SESSION["success-status"])) {
                ?>
                <div class="alert alert-success">
                    <h4><?= $_SESSION["success-status"]; }?></h4>
                </div>
                <?php unset($_SESSION["success-status"]); ?>
                <div class="card">
                    <div class="card-header">
                         <h4>User Dashboard</h4>
                     </div>
                     <div class="card-body">
                       <form action="search-article.php" method="post">
                           <input type="text" name="search" id="search" placeholder="Search">
                           <button type="submit" name="submit" class="btn btn-primary">Search</button>
                       </form>
                       <?php
                            $sql = "SELECT * FROM article;";
                            $result = $con->query($sql);
                       ?>
                       <?php while($row = $result->fetch_assoc()) { ?>   
                       <article class="article">
                           <h3><?php echo $row["title"]; ?></h3>
                           <h4><?php echo $row["content"]; ?></h4>
                           <h5><?php echo $row["author"]; ?></h5>
                           <h5><?php echo $row["created_at"]; ?></h5>
                       </article>
                       <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>


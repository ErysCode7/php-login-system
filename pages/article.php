<?php
    session_start();
    $page_title = "Article";
    require "includes/header.php";
?>

<?php require "includes/nav.php"; ?>

<?php
    require "includes/config.php";
?>


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
                        <?php 
                            $title = mysqli_real_escape_string($con, $_GET["title"]);
                            $created_at = mysqli_real_escape_string($con, $_GET["created_at"]);
                            $sql = "SELECT * FROM article WHERE title = '$title' AND created_at = '$created_at';";
                            $results = $con->query($sql);
                        ?>
                        <?php while($row = $results->fetch_assoc()) { ?>
                            <article class="articles"> 
                                <h2><?php echo $row["title"]."<br>"."<br>"; ?></h2>
                                <p><?php echo $row["content"]."<br>"."<br>"; ?></p>
                                <p><?php echo $row["author"]."<br>"."<br>"; ?></p>
                                <p><?php echo $row["created_at"]."<br>"."<br>"; ?></p>
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
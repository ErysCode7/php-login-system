<?php 
    session_start();
    $page_title = "Articles";
    require "includes/header.php";
?>

<?php require "includes/nav.php" ;?>

<?php
if(isset($_POST["submit"])) {
    require "includes/config.php";
    $search = mysqli_real_escape_string($con, $_POST["search"]);
    $sql = "SELECT * FROM article WHERE title LIKE '%$search%' || content LIKE '%$search%' || author LIKE '%$search%' || created_at LIKE '%$search%';";
    $results = $con->query($sql);
    $rowResult = mysqli_num_rows($results);
}

?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                if(isset($_SESSION["status"])) {
            ?>
            <div class="alert alert-warning">
                <h4><?= $_SESSION["status"]; ?></h4>
            </div>
            <?php unset($_SESSION["status"]); } ?>
            <?php echo $rowResult." Results Found!"; ?>
                <?php if($rowResult > 0) { ?>
                    <?php while($row = $results->fetch_assoc()) { ?> 
                        <article class="articles-output">
                            <a href="article.php?title=<?php echo $row["title"]; ?>&created_at=<?php echo $row["created_at"]; ?>" target="10">
                            <h2><?php echo $row["title"]."<br>"."<br>";?></h2>
                            <p><?php echo $row["content"]."<br>"."<br>"; ?></p>
                            <p><?php echo $row["author"]."<br>"."<br>"; ?></p>
                            <p><?php echo $row["created_at"]."<br>"."<br>"; ?></p>
                            </a>
                        </article>
                    <?php } ?>
                <?php } else { echo "No results found!"; }?>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
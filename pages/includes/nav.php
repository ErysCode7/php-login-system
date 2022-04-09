<header>
    <h1><i class="loc fas fa-laptop"></i><span class="brand">Coding Bootcamp</span></h1>
    <nav>
        <ul>
            <li class="b"><i class="fa fa-bars"></i></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <?php if(isset($_SESSION["authenticated"])) { ?>
            <li><a href="#">Profile</a></li>
            <li><form action="includes/logout.php">
                <input type="submit" value="Log out">
                </form>
            </li>
            <?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign up</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
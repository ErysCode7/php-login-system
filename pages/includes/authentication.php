<?php
session_start();
if(!isset($_SESSION["authenticated"])) {
    $_SESSION["status"] = "Please Log in to Access User Dashboard";
    header("Location: ./login.php");
    exit();
}
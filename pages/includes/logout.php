<?php

session_start();
unset($_SESSION["authenticated"]);
unset($_SESSION["auth_user"]);
session_destroy();
header("Location: ../login.php");
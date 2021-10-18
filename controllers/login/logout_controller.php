<?php
session_start();

if (!isset($_SESSION["us_id"])) {
    header("location: ../../index.php");
}

session_unset();
session_destroy();
header("location: ../../index.php");

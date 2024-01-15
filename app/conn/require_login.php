<?php
session_start();

if (!isset($_SESSION['username'])) {

    header("Location: /fujiro/fujiro/app/login.html");
    exit();
}

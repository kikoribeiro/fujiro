<?php
session_start();


$_SESSION = array();


session_destroy();


header("Location: /fujiro/fujiro/app/index.html");
exit();


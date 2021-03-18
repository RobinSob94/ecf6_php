<?php

session_start();
session_destroy();
session_unset();

header('location:http://localhost/php\proc\ecf5\proc\admin/index.php');
?>
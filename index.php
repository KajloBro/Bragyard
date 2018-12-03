<?php

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('Location: views/feed.php');
} else {
    header('Location: views/login.php');
}

?>
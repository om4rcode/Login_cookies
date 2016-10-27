<?php
session_start();
session_destroy();
if (isset($_COOKIE['Remember']) && isset($_COOKIE['UserId'])) {

    setcookie('Remember', "", time() - 1);
    setcookie('UserId', "", time() - 1);
}
header("Location: ../index.php");

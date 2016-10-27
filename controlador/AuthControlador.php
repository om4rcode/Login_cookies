<?php
session_start();

require_once '../User.php';
$obj_user = new User();

$user = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : null;
$pass = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : null;

if (!empty($user) && !empty($pass)) {
    $resultado        = $obj_user->validateLogin($user, $pass);
    $_SESSION['user'] = $resultado->username;
    //generamos un número aleatorio
    mt_srand(time());
    $numero_aleatorio = mt_rand(1000000, 999999999);

    if (isset($_POST['txtRemember']) && $_POST['txtRemember'] == 'checked') {
        setcookie('Remember', $numero_aleatorio, time() + 60 * 10, '/');
        setcookie('UserId', $resultado->id, time() + 60 * 10, '/');
        $obj_user->hasRemember($_COOKIE['Remember'], $resultado->id);
    }

    header("Location: ../vistas/welcome.php");
}

<?php
session_start();
if (isset($_SESSION['user'])) {
    $usuario = $_SESSION['user'];
    echo "<h1>Bienvenido.$usuario</h1>";
    echo "<a href='logout.php'>Cerrar Sesión</a>";
} else {
    header("Location: ../index.php");
}

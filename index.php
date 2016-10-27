<?php
session_start();
require_once './User.php';
$obj_user = new User();

if (!isset($_SESSION['user'])) {
    $logged = false;
    if (isset($_COOKIE['Remember']) && isset($_COOKIE['UserId'])) {
        $cookie_remember  = $_COOKIE['Remember'];
        $cookie_userid    = $_COOKIE['UserId'];
        $_SESSION['user'] = $obj_user->validateCookieUserId($cookie_remember, $cookie_userid)->username;
        $logged           = true;
        header('Location: vistas/Welcome.php');
    }
    if (!$logged) {
        ?>
	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Form con Cookies</title>
	<style>
		@import url("public/css/estilos.css")
	</style>
</head>
<body>
	<table align="center" cellpadding="5" cellspacing="10">
		<form action="controlador/AuthControlador.php" id="frmLogin" method="post">
			<tr>
				<td><label for="Username">Usuario</label></td>
				<td><input type="text" id="Username" name="txtUsername"></td>
			</tr>
			<tr>
				<td><label for="Password">Password</label></td>
				<td><input type="text" id="Password" name="txtPassword"></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="txtRemember" id="txtRemember" value="checked">
					<label for="txtRemember">Recordarme</label>
				</td>
			</tr>
			<tr>
				<td><input type="submit" name="btnEnviar" value="Iniciar Sesión"></td>
			</tr>
		</form>
	</table>
</body>
</html>
    	<?php
}
} else {
    header('Location: vistas/Welcome.php');
}
?>



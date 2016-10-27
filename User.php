<?php

require_once 'util/Conexion.php';

class User
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::singleton()->Connection();
    }

    public function validateLogin($user, $pass)
    {
        $query = "SELECT id, username, password
                  FROM users
                  WHERE username = :user
                  AND password = :pass";
        $gsent = $this->conexion->prepare($query);
        $gsent->bindParam(':user', $user, PDO::PARAM_STR);
        $gsent->bindParam(':pass', $pass, PDO::PARAM_STR);
        $gsent->execute();
        if ($gsent->rowCount() == 1) {
            return $gsent->fetch(PDO::FETCH_OBJ);
        }
    }

    public function hasRemember($cookie, $user_id)
    {
        $query = "INSERT INTO user_cookies(cookie, user_id)
                  VALUES(:cookie, :user_id)";
        $gsent = $this->conexion->prepare($query);
        $gsent->bindParam(':cookie', $cookie);
        $gsent->bindParam(':user_id', $user_id);
        $gsent->execute();
        // if ($gsent->rowCount() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function validateCookieUserId($cookie, $user_id)
    {
        $query = "SELECT u.username, c.cookie, c.user_id
                      FROM user_cookies as c
                      INNER JOIN users as u
                      ON c.user_id = u.id
                      WHERE cookie = $cookie AND c.user_id = $user_id";
        $resultado = $this->conexion->query($query);
        if ($resultado->rowCount() == 1) {
            return $resultado->fetch(PDO::FETCH_OBJ);
        }
    }

}

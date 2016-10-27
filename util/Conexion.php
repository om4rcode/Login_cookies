<?php

class Conexion
{
    private static $instancia;
    private $host = "localhost";
    private $db   = "db_pruebas";
    private $user = "root";
    private $pass = "";
    private $conex;

    private function __construct()
    {
        //Constructor de la clase en privado para no crear instancias de la clase.
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase         = __CLASS__;
            self::$instancia = new $miclase();
        }
        return self::$instancia;
    }

    public function Connection()
    {
        try {
            $this->conex = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . "", $this->user, $this->pass);
            $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conex->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conex->exec("set character set utf8");
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos. " . $e->getMessage();
            die();
        }
        return $this->conex;
    }

    private function __clone()
    {
        trigger_error("No se puede clonar una instancia de " . get_class($this) . " class.", E_USER_ERROR);
    }
}

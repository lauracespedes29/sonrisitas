<?php
class Conexion {
    private $servidor = "localhost";
    private $db = "final2";
    private $puerto = 3306;
    private $charset = "utf8";
    private $usuario = "root";  // Cambia si es necesario
    private $contrasena = "";    // Cambia si es necesario
    public $pdo = null;
    private $atributos = [
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    function __construct() {
        try {
            $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}", $this->usuario, $this->contrasena);
            foreach ($this->atributos as $key => $value) {
                $this->pdo->setAttribute($key, $value);
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
?>

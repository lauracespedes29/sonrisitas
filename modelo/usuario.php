<?php
    include_once 'Conexion.php';
    class Usuario{
        var $objetos;
        public function __construct(){
            $db = new Conexcion();
            $this->acceso = $db->pdo;
        }
        function Loguearse($ci,$pass){
            $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where ci_us=:ci and contrasena=:pass";
            $query = this->acceso->prepare($sql)
            $query->execute(array('ci'=>$ci,'pass'=>$pass));
            this->objetos = $query->fetchall();
            return this->objetos; 
        }
    }
?>
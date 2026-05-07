<?php
class Database {
    // Para Laragon - Configuración estándar
    private $host = "localhost";
    private $db_name = "desarrollo";
    private $username = "root";      // Laragon usa root sin contraseña por defecto
    private $password = "";          // Laragon tiene contraseña vacía por defecto
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            
            // Opcional: Mostrar que la conexión fue exitosa (solo para pruebas)
            // echo "Conectado a la base de datos correctamente";
            
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
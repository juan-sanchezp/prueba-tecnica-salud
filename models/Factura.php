<?php
require_once 'config/database.php';

class Factura {
    private $conn;
    private $table = "factura";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getAll() {
        $query = "SELECT f.*, c.fecha_cita, p.nombre_paciente 
                  FROM " . $this->table . " f
                  INNER JOIN citas_medicas c ON f.id_cita = c.id_cita
                  INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                  ORDER BY f.fecha_factura DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_factura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (id_cita, fecha_factura, subtotal, iva, total, estado) 
                  VALUES (:id_cita, :fecha_factura, :subtotal, :iva, :total, :estado)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cita', $data['id_cita']);
        $stmt->bindParam(':fecha_factura', $data['fecha_factura']);
        $stmt->bindParam(':subtotal', $data['subtotal']);
        $stmt->bindParam(':iva', $data['iva']);
        $stmt->bindParam(':total', $data['total']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
    
    public function update($data) {
        $query = "UPDATE " . $this->table . " 
                  SET id_cita = :id_cita, subtotal = :subtotal, 
                      iva = :iva, total = :total, estado = :estado
                  WHERE id_factura = :id_factura";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_factura', $data['id_factura']);
        $stmt->bindParam(':id_cita', $data['id_cita']);
        $stmt->bindParam(':subtotal', $data['subtotal']);
        $stmt->bindParam(':iva', $data['iva']);
        $stmt->bindParam(':total', $data['total']);
        $stmt->bindParam(':estado', $data['estado']);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_factura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
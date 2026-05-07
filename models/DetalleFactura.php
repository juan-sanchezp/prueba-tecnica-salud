<?php
require_once 'config/database.php';

class DetalleFactura {
    private $conn;
    private $table = "detalle_factura";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getByFacturaId($id_factura) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_factura = :id_factura";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_factura', $id_factura);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (id_factura, concepto, cantidad, valor_unitario, valor_total) 
                  VALUES (:id_factura, :concepto, :cantidad, :valor_unitario, :valor_total)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_factura', $data['id_factura']);
        $stmt->bindParam(':concepto', $data['concepto']);
        $stmt->bindParam(':cantidad', $data['cantidad']);
        $stmt->bindParam(':valor_unitario', $data['valor_unitario']);
        $stmt->bindParam(':valor_total', $data['valor_total']);
        return $stmt->execute();
    }
    
    public function deleteByFacturaId($id_factura) {
        $query = "DELETE FROM " . $this->table . " WHERE id_factura = :id_factura";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_factura', $id_factura);
        return $stmt->execute();
    }
}
?>
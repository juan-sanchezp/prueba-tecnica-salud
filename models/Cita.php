<?php
require_once 'config/database.php';

class Cita {
    private $conn;
    private $table = "citas_medicas";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getCitasPorFecha($fecha) {
        $query = "SELECT p.nombre_paciente, p.apellido_paciente, 
                         m.especialidad_consulta, m.nombre_medico,
                         c.fecha_cita, c.estado_cita, c.valor_cita
                  FROM " . $this->table . " c
                  INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                  INNER JOIN medicos m ON c.id_medico = m.id_medico
                  WHERE c.fecha_cita = :fecha
                  ORDER BY c.hora_cita";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAll() {
        $query = "SELECT c.*, p.nombre_paciente, m.nombre_medico 
                  FROM " . $this->table . " c
                  INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                  INNER JOIN medicos m ON c.id_medico = m.id_medico";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
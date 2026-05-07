<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

if($conn) {
    echo "✅ Conexión exitosa a la base de datos en Laragon!<br>";
    
    // Probar consulta simple
    $query = "SELECT COUNT(*) as total FROM pacientes";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "📊 Total de pacientes registrados: " . $result['total'];
} else {
    echo "❌ Error de conexión";
}
?>
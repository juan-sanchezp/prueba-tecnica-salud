<?php
require_once 'models/Cita.php';

class CitaController {
    private $citaModel;
    
    public function __construct() {
        $this->citaModel = new Cita();
    }
    
    public function index() {
        $fecha = '2012-05-15';
        $citas = $this->citaModel->getCitasPorFecha($fecha);
        
        // CORREGIDO: Usa rutas completas
        require_once __DIR__ . '/../views/layouts/main.php';
        require_once __DIR__ . '/../views/citas/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
?>
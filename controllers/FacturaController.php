<?php
require_once 'models/Factura.php';
require_once 'models/DetalleFactura.php';

class FacturaController {
    private $facturaModel;
    private $detalleFacturaModel;
    
    public function __construct() {
        $this->facturaModel = new Factura();
        $this->detalleFacturaModel = new DetalleFactura();
    }
    
    public function index() {
        $facturas = $this->facturaModel->getAll();
        require_once __DIR__ . '/../views/layouts/main.php';
        require_once __DIR__ . '/../views/facturas/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_cita' => $_POST['id_cita'],
                'fecha_factura' => date('Y-m-d H:i:s'),
                'subtotal' => $_POST['subtotal'],
                'iva' => $_POST['iva'],
                'total' => $_POST['total'],
                'estado' => 'Pendiente'
            ];
            
            $id_factura = $this->facturaModel->create($data);
            
            // Guardar detalles
            if(isset($_POST['concepto'])) {
                for($i = 0; $i < count($_POST['concepto']); $i++) {
                    if(!empty($_POST['concepto'][$i])) {
                        $detalle = [
                            'id_factura' => $id_factura,
                            'concepto' => $_POST['concepto'][$i],
                            'cantidad' => $_POST['cantidad'][$i],
                            'valor_unitario' => $_POST['valor_unitario'][$i],
                            'valor_total' => $_POST['cantidad'][$i] * $_POST['valor_unitario'][$i]
                        ];
                        $this->detalleFacturaModel->create($detalle);
                    }
                }
            }
            
            header('Location: index.php?controller=factura&action=index');
            exit();
        } else {
            require_once __DIR__ . '/../views/layouts/main.php';
            require_once __DIR__ . '/../views/facturas/create.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        }
    }
    
    public function edit() {
        $id = $_GET['id'];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_factura' => $id,
                'id_cita' => $_POST['id_cita'],
                'subtotal' => $_POST['subtotal'],
                'iva' => $_POST['iva'],
                'total' => $_POST['total'],
                'estado' => $_POST['estado']
            ];
            $this->facturaModel->update($data);
            header('Location: index.php?controller=factura&action=index');
            exit();
        } else {
            $factura = $this->facturaModel->getById($id);
            $detalles = $this->detalleFacturaModel->getByFacturaId($id);
            require_once __DIR__ . '/../views/layouts/main.php';
            require_once __DIR__ . '/../views/facturas/edit.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        }
    }
    
    public function delete() {
        $id = $_GET['id'];
        $this->detalleFacturaModel->deleteByFacturaId($id);
        $this->facturaModel->delete($id);
        header('Location: index.php?controller=factura&action=index');
        exit();
    }
    
    public function detalles() {
        $id = $_GET['id'];
        $factura = $this->facturaModel->getById($id);
        $detalles = $this->detalleFacturaModel->getByFacturaId($id);
        require_once __DIR__ . '/../views/layouts/main.php';
        require_once __DIR__ . '/../views/facturas/detalles.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
?>
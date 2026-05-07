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
        require_once 'views/layouts/main.php';
        require_once 'views/facturas/index.php';
        require_once 'views/layouts/footer.php';
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
            require_once 'views/layouts/main.php';
            require_once 'views/facturas/create.php';
            require_once 'views/layouts/footer.php';
        }
    }
    
    public function edit() {
        // Obtener el ID de la factura a editar
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if(!$id) {
            header('Location: index.php?controller=factura&action=index');
            exit();
        }
        
        // Si es POST, actualizar
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verificar que id_cita existe en el POST
            if(!isset($_POST['id_cita']) || empty($_POST['id_cita'])) {
                die("Error: El campo id_cita es obligatorio. Por favor, asegúrese de que el formulario incluya este campo.");
            }
            
            $data = [
                'id_factura' => $id,  // Usar el ID de la URL
                'id_cita' => $_POST['id_cita'],
                'subtotal' => $_POST['subtotal'],
                'iva' => $_POST['iva'],
                'total' => $_POST['total'],
                'estado' => $_POST['estado']
            ];
            
            // Depuración: Ver qué datos se están enviando
            // echo "<pre>"; print_r($data); echo "</pre>"; exit();
            
            if($this->facturaModel->update($data)) {
                header('Location: index.php?controller=factura&action=index&mensaje=actualizado');
                exit();
            } else {
                echo "Error al actualizar la factura";
            }
        } else {
            // Si es GET, mostrar el formulario
            $factura = $this->facturaModel->getById($id);
            if(!$factura) {
                header('Location: index.php?controller=factura&action=index');
                exit();
            }
            $detalles = $this->detalleFacturaModel->getByFacturaId($id);
            require_once 'views/layouts/main.php';
            require_once 'views/facturas/edit.php';
            require_once 'views/layouts/footer.php';
        }
    }
    
    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($id) {
            $this->detalleFacturaModel->deleteByFacturaId($id);
            $this->facturaModel->delete($id);
        }
        header('Location: index.php?controller=factura&action=index');
        exit();
    }
    
    public function detalles() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($id) {
            $factura = $this->facturaModel->getById($id);
            $detalles = $this->detalleFacturaModel->getByFacturaId($id);
            require_once 'views/layouts/main.php';
            require_once 'views/facturas/detalles.php';
            require_once 'views/layouts/footer.php';
        } else {
            header('Location: index.php?controller=factura&action=index');
        }
    }
}
?>
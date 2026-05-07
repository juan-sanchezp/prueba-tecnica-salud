<div class="card">
    <div class="card-header bg-primary text-white">
        <h4><i class="fas fa-plus"></i> Nueva Factura</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="" id="facturaForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_cita" class="form-label">Cita Médica *</label>
                    <select class="form-control" id="id_cita" name="id_cita" required>
                        <option value="">Seleccione una cita</option>
                        <?php
                        require_once 'models/Cita.php';
                        $citaModel = new Cita();
                        $citas = $citaModel->getAll();
                        foreach($citas as $cita): 
                        ?>
                        <option value="<?php echo $cita['id_cita']; ?>">
                            <?php echo $cita['nombre_paciente'] . ' - ' . $cita['fecha_cita']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <h5>Detalles de la Factura</h5>
            <div id="detallesContainer">
                <div class="row mb-2 detalle-item">
                    <div class="col-md-5">
                        <input type="text" name="concepto[]" class="form-control" placeholder="Concepto" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="cantidad[]" class="form-control cantidad" placeholder="Cantidad" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" step="0.01" name="valor_unitario[]" class="form-control valor-unitario" placeholder="Valor Unitario" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm eliminar-detalle">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-secondary btn-sm mb-3" id="agregarDetalle">
                <i class="fas fa-plus"></i> Agregar Detalle
            </button>
            
            <div class="row mt-3">
                <div class="col-md-4 offset-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Subtotal:</label>
                                <input type="text" id="subtotal" name="subtotal" class="form-control" readonly>
                            </div>
                            <div class="mb-2">
                                <label>IVA (19%):</label>
                                <input type="text" id="iva" name="iva" class="form-control" readonly>
                            </div>
                            <div class="mb-2">
                                <label>Total:</label>
                                <input type="text" id="total" name="total" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Guardar Factura</button>
                <a href="index.php?controller=factura&action=index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/main.js"></script>
<?php require_once 'views/layouts/footer.php'; ?>
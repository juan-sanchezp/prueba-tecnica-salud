<div class="card">
    <div class="card-header bg-warning">
        <h4><i class="fas fa-edit"></i> Editar Factura #<?php echo $factura['id_factura']; ?></h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">ID Cita</label>
                    <input type="text" class="form-control" value="<?php echo $factura['id_cita']; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha Factura</label>
                    <input type="text" class="form-control" value="<?php echo $factura['fecha_factura']; ?>" readonly>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Subtotal</label>
                    <input type="text" name="subtotal" class="form-control" value="<?php echo $factura['subtotal']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">IVA</label>
                    <input type="text" name="iva" class="form-control" value="<?php echo $factura['iva']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total</label>
                    <input type="text" name="total" class="form-control" value="<?php echo $factura['total']; ?>" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Pendiente" <?php echo $factura['estado'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="Pagado" <?php echo $factura['estado'] == 'Pagado' ? 'selected' : ''; ?>>Pagado</option>
                    <option value="Anulado" <?php echo $factura['estado'] == 'Anulado' ? 'selected' : ''; ?>>Anulado</option>
                </select>
            </div>
            
            <h5>Detalles de la Factura</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Concepto</th><th>Cantidad</th><th>Valor Unitario</th><th>Valor Total</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($detalles as $detalle): ?>
                        <tr>
                            <td><?php echo $detalle['concepto']; ?></td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td>$<?php echo number_format($detalle['valor_unitario'], 2); ?></td>
                            <td>$<?php echo number_format($detalle['valor_total'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar Factura</button>
            <a href="index.php?controller=factura&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<?php require_once 'views/layouts/footer.php'; ?>
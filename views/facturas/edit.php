<div class="card">
    <div class="card-header bg-warning">
        <h4><i class="fas fa-edit"></i> Editar Factura #<?php echo $factura['id_factura']; ?></h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_cita" class="form-label">ID de la Cita *</label>
                    <input type="number" 
                           name="id_cita" 
                           id="id_cita" 
                           class="form-control" 
                           value="<?php echo $factura['id_cita']; ?>" 
                           required>
                    <small class="text-muted">Ingrese el ID de la cita médica asociada</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha de Factura</label>
                    <input type="text" 
                           class="form-control" 
                           value="<?php echo date('d/m/Y H:i:s', strtotime($factura['fecha_factura'])); ?>" 
                           disabled>
                    <small class="text-muted">Fecha de creación (no modificable)</small>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Subtotal</label>
                    <input type="number" 
                           step="0.01" 
                           name="subtotal" 
                           class="form-control" 
                           value="<?php echo $factura['subtotal']; ?>" 
                           required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">IVA</label>
                    <input type="number" 
                           step="0.01" 
                           name="iva" 
                           class="form-control" 
                           value="<?php echo $factura['iva']; ?>" 
                           required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total</label>
                    <input type="number" 
                           step="0.01" 
                           name="total" 
                           class="form-control" 
                           value="<?php echo $factura['total']; ?>" 
                           required>
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
            
            <hr>
            <h5>Detalles de la Factura</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Concepto</th>
                            <th>Cantidad</th>
                            <th>Valor Unitario</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($detalles) && is_array($detalles) && count($detalles) > 0): ?>
                            <?php foreach($detalles as $detalle): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($detalle['concepto']); ?></td>
                                <td><?php echo $detalle['cantidad']; ?></td>
                                <td>$<?php echo number_format($detalle['valor_unitario'], 2); ?></td>
                                <td>$<?php echo number_format($detalle['valor_total'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No hay detalles registrados para esta factura
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Factura
                </button>
                <a href="index.php?controller=factura&action=index" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
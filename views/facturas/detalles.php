<div class="card">
    <div class="card-header bg-info text-white">
        <h4><i class="fas fa-file-invoice"></i> Detalles de Factura #<?php echo $factura['id_factura']; ?></h4>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Información General</h5>
                <table class="table table-bordered">
                    <tr><th>ID Factura:</th><td><?php echo $factura['id_factura']; ?></td></tr>
                    <tr><th>ID Cita:</th><td><?php echo $factura['id_cita']; ?></td></tr>
                    <tr><th>Fecha Factura:</th><td><?php echo $factura['fecha_factura']; ?></td></tr>
                    <tr><th>Estado:</th><td><?php echo $factura['estado']; ?></td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Valores</h5>
                <table class="table table-bordered">
                    <tr><th>Subtotal:</th><td>$<?php echo number_format($factura['subtotal'], 2); ?></td></tr>
                    <tr><th>IVA:</th><td>$<?php echo number_format($factura['iva'], 2); ?></td></tr>
                    <tr><th class="bg-light">TOTAL:</th><td><strong>$<?php echo number_format($factura['total'], 2); ?></strong></td></tr>
                </table>
            </div>
        </div>
        
        <h5>Detalles de Servicios</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
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
                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="3" class="text-end">TOTAL:</th>
                        <th>$<?php echo number_format($factura['total'], 2); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-3">
            <a href="index.php?controller=factura&action=index" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button onclick="window.print();" class="btn btn-success">
                <i class="fas fa-print"></i> Imprimir
            </button>
        </div>
    </div>
</div>
<?php require_once 'views/layouts/footer.php'; ?>
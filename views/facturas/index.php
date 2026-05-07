<div class="card">
    <div class="card-header bg-success text-white">
        <h4><i class="fas fa-file-invoice"></i> Listado de Facturas</h4>
    </div>
    <div class="card-body">
        <a href="index.php?controller=factura&action=create" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Nueva Factura
        </a>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Factura</th>
                        <th>Paciente</th>
                        <th>Fecha Cita</th>
                        <th>Fecha Factura</th>
                        <th>Subtotal</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($facturas as $factura): ?>
                    <tr>
                        <td><?php echo $factura['id_factura']; ?></td>
                        <td><?php echo $factura['nombre_paciente']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($factura['fecha_cita'])); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($factura['fecha_factura'])); ?></td>
                        <td>$<?php echo number_format($factura['subtotal'], 2); ?></td>
                        <td>$<?php echo number_format($factura['iva'], 2); ?></td>
                        <td><strong>$<?php echo number_format($factura['total'], 2); ?></strong></td>
                        <td>
                            <?php 
                            $badge = $factura['estado'] == 'Pagado' ? 'bg-success' : 'bg-warning';
                            ?>
                            <span class="badge <?php echo $badge; ?>"><?php echo $factura['estado']; ?></span>
                        </td>
                        <td>
                            <a href="index.php?controller=factura&action=detalles&id=<?php echo $factura['id_factura']; ?>" 
                               class="btn btn-sm btn-info" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?controller=factura&action=edit&id=<?php echo $factura['id_factura']; ?>" 
                               class="btn btn-sm btn-warning" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=factura&action=delete&id=<?php echo $factura['id_factura']; ?>" 
                               class="btn btn-sm btn-danger" title="Eliminar"
                               onclick="return confirm('¿Está seguro de eliminar esta factura?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once 'views/layouts/footer.php'; ?>
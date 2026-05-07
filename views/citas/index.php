<div class="card">
    <div class="card-header bg-info text-white">
        <h4><i class="fas fa-calendar-check"></i> Citas Programadas - 15 de Mayo de 2012</h4>
    </div>
    <div class="card-body">
        <?php if(count($citas) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Paciente</th>
                            <th>Especialidad</th>
                            <th>Médico</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($citas as $cita): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cita['nombre_paciente'] . ' ' . $cita['apellido_paciente']); ?></td>
                            <td><?php echo htmlspecialchars($cita['especialidad_consulta']); ?></td>
                            <td><?php echo htmlspecialchars($cita['nombre_medico']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($cita['fecha_cita'])); ?></td>
                            <td>
                                <?php 
                                $badge = '';
                                switch($cita['estado_cita']) {
                                    case 'Programada':
                                        $badge = 'bg-primary';
                                        break;
                                    case 'Atendida':
                                        $badge = 'bg-success';
                                        break;
                                    case 'Cancelada':
                                        $badge = 'bg-danger';
                                        break;
                                    default:
                                        $badge = 'bg-secondary';
                                }
                                ?>
                                <span class="badge <?php echo $badge; ?>"><?php echo $cita['estado_cita']; ?></span>
                            </td>
                            <td>$<?php echo number_format($cita['valor_cita'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> No hay citas programadas para esta fecha.
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- ELIMINA ESTA LÍNEA: <?php require_once 'views/layouts/footer.php'; ?> -->
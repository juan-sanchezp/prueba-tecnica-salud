// Agregar detalles dinámicos
document.addEventListener('DOMContentLoaded', function() {
    const agregarBtn = document.getElementById('agregarDetalle');
    if(agregarBtn) {
        agregarBtn.addEventListener('click', function() {
            const container = document.getElementById('detallesContainer');
            const newDetalle = document.createElement('div');
            newDetalle.className = 'row mb-2 detalle-item';
            newDetalle.innerHTML = `
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
            `;
            container.appendChild(newDetalle);
            agregarEventosCalculo();
        });
    }
    
    function agregarEventosCalculo() {
        document.querySelectorAll('.cantidad, .valor-unitario').forEach(el => {
            el.removeEventListener('input', calcularTotales);
            el.addEventListener('input', calcularTotales);
        });
        
        document.querySelectorAll('.eliminar-detalle').forEach(btn => {
            btn.removeEventListener('click', function(e) {
                e.target.closest('.detalle-item').remove();
                calcularTotales();
            });
            btn.addEventListener('click', function(e) {
                e.target.closest('.detalle-item').remove();
                calcularTotales();
            });
        });
    }
    
    function calcularTotales() {
        let subtotal = 0;
        document.querySelectorAll('.detalle-item').forEach(item => {
            const cantidad = parseFloat(item.querySelector('.cantidad')?.value) || 0;
            const valorUnitario = parseFloat(item.querySelector('.valor-unitario')?.value) || 0;
            subtotal += cantidad * valorUnitario;
        });
        
        const iva = subtotal * 0.19;
        const total = subtotal + iva;
        
        const subtotalInput = document.getElementById('subtotal');
        const ivaInput = document.getElementById('iva');
        const totalInput = document.getElementById('total');
        
        if(subtotalInput) subtotalInput.value = subtotal.toFixed(2);
        if(ivaInput) ivaInput.value = iva.toFixed(2);
        if(totalInput) totalInput.value = total.toFixed(2);
    }
    
    agregarEventosCalculo();
});
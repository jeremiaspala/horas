<div class="row">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Programar Cobro</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="<?= base_url ?>cobranzas/salvar" method="post" name="nuevocobro">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="empresa_id">Empresa</label>
                            <select class="form-control" id="empresa_id" name="empresa_id" onchange="obtenerEn('persona_id', '<?= base_url ?>cobranzas/empleados' + document.getElementById('empresa_id').value);">
                                <?= $comboE ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="persona_id">Persona</label>
                            <select class="form-control" id="persona_id" name="persona_id">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email" required="true">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="monto">Monto</label>
                            <input type="text" class="form-control" id="monto" name="monto" placeholder="$">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="tipo_pago">Tipo de Pago</label>
                            <select class="form-control" id="persona_id" name="persona_id">
                                <option value="mensual">Mensual</option>
                                <option value="mensual">Anual</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dia_pago">Día</label>
                            <input type="number" class="form-control" id="dia_pago" name="dia_pago" value="1" min="1" max="30">
                        </div>  
                        <div class="form-group col-md-6">
                            <label for="mes_pago">Mes</label>
                            <input type="number" class="form-control" id="mes_pago" name="mes_pago" value="1" min="1" max="12">
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="fecha_fin">Mes</label>
                            <input type="date" class="form-control" id="fecha_fin">
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="habilitado">Habilitados</label>
                            <input type="checkbox" class="form-control" id="habilitado" name="habilitado" checked  >

                        </div>
                        <div class="form-row mb-4">
                            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function obtenerEn(div, pagina) {
        $.ajax({
            type: "GET",
            url: pagina,
            success: function (datos) {
                $('#' + div).html(datos);
            }
        });
        return false;
    }
    obtenerEn('persona_id', '<?= base_url ?>cobranzas/empleados&id=' + document.getElementById('empresa_id').value);
</script>
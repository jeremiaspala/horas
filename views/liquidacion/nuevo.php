<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Liquidar horas</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div id="example-basic">
                <h3>Equipo de trabajo</h3>
                <section>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="trabajo">Equipo de Trabajo</label>
                            <select class="form-control" id="trabajo" name="trabajo" onchange="obtenerEn('persona', '<?= base_url ?>liquidacion/cboempleados&id=' + $('#trabajo').val());$('#trabajo_id').val($('#trabajo').val());">
                                <option value="0">Seleccione un Equipo de trabajo</option>
                                <?php
                                foreach ($categoria as $c):
                                    ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['trabajo'] ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                </section>
                <h3>Empleado</h3>
                <section>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="persona">Equipo de Trabajo</label>
                            <select class="form-control" id="persona" name="persona" onchange="obtenerEn('horas-trabajadas', '<?= base_url ?>liquidacion/tblhoras&id=' + $('#persona').val());$('#persona_id').val($('#persona').val());">

                            </select>
                        </div>
                    </div>

                </section>
                <h3>Horas a Liquidar</h3>
                <section> 
                    <form action="<?=base_url?>liquidacion/liquidar" method="post" name="liquidacion">
                        <input type="hidden" name="persona_id" id="persona_id">
                        <input type="hidden" name="trabajo_id" id="trabajo_id">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-4">
                                        <thead>
                                            <tr>
                                                <th>Horas</th>
                                                <th>Fecha</th>
                                                <th>Descripción</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="horas-trabajadas">

                                        </tbody>
                                    </table>
                                    <div class="form-group col-md-6">
                                    <input type="submit" value="Liquidar Horas" class="form-control btn-info">
                                    </div>
                                </div>
                            </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
</div>
<script>
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

</script>
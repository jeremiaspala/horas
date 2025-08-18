<div class="row">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Persona</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="<?= base_url ?>personas/salvar" method="post" name="nuevapersona">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="true">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required="true">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="celular">Celular</label>
                            <input type="tel" class="form-control" id="celular" name="celular" placeholder="54-341-xxxxxx">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="a@a.com" required="true">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_nac">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" placeholder="30-12-2022">
                        </div
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

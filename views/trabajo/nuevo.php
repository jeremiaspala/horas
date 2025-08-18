                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Colores</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>trabajo/salvar" method="post" name="nuevotrabajo">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="trabajo">Equipo de Trabajo</label>
                                                <input type="text" class="form-control" id="trabajo" name="trabajo" placeholder="Nombre de Equipo" required="true">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="valor">Valor</label>
                                                <input type="number" step="0.1" class="form-control" id="valor" name="valor" placeholder="Valor hora" required="true">
                                            </div>
                                        </div>
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

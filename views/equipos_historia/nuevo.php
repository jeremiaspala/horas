                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Sectores</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>sectores/salvar" method="post" name="nuevasector">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="sector">Color</label>
                                                <input type="text" class="form-control" id="sector" name="sector" placeholder="Sector" required="true">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="descripcion">Descripcion</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required="true">
                                            </div>
                                        </div>
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

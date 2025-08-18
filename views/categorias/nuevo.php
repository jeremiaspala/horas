                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Categoría</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>categorias/salvar" method="post" name="nuevacategoria">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="true">
                                            </div>
                                        </div>
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

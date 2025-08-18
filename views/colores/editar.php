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
                                    <form action="<?=base_url?>colores/actualizar" method="post" name="nuevacategoria">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="color">Color</label>
                                                <input type="text" class="form-control" id="color" name="color" placeholder="Nombre" required="true" value="<?=$color?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="precio">Precio</label>
                                                <input type="number" step="0.1" class="form-control" id="precio" name="precio" placeholder="Precio" required="true" value="<?=$precio?>">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$id?>">
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
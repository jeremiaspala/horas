                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Empresa</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>empresas/actualizar" method="post" name="nuevaempresa">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Razón Social</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="true" value="<?=$nombre?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cuit">CUIT</label>
                                                <input type="text" class="form-control" id="cuit" name="cuit" placeholder="CUIT" required="true" value="<?=$cuit?>">
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección, Ciudad, Provincia, pais" value="<?=$direccion?>">
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="condicionfiscal">Condición Fiscal</label>
                                                <select class="form-control" id="condicion" name="condicionfiscal">
                                                    <option value="RI" <?=$ri?>>Responsable Inscripto</option>
                                                    <option value="RNI" <?=$rni?>>Responsable No Inscripto</option>
                                                    <option value="E" <?=$e?>>Excento</option>
                                                    <option value="CF" <?=$cf?>>Consumidor Final</option>
                                                </select>
                                                <input type="hidden" name="id" value="<?=$id?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="(0341 - 4444444" required="true" value="<?=$telefono?>">
                                            </div>
                                        </div>
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

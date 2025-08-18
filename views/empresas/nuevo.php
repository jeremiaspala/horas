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
                                    <form action="<?=base_url?>empresas/salvar" method="post" name="nuevaempresa">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Razón Social</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="true">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cuit">CUIT</label>
                                                <input type="text" class="form-control" id="cuit" name="cuit" placeholder="CUIT" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección, Ciudad, Provincia, pais">
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="condicionfiscal">Condición Fiscal</label>
                                                <select class="form-control" id="condicion" name="condicionfiscal">
                                                    <option value="RI">Responsable Inscripto</option>
                                                    <option value="RNI">Responsable No Inscripto</option>
                                                    <option value="E">Excento</option>
                                                    <option value="CF">Consumidor Final</option>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="(0341 - 4444444" required="true">
                                            </div
                                        </div>
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

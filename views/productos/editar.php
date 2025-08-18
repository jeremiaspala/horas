                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Producto</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>productos/actualizar" method="post" name="nuevaproducto" enctype="multipart/form-data">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="numero">Número</label>
                                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" required="true" value="<?=$numero?>">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="descripcion">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del producto" required="true" value="<?=$descripcion?>">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                               <label for="kgmt">KG/MT</label>
                                               <input type="text" class="form-control" id="kgmt" name="kgmt" placeholder="KG/MT" value="<?=$kgmt?>">
                                           </div>
                                           <div class="form-group col-md-4">
                                                   <label for="largo">Largo</label>
                                                   <input type="text" class="form-control" id="largo" name="largo" placeholder="Largo" required="true" value="<?=$largo?>">
                                           </div>   
                                           <div class="form-group col-md-4">
                                                   <label for="oferta">Oferta</label>
                                                   <input type="text" class="form-control" id="oferta" name="oferta" placeholder="Oferta" value="<?=$oferta?>">
                                           </div>  
                                        </div>

                                        
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="categoria">Categoría</label>
                                                <select class="form-control" id="categoria" name="categoria">
                                                    <?=$options?>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="precio">Precio</label>
                                                <input type="number" step="0.1" class="form-control" id="precio" name="precio" placeholder="80.0" required="true"  value="<?=$precio?>">
                                            </div>
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Imagen <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Limpiar Imagen">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="imagen">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"><img src="<?=base_url.'uploads/images/'.$imagen?>"></div>
                                            </div>
                                            <input type="hidden" id="id" name="id" value="<?=$id?>">
                                        </div>
                                      <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

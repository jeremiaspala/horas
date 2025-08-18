                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Usuario</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>usuarios/actualizar" method="post" name=actualiza_usuario">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="true" value="<?=$nombre?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="apellidos">Apellidos</label>
                                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellido" required="true" value="<?=$apellidos?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="tuemail@email.com" required="true" value="<?=$email?>">
                                            </div>                                            
                                            <div class="form-group col-md-2">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="tupass" required="true" value="<?=$password?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="celular">Celular</label>
                                                <input type="tel" class="form-control" id="celular" name="celular" placeholder="3416555555" required="true" value="<?=$celular?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="rol">Rol</label>
                                                <select class="form-control" id="rol" name="rol">
                                                    <option value="user" <?php if($rol == "user"){echo 'selected="true"'; } ?>>Usuario</option>
                                                    <option value="admin" <?php if($rol == "admin"){echo 'selected="true"'; } ?>>Admin</option>
                                                </select>
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
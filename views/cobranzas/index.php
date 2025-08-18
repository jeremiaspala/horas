    <div class="row layout-top-spacing" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                                <div style="display: box; text-align: right; padding: 5px 5px 5px 5px;">
                                    <button class="btn btn-success mb-2 mr-2 btn-rounded" onclick="window.location.href='<?=base_url?>cobranzas/nuevo'">Nuevo Cobro Programado<svg> <b>+</b> </svg></button>
                                </div>      
                            <div class="table-responsive mb-4 mt-4">
                                <!-- Registro exitoso !-->
                                <?php if(isset($_SESSION['registro']) && $_SESSION['registro']=="ok"){?>
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Success!</strong> Registro Cargado Correctamente.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("registro");
                                }elseif(isset($_SESSION['registro']) && $_SESSION['registro']=="no"){?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Error!</strong> No se ha podido salvar!. Hay errores!.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("registro");
                                } ?>
                                <!-- Registro exitoso !-->
                                <!-- Borrado Exitoso !-->
                                <?php if(isset($_SESSION['delete']) && $_SESSION['delete']=="ok"){?>
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Success!</strong> Registro Eliminado Correctamente.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("delete");
                                }elseif(isset($_SESSION['delete']) && $_SESSION['delete']=="no"){?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Error!</strong> No se ha podido Eliminar!. Hay errores!.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("delete");
                                } ?>
                                <!-- Borrado exitoso !-->
                                <table id="default-ordering" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>E-mail</th>
                                            <th>Monto</th>
                                            <th>Ultimo Envío</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($empresa as $r):
                                        ?>
                                        <tr id="e<?=$r['id']?>">
                                            <td><?=$r['nombre']?></td>
                                            <td><?=$r['direccion']?></td>
                                            <td><?=$r['cuit']?></td>
                                            <td><?=$r['telefono']?></td>
                                            <td><?=$r['condicionfiscal']?></td>
                                            <td class="text-center">
                                                <a href="<?=base_url?>cobranzas/editar&id=<?=$r['id']?>">Editar</a> | <a onclick="eliminarCobranza(<?=$r['id']?>);">Eliminar</a>
                                            </td>
                                        </tr>
                                        <?php                               
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>E-mail</th>
                                            <th>Monto</th>
                                            <th>Ultimo Envío</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
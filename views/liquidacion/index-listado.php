    <div class="row layout-top-spacing" id="cancel-row">
      
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h4 style="font-weight: boulder;">Liquidaciones</h4>  
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
                                            <th>ID</th>
                                            <th>Equipo</th>
                                            <th>Valor Hora</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($categoria as $r):
                                        ?>
                                        <tr id="cat<?=$r['id']?>">
                                            <td><?=$r['id']?></td>
                                            <td><?=$r['trabajo']?></td>
                                            <td><?=$r['valor']?></td>
                                            <td class="text-center"><a href="<?=base_url?>liquidacion/pre&id=<?=$r['id']?>">Liquidar</a> </td>
                                        </tr>
                                        <?php                               
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Equipo</th>
                                            <th>Valor Hora</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
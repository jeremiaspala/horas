


    <div class="row layout-top-spacing" id="cancel-row">
      
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h3>Auditoría Usuarios</h3>
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
                                            <th>Usuario</th>
                                            <th>Acción</th>
                                            <th>Extra</th>
                                            <th>IP</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($historia as $r):
                                        ?>
                                        <tr id="e<?=$r['id']?>">
                                            <td><?=$r['id']?></td>
                                            <td style="font-weight: bolder;color:black;"><?=$r['email']?></td>
                                            <td><?=$r['accion']?></td>
                                            <td style="font-weight: bolder;color:black;"><?=$r['extra']?></td>
                                            <td><?=$r['ip']?></td>
                                            <td><?=$r['fecha']?></td>
                                        </tr>
                                        <?php                               
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Acción</th>
                                            <th>Extra</th>
                                            <th>IP</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>

<script type="text/javascript">
function eliminarEquipo(id){
var a = confirm("Está seguro de eliminar el Equipo?");
if(a===true){
$.ajax({
    type: "post",
    url: "<?=base_url?>equipos/eliminar&id="+id,
    success: function(data){
            if(data=="ok"){
                alert("Eliminado!");
                $('#e'+id).remove();
            }else{
                alert("No se ha podido eliminar");
            }
        }
    });
    }else{
        alert("No se ha eliminado!");
    }
}

</script>
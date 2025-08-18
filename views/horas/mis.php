<br/>
<div class="infobox-1">
    <h5 class="info-heading">Horas a Liquidar</h5>
    <?php 
        foreach ($sumar as $su):
            $todo = $su['suma'];
        endforeach;
    ?>
    <p class="info-text">Cantidad de horas a liquidar: <b style="font-size: 25px; font-weight: bolder"><?=$todo?></b>.</p>
</div>
<br/>

<div class="widget-content widget-content-area">
    <form action="<?= base_url ?>horas/salvar" method="post" name="horastrabajadas">
        <div class="form-row mb-4">
            <div class="form-group col-md-4">
                <label for="hora">Cantidad de horas</label>
                <input type="number" step="0.5" class="form-control" id="hora" name="hora" placeholder="1,5" required="true" value="1">
            </div>
            <div class="form-group col-md-4">
                <label for="descripcion">Descripción del trabajo</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Proyecto o trabajo" required="true">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>




<div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            <div class="table-responsive mb-4 mt-4">
                <!-- Registro exitoso !-->
                <?php if (isset($_SESSION['registro']) && $_SESSION['registro'] == "ok") { ?>
                    <div class="alert alert-success mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <strong>Success!</strong> Registro Cargado Correctamente.</button>
                    </div> 
                    <?php
                    Utils::deleteSession("registro");
                } elseif (isset($_SESSION['registro']) && $_SESSION['registro'] == "no") {
                    ?>
                    <div class="alert alert-danger mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <strong>Error!</strong> No se ha podido salvar!. Hay errores!.</button>
                    </div> 
                    <?php
                    Utils::deleteSession("registro");
                }
                ?>
                <!-- Registro exitoso !-->
                <!-- Borrado Exitoso !-->
                <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == "ok") { ?>
                    <div class="alert alert-success mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <strong>Success!</strong> Registro Eliminado Correctamente.</button>
                    </div> 
                    <?php
                    Utils::deleteSession("delete");
                } elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == "no") {
                    ?>
                    <div class="alert alert-danger mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <strong>Error!</strong> No se ha podido Eliminar!. Hay errores!.</button>
                    </div> 
                    <?php
                    Utils::deleteSession("delete");
                }
                ?>
                <!-- Borrado exitoso !-->
                <table id="default-ordering" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora Trabajada</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categoria as $r):
                            ?>
                            <tr id="cat<?= $r['id'] ?>">
                                <td><?= $r['created_at'] ?></td>
                                <td><?= $r['horas'] ?></td>
                                <td><?= $r['descripcion'] ?></td>
                                <td><a onclick="eliminar(<?=$r['id']?>);" class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>Horas</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function eliminar(id){
    var a = confirm("Esta seguro que desea eliminar?");
    if(a === true){
        $.ajax({
		type: "post",
		url: "<?=base_url?>horas/eliminar&id="+id,
		success: function(data){
		if(data==="ok"){
                    alert("Eliminado Correctamente!");
                    $('#cat'+id).remove();
		}
	}
	});
    }else{
        alert("No se ha eliminado");
    }
}
</script>
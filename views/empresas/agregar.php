<br/>
<div class="widget-content widget-content-area">

    <div class="row">
        <div class="col-lg-6 col-12 mx-auto">
                <div class="form-group">
                    <select id="id_host" name="id_host" class="form-control" required>
                        <?php foreach ($switch as $r):?>
                        <option value="<?=$r['id']?>"><?=$r['nombre']?></option>
                        <?php endforeach;?>
                    </select>
                    <button onclick="agregar(document.getElementById('id_host').value);" name="Agregar" class="mt-4 btn btn-primary">Agregar</button>
                </div>
            
        </div>                                        
    </div>

</div>
<br/>
<div class="widget-content widget-content-area">
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody id="empleados">
                <?php foreach($mi as $r): ?>
                <tr id="cat<?=$r['id']?>">
                    <td><?=$r['nombre']." ".$r['apellidos']?></td>
                    <td><?=$r['email']?></td>
                    <td class="text-center"><a onclick="eliminar(<?=$r['id']?>);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>



</div>
<script type="text/javascript">
function agregar(id_persona){
        $.ajax({
		type: "post",
		url: "<?=base_url?>empresas/sumar&empresa_id=<?=intval($_REQUEST['id'])?>&persona_id="+id_persona,
		success: function(data){
		if(data==="no"){
                    alert("No se ha podido cargar el host!");
		}else{
                    obtenerEn('empleados', '<?=base_url?>empresas/devolver&id=<?=intval($_REQUEST['id'])?>')
                }
	}
	});
}

function obtenerEn(div, pagina){
			$.ajax({
				type: "GET",
				url: pagina,
				success: function(datos){
					$('#'+div).html(datos);
				}
			});
	return false;
}
function eliminar(id){
    var a = confirm("Esta seguro que desea eliminar?");
    if(a === true){
        $.ajax({
		type: "post",
		url: "<?=base_url?>empresas/restar&id="+id,
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
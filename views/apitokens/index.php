


    <div class="row layout-top-spacing" id="cancel-row">
      
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                                <div style="display: box; text-align: right; padding: 5px 5px 5px 5px;">
                                    <button class="btn btn-success mb-2 mr-2 btn-rounded" onclick="window.location.href='<?=base_url?>apitokens/editar'">Nuevo <svg> <b>+</b> </svg></button>
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
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Token</th>
                                        <th>Habilitado</th>
                                        <th>Creado</th>
                                        <th class="text-end" style="width:180px;">Acciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($tokens as $t): ?>
                                      <tr data-id="<?= (int)$t->id ?>">
                                        <td><?= (int)$t->id ?></td>
                                        <td><?= htmlspecialchars($t->name) ?></td>
                                        <td><code class="small d-block text-wrap"><?= htmlspecialchars($t->token) ?></code></td>
                                        <td class="text-center">
                                          <button class="btn btn-sm btn-toggle-status <?= $t->enabled ? 'btn-success' : 'btn-default' ?>" title="Habilitar/Deshabilitar">
                                            <i class="fa <?= $t->enabled ? 'fa-toggle-on' : 'fa-toggle-off' ?>"><?= $t->enabled ? 'Habilitado' : 'Deshabilitado' ?></i>
                                          </button>
                                        </td>
                                        <td><?= htmlspecialchars($t->created_at) ?></td>
                                        <td class="text-end">
                                          <a class="btn btn-xs btn-primary" href="<?=base_url?>apitokens/editar&id=<?= (int)$t->id ?>"><i class="fa fa-edit">Editar</i></a>
                                          <button class="btn btn-xs btn-warning btn-regen" title="Regenerar token"><i class="fa fa-sync">Regenerar</i></button>
                                          <a class="btn btn-xs btn-danger" onclick="return confirm('¿Eliminar el token seleccionado?')" href="<?=base_url?>apitokens/Eliminar&id=<?= (int)$t->id ?>"><i class="fa fa-trash">Eliminar</i></a>
                                        </td>
                                      </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Token</th>
                                        <th>Habilitado</th>
                                        <th>Creado</th>
                                        <th class="text-end" style="width:180px;">Acciones</th>
                                      </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
<script>
(function(){
  // DataTable si está disponible
  if (window.jQuery && $.fn.DataTable) {
    $('#tabla-tokens').DataTable({
      pageLength: 25,
      order: [[0,'desc']],
      language: {
        url: '<?=base_url?>plugins/datatables/i18n/es-AR.json'
      }
    });
  }

  // Delegación de eventos para acciones del listado
  document.addEventListener('click', async function(ev){
    const row = ev.target.closest('tr[data-id]');
    if (!row) return;
    const id = row.getAttribute('data-id');

    if (ev.target.closest('.btn-toggle-status')) {
      await fetch('<?=base_url?>index/Toggle&id=' + id, {headers:{'X-Requested-With':'XMLHttpRequest'}});
      location.reload();
    }
    if (ev.target.closest('.btn-regen')) {
      if (!confirm('¿Regenerar token?')) return;
      await fetch('<?=base_url?>index/Regenerar&id=' + id, {headers:{'X-Requested-With':'XMLHttpRequest'}});
      location.reload();
    }
  });
})();
</script>
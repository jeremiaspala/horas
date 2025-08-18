<div class="content-wrapper" data-page="api-tokens-index">
  <section class="content-header d-flex justify-content-between align-items-center">
      <h1 class="page-title mb-0">API Tokens</h1><br>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border d-flex justify-content-between align-items-center">
        <h3 class="box-title mb-0">Listado</h3>
        <a class="btn btn-primary btn-sm" href="<?=base_url?>apitokens/editar">
          <i class="fa fa-plus"></i> Nuevo token
        </a>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table id="tabla-tokens" class="table table-striped table-hover table-bordered">
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
                    <i class="fa <?= $t->enabled ? 'fa-toggle-on' : 'fa-toggle-off' ?>"></i>
                  </button>
                </td>
                <td><?= htmlspecialchars($t->created_at) ?></td>
                <td class="text-end">
                  <a class="btn btn-xs btn-primary" href="<?=base_url?>apitokens/editar?id=<?= (int)$t->id ?>"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-xs btn-warning btn-regen" title="Regenerar token"><i class="fa fa-sync"></i></button>
                  <a class="btn btn-xs btn-danger" onclick="return confirm('¿Eliminar el token seleccionado?')" href="<?=base_url?>apitokens/Eliminar&id=<?= (int)$t->id ?>"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
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
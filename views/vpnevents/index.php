<?php @include 'views/layouts/header.php'; ?>
<div class="content-wrapper" data-page="vpn-events-index">
  <section class="content-header d-flex justify-content-between align-items-center">
    <h1 class="page-title mb-0">VPN Events <small class="text-muted">historial</small></h1>
    <ol class="breadcrumb mb-0">
      <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active">VPN Events</li>
    </ol>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border d-flex justify-content-between align-items-center">
        <h3 class="box-title mb-0">Listado</h3>
        <a class="btn btn-primary btn-sm" href="index.php?c=VpnEvents&a=Crud"><i class="fa fa-plus"></i> Nuevo</a>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table id="tabla-vpn" class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Time</th>
                <th>Type</th>
                <th>User</th>
                <th>Service</th>
                <th>Interface</th>
                <th>Remote</th>
                <th>Router</th>
                <th class="text-end" style="width:120px;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($eventos as $e): ?>
              <tr>
                <td><?= (int)$e->id ?></td>
                <td><?= htmlspecialchars($e->event_time) ?></td>
                <td><?= htmlspecialchars($e->event_type) ?></td>
                <td><?= htmlspecialchars($e->user) ?></td>
                <td><?= htmlspecialchars($e->service) ?></td>
                <td><?= htmlspecialchars($e->interface) ?></td>
                <td><?= htmlspecialchars($e->remote_addr) ?></td>
                <td><?= htmlspecialchars($e->router_id) ?></td>
                <td class="text-end">
                  <a class="btn btn-xs btn-primary" href="index.php?c=VpnEvents&a=Crud&id=<?= (int)$e->id ?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger" onclick="return confirm('¿Eliminar?')" href="index.php?c=VpnEvents&a=Eliminar&id=<?= (int)$e->id ?>"><i class="fa fa-trash"></i></a>
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
if (window.jQuery && $.fn.DataTable) {
  $('#tabla-vpn').DataTable({
    pageLength: 25,
    order: [[0,'desc']],
    language: { url: 'plugins/datatables/i18n/es-AR.json' }
  });
}
</script>
<?php @include 'views/layouts/footer.php'; ?>

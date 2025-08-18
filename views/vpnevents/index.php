<?php @include 'views/layouts/header.php'; ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>VPN Events</h3>
    <a class="btn btn-primary" href="index.php?c=VpnEvents&a=Crud">Nuevo</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th><th>Time</th><th>Type</th><th>User</th><th>Service</th><th>Interface</th><th>Remote</th><th>Router</th>
          <th class="text-end">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($eventos as $e): ?>
        <tr>
          <td><?= htmlspecialchars($e->id) ?></td>
          <td><?= htmlspecialchars($e->event_time) ?></td>
          <td><?= htmlspecialchars($e->event_type) ?></td>
          <td><?= htmlspecialchars($e->user) ?></td>
          <td><?= htmlspecialchars($e->service) ?></td>
          <td><?= htmlspecialchars($e->interface) ?></td>
          <td><?= htmlspecialchars($e->remote_addr) ?></td>
          <td><?= htmlspecialchars($e->router_id) ?></td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-primary" href="index.php?c=VpnEvents&a=Crud&id=<?= $e->id ?>">Editar</a>
            <a class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar?')" href="index.php?c=VpnEvents&a=Eliminar&id=<?= $e->id ?>">Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php @include 'views/layouts/footer.php'; ?>

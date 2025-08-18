<?php @include 'views/layouts/header.php'; ?>
<div class="container mt-4">
  <h3><?= $e->id ? 'Editar evento' : 'Nuevo evento' ?></h3>
  <form method="post" action="index.php?c=VpnEvents&a=Guardar" class="mt-3">
    <input type="hidden" name="id" value="<?= htmlspecialchars($e->id) ?>">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">event_time</label>
        <input type="datetime-local" name="event_time" class="form-control" value="<?= $e->event_time ? date('Y-m-d\\TH:i', strtotime($e->event_time)) : '' ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">connect_time</label>
        <input type="datetime-local" name="connect_time" class="form-control" value="<?= $e->connect_time ? date('Y-m-d\\TH:i', strtotime($e->connect_time)) : '' ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">event_type</label>
        <select name="event_type" class="form-select">
          <option value="up" <?= $e->event_type==='up'?'selected':'' ?>>up</option>
          <option value="down" <?= $e->event_type==='down'?'selected':'' ?>>down</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">user</label>
        <input type="text" name="user" class="form-control" value="<?= htmlspecialchars($e->user) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">service</label>
        <input type="text" name="service" class="form-control" value="<?= htmlspecialchars($e->service) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">interface</label>
        <input type="text" name="interface" class="form-control" value="<?= htmlspecialchars($e->interface) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">caller_id</label>
        <input type="text" name="caller_id" class="form-control" value="<?= htmlspecialchars($e->caller_id) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">remote_addr</label>
        <input type="text" name="remote_addr" class="form-control" value="<?= htmlspecialchars($e->remote_addr) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">local_addr</label>
        <input type="text" name="local_addr" class="form-control" value="<?= htmlspecialchars($e->local_addr) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">uptime_sec</label>
        <input type="number" name="uptime_sec" class="form-control" value="<?= htmlspecialchars($e->uptime_sec) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">router_id</label>
        <input type="text" name="router_id" class="form-control" value="<?= htmlspecialchars($e->router_id) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">session_key</label>
        <input type="text" name="session_key" class="form-control" value="<?= htmlspecialchars($e->session_key) ?>">
      </div>
    </div>

    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a class="btn btn-secondary" href="index.php?c=VpnEvents&a=Index">Cancelar</a>
    </div>
  </form>
</div>
<?php @include 'views/layouts/footer.php'; ?>

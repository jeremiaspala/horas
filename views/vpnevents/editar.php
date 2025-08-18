<?php @include 'views/layouts/header.php'; ?>
<div class="content-wrapper" data-page="vpn-events-crud">
  <section class="content-header d-flex justify-content-between align-items-center">
    <h1 class="page-title mb-0"><?= $e->id ? 'Editar evento' : 'Nuevo evento' ?></h1>
    <ol class="breadcrumb mb-0">
      <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="index.php?c=VpnEvents&a=Index">VPN Events</a></li>
      <li class="active"><?= $e->id ? 'Editar' : 'Nuevo' ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $e->id ? 'Editar' : 'Nuevo' ?></h3>
      </div>
      <div class="box-body">
        <form method="post" action="index.php?c=VpnEvents&a=Guardar" autocomplete="off">
          <input type="hidden" name="id" value="<?= (int)$e->id ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>event_time</label>
                <input type="datetime-local" name="event_time" class="form-control" value="<?= $e->event_time ? date('Y-m-d\\TH:i', strtotime($e->event_time)) : '' ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>connect_time</label>
                <input type="datetime-local" name="connect_time" class="form-control" value="<?= $e->connect_time ? date('Y-m-d\\TH:i', strtotime($e->connect_time)) : '' ?>">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>event_type</label>
                <select name="event_type" class="form-control">
                  <option value="up"   <?= $e->event_type==='up'?'selected':'' ?>>up</option>
                  <option value="down" <?= $e->event_type==='down'?'selected':'' ?>>down</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>user</label>
                <input type="text" name="user" class="form-control" value="<?= htmlspecialchars($e->user) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>service</label>
                <input type="text" name="service" class="form-control" value="<?= htmlspecialchars($e->service) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>interface</label>
                <input type="text" name="interface" class="form-control" value="<?= htmlspecialchars($e->interface) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>caller_id</label>
                <input type="text" name="caller_id" class="form-control" value="<?= htmlspecialchars($e->caller_id) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>remote_addr</label>
                <input type="text" name="remote_addr" class="form-control" value="<?= htmlspecialchars($e->remote_addr) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>local_addr</label>
                <input type="text" name="local_addr" class="form-control" value="<?= htmlspecialchars($e->local_addr) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>uptime_sec</label>
                <input type="number" name="uptime_sec" class="form-control" value="<?= htmlspecialchars($e->uptime_sec) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>router_id</label>
                <input type="text" name="router_id" class="form-control" value="<?= htmlspecialchars($e->router_id) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>session_key</label>
                <input type="text" name="session_key" class="form-control" value="<?= htmlspecialchars($e->session_key) ?>">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
            <a class="btn btn-default" href="index.php?c=VpnEvents&a=Index"><i class="fa fa-arrow-left"></i> Volver</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<?php @include 'views/layouts/footer.php'; ?>

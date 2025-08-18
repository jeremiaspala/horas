<?php
// $base_url puede venir del layout. Si no existe lo definimos vacío para URLs relativas.
if (!isset($base_url)) { $base_url = ''; }
@include 'views/layouts/header.php';
?>
<div class="content-wrapper" data-page="dashboard-index">
  <section class="content-header">
    <h1 class="page-title">Dashboard <small class="text-muted">Resumen</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?= $base_url ?>index.php"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <!-- KPI: usuarios conectados hoy -->
      <div class="col-md-3 col-sm-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= (int)$kpi ?></h3>
            <p>Usuarios conectados hoy</p>
          </div>
          <div class="icon"><i class="fa fa-user-check"></i></div>
          <a href="#" class="small-box-footer">Actualizado hoy</a>
        </div>
      </div>

      <!-- Gráfica (misma idea que el dashboard anterior con Chart.js) -->
      <div class="col-md-9 col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Conexiones por hora (hoy)</h3>
          </div>
          <div class="box-body">
            <canvas id="mainChart" height="85"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Top 10 usuarios conectados hoy -->
      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Usuarios conectados hoy (Top 10)</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>IP Pública</th>
                  <th>Última hora</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($hoyUsuarios as $u): ?>
                <tr>
                  <td><?= htmlspecialchars($u->user) ?></td>
                  <td><?= htmlspecialchars($u->remote_addr) ?></td>
                  <td><?= htmlspecialchars($u->last_time) ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Ranking semanal -->
      <div class="col-md-6">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Top semana (más horas)</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>IP Pública</th>
                  <th>Total Semana</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($topSemana as $r): ?>
                <tr>
                  <td><?= htmlspecialchars($r->user) ?></td>
                  <td><?= htmlspecialchars($r->remote_addr) ?></td>
                  <td>
                    <?php
                      echo DashboardController::formato_dhms($r->total_sec);
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Ranking mensual -->
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Top mes (más horas)</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped table-hover table-bordered" id="tabla-top-mes">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>IP Pública</th>
                  <th>Total Mes</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($topMes as $r): ?>
                <tr>
                  <td><?= htmlspecialchars($r->user) ?></td>
                  <td><?= htmlspecialchars($r->remote_addr) ?></td>
                  <td><?php echo DashboardController::formato_dhms($r->total_sec); ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- La vista asume que el layout ya incluye jQuery, Chart.js, AdminLTE/Bootstrap -->
<script>
(function(){
  if (typeof Chart === 'undefined') return;
  var ctx = document.getElementById('mainChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= $chart_labels ?>,
      datasets: [{
        label: 'Conexiones (hoy)',
        data: <?= $chart_data ?>,
        fill: false,
        borderWidth: 2,
        pointRadius: 2,
        tension: 0.2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, ticks: { precision:0 } }
      }
    }
  });
})();
</script>
<?php @include 'views/layouts/footer.php'; ?>


<div class="container-fluid py-3">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="m-0">inventario para radius</h4>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-nuevo-owner">
        <i class="fa fa-user-plus me-1"></i> nuevo usuario
      </button>
      <button id="btn-nuevo-equipo" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-nuevo-equipo">
        <i class="fa fa-plus me-1"></i> nuevo equipo
      </button>
    </div>
  </div>

  <div class="row g-3">
    <!-- izquierda: árbol -->
    <div class="col-12 col-md-4 col-lg-3">
      <div class="card shadow-sm">
        <div class="card-header py-2">
          <div class="input-group input-group-sm">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
            <input id="filtro-arbol" type="text" class="form-control" placeholder="filtrar usuarios... (enter para buscar)">
          </div>
        </div>
        <div class="card-body p-0" style="max-height: 70vh; overflow:auto;">
          <ul id="arbol-owners" class="list-group list-group-flush">
            <?php foreach ($owners as $o):
              $label = trim(($o['apellido'] ?? '').', '.($o['nombre'] ?? ''));
              $label = $label ?: ($o['usuario'] ?? ('owner #'.$o['id']));
            ?>
              <li class="list-group-item owner-li" data-owner-id="<?= (int)$o['id'] ?>">
                <div class="d-flex align-items-center justify-content-between">
                  <a href="#" class="owner-link text-decoration-none" data-owner-id="<?= (int)$o['id'] ?>">
                    <i class="fa fa-user me-2"></i>
                    <span class="owner-name"><?= htmlspecialchars($label) ?></span>
                  </a>
                  <button class="btn btn-sm btn-light toggle-equipos"
                          data-owner-id="<?= (int)$o['id'] ?>"
                          data-bs-toggle="collapse"
                          data-bs-target="#equipos-<?= (int)$o['id'] ?>">
                    <i class="fa fa-chevron-down"></i>
                  </button>
                </div>
                <ul id="equipos-<?= (int)$o['id'] ?>" class="list-group collapse mt-2"></ul>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- derecha: detalles -->
    <div class="col-12 col-md-8 col-lg-9">
      <div class="card shadow-sm mb-3">
        <div class="card-header py-2"><strong>usuario</strong></div>
        <div id="panel-owner" class="card-body">
          <div class="text-muted">seleccioná un usuario para ver sus datos.</div>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-header py-2"><strong>equipo</strong></div>
        <div id="panel-equipo" class="card-body">
          <div class="text-muted">seleccioná un equipo para ver mac/vlan/ip, etc.</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal: nuevo owner -->
<div class="modal fade" id="modal-nuevo-owner" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <form method="post" action="<?= $base_url ?>radius/storeowner" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">nuevo usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col-md-6">
            <label class="form-label">nombre</label>
            <input name="nombre" class="form-control form-control-sm" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">apellido</label>
            <input name="apellido" class="form-control form-control-sm" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">usuario</label>
            <input name="usuario" class="form-control form-control-sm">
          </div>
          <div class="col-md-6">
            <label class="form-label">email</label>
            <input type="email" name="email" class="form-control form-control-sm">
          </div>
          <div class="col-md-8">
            <label class="form-label">sector</label>
            <input name="sector" class="form-control form-control-sm">
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="habilitado" id="chk-hab" checked>
              <label class="form-check-label" for="chk-hab">habilitado</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
        <button class="btn btn-primary">guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- modal: nuevo equipo -->
<div class="modal fade" id="modal-nuevo-equipo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <form method="post" action="<?= $base_url ?>radius/storeequipo" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">nuevo equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col-md-6">
            <label class="form-label">nombre</label>
            <input name="eq_nombre" class="form-control form-control-sm" placeholder="notebook jere / iphone..." required>
          </div>
          <div class="col-md-6">
            <label class="form-label">tipo</label>
            <input name="eq_tipo" class="form-control form-control-sm" placeholder="pc, notebook, celular, servidor..." required>
          </div>
          <div class="col-md-4">
            <label class="form-label">mac</label>
            <input name="eq_mac" class="form-control form-control-sm" placeholder="aa:bb:cc:dd:ee:ff"
                   pattern="^([0-9a-fA-F]{2}[:\-]){5}[0-9a-fA-F]{2}$" title="formato AA:BB:CC:DD:EE:FF">
          </div>
          <div class="col-md-4">
            <label class="form-label">ip (opcional)</label>
            <input name="eq_ip" class="form-control form-control-sm" placeholder="10.0.0.x"
                   pattern="^((25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)\.){3}(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)$" title="IP v4 válida">
          </div>
          <div class="col-md-4">
            <label class="form-label">vlan</label>
            <select name="eq_vlan_id" class="form-select form-select-sm">
              <option value="0">—</option>
              <?php foreach (($vlans ?? []) as $v): ?>
                <option value="<?= (int)$v['id'] ?>">
                  <?= htmlspecialchars($v['nombre']) ?> (<?= (int)$v['vlan_id'] ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-8">
            <label class="form-label">descripción</label>
            <input name="eq_desc" class="form-control form-control-sm" placeholder="notas / serie, etc.">
          </div>
          <div class="col-md-4">
            <label class="form-label">owner</label>
            <select id="eq_owner_id" name="eq_owner_id" class="form-select form-select-sm" required>
              <?php foreach ($owners as $o):
                $label = trim(($o['apellido'] ?? '').', '.($o['nombre'] ?? ''));
                $label = $label ?: ($o['usuario'] ?? ('owner #'.$o['id']));
              ?>
                <option value="<?= (int)$o['id'] ?>"><?= htmlspecialchars($label) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-12">
            <label class="form-label">sector (opcional)</label>
            <input name="eq_sector_id" type="number" class="form-control form-control-sm" placeholder="id de sector si aplica">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
        <button class="btn btn-primary">guardar</button>
      </div>
    </form>
  </div>
</div>

<script>
(function() {
  const base = "<?= $base_url ?>";
  const $arbol = $('#arbol-owners');
  const $panelOwner = $('#panel-owner');
  const $panelEquipo = $('#panel-equipo');
  let selectedOwnerId = null;

  // -------- búsqueda con enter (AJAX) ----------
  $('#filtro-arbol').on('keydown', function(e){
    if (e.key === 'Enter') {
      e.preventDefault();
      const q = $(this).val().trim();
      $.getJSON(base + 'radius/apiowners', { q }, function(rows) {
        renderOwners(rows || []);
      });
    }
  });

  // -------- botón "nuevo equipo": preseleccionar owner si hay seleccionado ----------
  $('#btn-nuevo-equipo').on('click', function() {
    if (selectedOwnerId) {
      $('#eq_owner_id').val(String(selectedOwnerId));
    }
  });

  // -------- render dinámico de owners ----------
  function renderOwners(owners) {
    $arbol.empty();
    if (!owners.length) {
      $arbol.append('<li class="list-group-item text-muted">sin resultados</li>');
      return;
    }
    owners.forEach(o => {
      const label = ((o.apellido || '') + ', ' + (o.nombre || '')).replace(/^, /,'').trim() || (o.usuario || ('owner #' + o.id));
      const li = $(`
        <li class="list-group-item owner-li" data-owner-id="${o.id}">
          <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="owner-link text-decoration-none" data-owner-id="${o.id}">
              <i class="fa fa-user me-2"></i>
              <span class="owner-name">${escapeHtml(label)}</span>
            </a>
            <button class="btn btn-sm btn-light toggle-equipos"
                    data-owner-id="${o.id}"
                    data-bs-toggle="collapse"
                    data-bs-target="#equipos-${o.id}">
              <i class="fa fa-chevron-down"></i>
            </button>
          </div>
          <ul id="equipos-${o.id}" class="list-group collapse mt-2"></ul>
        </li>
      `);
      $arbol.append(li);
    });
  }

  // -------- expandir: cargar equipos agrupados por tipo ----------
  $arbol.on('click', '.toggle-equipos', function() {
    const oid = $(this).data('owner-id');
    const $ul = $('#equipos-' + oid);
    if ($ul.hasClass('loaded')) return;
    $.getJSON(base + 'radius/apiequiposbyowner', { owner_id: oid }, function(rows) {
      $ul.empty();
      if (!rows || !rows.length) {
        $ul.append('<li class="list-group-item text-muted">sin equipos</li>');
      } else {
        const byTipo = groupBy(rows, r => (r.tipo || 'otros').toLowerCase());
        Object.keys(byTipo).sort().forEach(tipo => {
          const tid = 'tipo-' + tipo.replace(/[^a-z0-9]+/g,'-') + '-' + oid;
          const tipoLi = $(`
            <li class="list-group-item py-1">
              <div class="d-flex align-items-center justify-content-between">
                <span><i class="me-2 ${iconForTipo(tipo)}"></i><strong>${escapeHtml(tipo)}</strong></span>
                <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#${tid}">
                  <i class="fa fa-chevron-down"></i>
                </button>
              </div>
              <ul id="${tid}" class="list-group collapse mt-2"></ul>
            </li>
          `);
          const $sub = tipoLi.find('#' + tid);
          byTipo[tipo].forEach(eq => {
            const eqLi = $(`
              <li class="list-group-item py-1">
                <a href="#" class="equipo-link text-decoration-none" data-equipo-id="${eq.id}">
                  <i class="fa fa-cube me-2"></i>
                  <span>${escapeHtml(eq.nombre || '')}</span>
                </a>
              </li>
            `);
            $sub.append(eqLi);
          });
          $ul.append(tipoLi);
        });
      }
      $ul.addClass('loaded');
    });
  });

  // -------- click en owner: detalle + auto expand ----------
  $arbol.on('click', '.owner-link', function(e) {
    e.preventDefault();
    const oid = $(this).data('owner-id');
    selectedOwnerId = oid;

    // detalle
    $.getJSON(base + 'radius/apiownershow', { id: oid }, function(o) {
      if (!o) return;
      $panelOwner.html(`
        <div class="row g-2">
          <div class="col-md-6">
            <div><strong>${escapeHtml((o.apellido||'') + ', ' + (o.nombre||''))}</strong></div>
            <div class="text-muted">${escapeHtml(o.usuario || '')}</div>
          </div>
          <div class="col-md-6">
            <div>${escapeHtml(o.email || '')}</div>
            <div>sector: ${escapeHtml(o.sector || '-')}</div>
            <span class="badge ${parseInt(o.habilitado) === 1 ? 'bg-success' : 'bg-secondary'}">
              ${parseInt(o.habilitado) === 1 ? 'habilitado' : 'deshabilitado'}
            </span>
          </div>
        </div>
      `);
    });

    // expandir equipos si no está cargado
    const $btn = $(`.toggle-equipos[data-owner-id="${oid}"]`);
    const $ul = $('#equipos-' + oid);
    if (!$ul.hasClass('show')) {
      $btn.trigger('click'); // hará el fetch si no está loaded y luego expandirá
      // abrir visualmente
      $ul.addClass('show');
    }
  });

  // -------- click en equipo: detalle ----------
  $arbol.on('click', '.equipo-link', function(e) {
    e.preventDefault();
    const id = $(this).data('equipo-id');
    $.getJSON(base + 'radius/apiequiposhow', { id }, function(eq) {
      if (!eq) return;
      $panelEquipo.html(`
        <div class="row g-2">
          <div class="col-md-6">
            <div><strong>${escapeHtml((eq.tipo||'') + ' - ' + (eq.nombre||''))}</strong></div>
            <div class="text-muted">${escapeHtml(eq.descripcion || '')}</div>
          </div>
          <div class="col-md-6">
            <div>mac: <code>${escapeHtml(eq.mac_address || '-')}</code></div>
            <div>ip: <code>${escapeHtml(eq.ip_address || '-')}</code></div>
            <div>vlan: <code>${escapeHtml(eq.vlan_nombre || '-')}</code> (${escapeHtml(eq.vlan_tag || '-')})</div>
          </div>
          <div class="col-12">
            <small class="text-muted">creado: ${escapeHtml(eq.created_at || '-')} — actualizado: ${escapeHtml(eq.updated_at || '-')}</small>
          </div>
        </div>
      `);
    });
  });

  // -------- helpers ----------
  function escapeHtml(s) {
    return (''+s)
      .replaceAll('&','&amp;')
      .replaceAll('<','&lt;')
      .replaceAll('>','&gt;')
      .replaceAll('"','&quot;')
      .replaceAll("'",'&#039;');
  }

  function groupBy(arr, fnKey) {
    const out = {};
    arr.forEach(x => {
      const k = fnKey(x);
      (out[k] ||= []).push(x);
    });
    return out;
  }

  function iconForTipo(tipo) {
    switch (tipo) {
      case 'pc': return 'fa fa-desktop';
      case 'notebook': return 'fa fa-laptop';
      case 'celular': return 'fa fa-mobile';
      case 'servidor': return 'fa fa-server';
      case 'camara': return 'fa fa-video';
      case 'domo': return 'fa fa-video';
      case 'ap': return 'fa fa-wifi';
      case 'router': return 'fa fa-project-diagram';
      case 'switch': return 'fa fa-project-diagram';
      case 'biometrico': return 'fa fa-id-card';
      case 'arduino': return 'fa fa-microchip';
      case 'intelektron': return 'fa fa-id-badge';
      case 'radioenlace': return 'fa fa-broadcast-tower';
      default: return 'fa fa-cube';
    }
  }
})();
</script>

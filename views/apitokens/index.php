<?php
// Layouts del proyecto (ajustá a tus rutas si corresponde)
@include 'views/layouts/header.php';
?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>API Tokens</h3>
    <a class="btn btn-primary" href="index.php?c=ApiTokens&a=Crud">Nuevo token</a>
  </div>

  <table class="table table-striped align-middle" id="tabla-tokens">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Token</th>
        <th>Habilitado</th>
        <th>Creado</th>
        <th class="text-end">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($tokens as $t): ?>
      <tr data-id="<?= htmlspecialchars($t->id) ?>">
        <td><?= htmlspecialchars($t->id) ?></td>
        <td><?= htmlspecialchars($t->name) ?></td>
        <td><code class="small"><?= htmlspecialchars($t->token) ?></code></td>
        <td>
          <button class="btn btn-sm toggle btn-<?= $t->enabled ? 'success' : 'secondary' ?>" title="Habilitar/Deshabilitar">
            <?= $t->enabled ? '<i class="bi bi-check-circle"></i>' : '<i class="bi bi-slash-circle"></i>' ?>
          </button>
        </td>
        <td><?= htmlspecialchars($t->created_at) ?></td>
        <td class="text-end">
          <a class="btn btn-sm btn-outline-primary" href="index.php?c=ApiTokens&a=Crud&id=<?= $t->id ?>">Editar</a>
          <button class="btn btn-sm btn-outline-warning regen">Regenerar</button>
          <a class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar?')" href="index.php?c=ApiTokens&a=Eliminar&id=<?= $t->id ?>">Eliminar</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
document.addEventListener('click', async (e) => {
  const row = e.target.closest('tr[data-id]');
  if (!row) return;
  const id = row.dataset.id;

  if (e.target.closest('.toggle')) {
    await fetch(`index.php?c=ApiTokens&a=Toggle&id=${id}`, {headers:{'X-Requested-With':'XMLHttpRequest'}});
    location.reload();
  }
  if (e.target.closest('.regen')) {
    if (!confirm('¿Regenerar token?')) return;
    await fetch(`index.php?c=ApiTokens&a=Regenerar&id=${id}`, {headers:{'X-Requested-With':'XMLHttpRequest'}});
    location.reload();
  }
});
</script>
<?php @include 'views/layouts/footer.php'; ?>

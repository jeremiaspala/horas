<?php @include 'views/layouts/header.php'; ?>
<div class="container mt-4">
  <h3><?= $token->id ? 'Editar token' : 'Nuevo token' ?></h3>
  <form method="post" action="index.php?c=ApiTokens&a=Guardar" class="mt-3">
    <input type="hidden" name="id" value="<?= htmlspecialchars($token->id) ?>">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($token->name) ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Token</label>
      <div class="input-group">
        <input type="text" name="token" id="token" class="form-control" value="<?= htmlspecialchars($token->token) ?>" placeholder="(vacío para autogenerar)">
        <button class="btn btn-outline-secondary" type="button" id="btnGen">Generar</button>
      </div>
      <div class="form-text">Si lo dejás vacío al guardar, se autogenera.</div>
    </div>
    <div class="form-check form-switch mb-3">
      <input class="form-check-input" type="checkbox" name="enabled" value="1" id="enabled" <?= $token->enabled ? 'checked' : '' ?>>
      <label class="form-check-label" for="enabled">Habilitado</label>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a class="btn btn-secondary" href="index.php?c=ApiTokens&a=Index">Cancelar</a>
    </div>
  </form>
</div>
<script>
document.getElementById('btnGen').addEventListener('click', async () => {
  // generador simple desde el navegador (no criptoseguro, solo para vista)
  const array = new Uint8Array(32);
  crypto.getRandomValues(array);
  const hex = Array.from(array).map(b => b.toString(16).padStart(2,'0')).join('');
  document.getElementById('token').value = hex;
});
</script>
<?php @include 'views/layouts/footer.php'; ?>

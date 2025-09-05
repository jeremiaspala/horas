
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $token->id ? 'Editar' : 'Nuevo' ?></h3>
      </div>
      <div class="box-body">
        <form method="post" action="<?=base_url?>apitokens/Guardar" autocomplete="off">
          <input type="hidden" name="id" value="<?= (int)$token->id ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($token->name) ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Token</label>
                <div class="input-group">
                  <input type="text" name="token" id="token" class="form-control" value="<?= htmlspecialchars($token->token) ?>" placeholder="(vacío para autogenerar)">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="btnGen"><i class="fa fa-bolt"></i> Generar</button>
                  </span>
                </div>
                <p class="help-block">Si lo dejás vacío al guardar, se autogenera en el servidor.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="enabled" value="1" <?= $token->enabled ? 'checked' : '' ?>> Habilitado
                </label>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
            <a class="btn btn-default" href="<?=base_url?>apitokens/index"><i class="fa fa-arrow-left"></i> Volver</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<script>
document.getElementById('btnGen').addEventListener('click', function(){
  if (!window.crypto || !window.crypto.getRandomValues) {
    // fallback simple
    document.getElementById('token').value = (Date.now().toString(16) + Math.random().toString(16).slice(2)).padEnd(64,'0').slice(0,64);
    return;
  }
  const arr = new Uint8Array(32);
  crypto.getRandomValues(arr);
  const hex = Array.from(arr).map(b => b.toString(16).padStart(2,'0')).join('');
  document.getElementById('token').value = hex;
});
</script>


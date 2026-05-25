<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login &mdash; OSCE Rekam Medis</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">
</head>
<body>
<div class="login-shell">
  <div class="card login-card shadow-lg border-0">
    <div class="card-body p-4">
      <h1 class="h4 text-primary mb-1">OSCE Rekam Medis</h1>
      <p class="text-muted small mb-4">Stase 3 &mdash; Koding Diagnosa</p>

      <?php if ($err = $this->session->flashdata('error')): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($err) ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('login') ?>">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>

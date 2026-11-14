<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/main.css">
  <title>Todo APP</title>
</head>
<body class="bg-body-tertiary">
  <nav class="navbar navbar-dark bg-danger">
    <div class="container">
      <a href="/" class="navbar-brand fw-semibold">Todo APP</a>
      <a href="/logout" class="nav-link text-white">Tancar sessió (<?= $user["user"]; ?>)</a>
    </div>
  </nav>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7">
        <header class="mb-4">
          <h1 class="h2 fw-bold mb-1">Les teves tasques</h1>
          <p class="text-secondary mb-0">Organitza el que tens pendent i revisa el que ja has fet.</p>
        </header>
        <form action="/" method="post" class="card border-0 shadow-sm mb-4">
          <div class="card-body p-4">
            <label for="task" class="form-label fw-semibold">Afegeix una tasca</label>
            <div class="input-group">
              <input type="text" id="task" name="task" class="form-control" placeholder="Què has de fer?" required>
              <button type="submit" class="btn btn-primary">Afegir</button>
            </div>
          </div>
        </form>
        <section class="card border-0 shadow-sm mb-4" aria-labelledby="pending-title">
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-4 pb-3">
            <h2 id="pending-title" class="h5 fw-semibold mb-0">Pendents</h2>
            <span class="badge rounded-pill text-bg-primary"><?= count($todo) ?></span>
          </div>
          <ul class="list-group list-group-flush rounded-bottom">
            <?php if (empty($todo)) { ?>
              <li class="list-group-item text-secondary px-4 py-3">No tens cap tasca pendent.</li>
            <?php } ?>
            <?php foreach ($todo as $i => $task) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center gap-3 px-4 py-3">
                <span><?= $task; ?></span>
                <a href="/done/<?= $i ?>" class="btn btn-outline-success btn-sm flex-shrink-0">Feta!</a>
              </li>
            <?php } ?>
          </ul>
        </section>
        <section class="card border-0 shadow-sm" aria-labelledby="done-title">
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-4 pb-3">
            <h2 id="done-title" class="h5 fw-semibold mb-0">Completades</h2>
            <span class="badge rounded-pill text-bg-secondary"><?= count($done) ?></span>
          </div>
          <ul class="list-group list-group-flush rounded-bottom">
            <?php if (empty($done)) { ?>
              <li class="list-group-item text-secondary px-4 py-3">Encara no has completat cap tasca.</li>
            <?php } ?>
            <?php foreach ($done as $i => $task) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center gap-3 px-4 py-3">
                <span class="text-secondary text-decoration-line-through"><?= $task; ?></span>
                <a href="/undone/<?= $i ?>" class="btn btn-outline-secondary btn-sm flex-shrink-0">Restaura!</a>
              </li>
            <?php } ?>
          </ul>
        </section>
      </div>
    </div>
  </main>
  <script src="/js/bundle.js"></script>
</body>
</html>

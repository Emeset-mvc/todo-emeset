<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/main.css">

  <title>Exemple de portada</title>
</head>

<body >
  <div class="container py-5">
    <div class="row">
      <div>
        <h1 class="h2 mb-4 fw-bold">Exemple de controlador del Framework Emeset</h1>
      </div>
    </div>

    <?php if ($error != "") { ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>


    <div class="row justify-content-center p-2">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card card-body shadow-sm">
          <form class="d-grid gap-3" action="/login" method="post">
            <h5 class="h5 mb-3">Emeset - Exemple de login</h5>
            <div>
              <label for="usuari" class="form-label">Your email</label>
              <input type="text" name="user" id="usuari" class="form-control" placeholder="name@company.com" required>
            </div>
            <div>
              <label for="clau" class="form-label">Your password</label>
              <input type="password" name="password" id="clau" placeholder="••••••••" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Hola!</button>

          </form>
        </div>


      </div>
    </div>
  </div>

  <script src="/js/bundle.js"></script>
</body>

</html>

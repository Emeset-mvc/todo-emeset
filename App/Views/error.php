<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/main.css">

  <title>Error</title>
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div>
        <h1 class="h2 mb-4 fw-bold">Alguna cosa ha anat malament!</h1>
      </div>
    </div>

    <?php if (isset($error) && $error != "") { ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

    <div class="row">
      <div>
        <p class="lead">Si has arribat aquí vol dir que alguna cosa ha fallat.</p>
      </div>
    </div>

  </div>
  <script src="/js/bundle.js"></script>
</body>

</html>

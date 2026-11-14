<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/main.css">

  <title>About</title>
</head>

<body>

  <nav class="navbar navbar-dark bg-danger">
    <div class="container d-flex justify-content-between align-items-center">
      <a href="/" class="text-decoration-none">
        <span class="navbar-brand">Todo APP</span>
      </a>
      <div class="d-block" id="navbar-default">
        <?php if($logged){ ?>
        <ul class="navbar-nav">
          <li>
            <a href="/logout" class="nav-link text-white" aria-current="page">Tancar sessió (<?= $user["user"]; ?>)</a>
          </li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </nav>

  <div class="container mt-2">
    <div class="row justify-content-center p-2">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body border-bottom">
            About Page
          </div>
          
        </div>
      </div>
    </div>

    
  

  <script src="/js/bundle.js"></script>
</body>

</html>

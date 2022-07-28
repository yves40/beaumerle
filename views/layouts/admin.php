<?php
  use app\core\Application;
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title><?php echo APPTITLE ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
          </ul>
    </nav>

    <div class="container">
      {{content}}
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small blue">
      <div class="footer-copyright text-center py-3">
      <p class="version"><?php echo Application::$app->copyright ?></p>
      </div>
    </footer>
  </body>
</html>

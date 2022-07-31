<?php
  use app\core\Application;
?>

<html>
  <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/lang.js"></script>
        <script src="js/script.js"></script>
        <title><?php echo APPTITLE ?></title>
  </head>
  <body>
      <!---------------------------- The menu section ---------------------------->
      <nav class="navbar navbar-expand-lg bg-light ">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent" mx-4>
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a id="a-hometext" class="nav-link active" aria-current="page" href="/"></a>
              </li>
            </ul>
            <!-- Knives -->
            <div class="dropdown">
              <button id="a-knivesadmin"class="btn btn-light dropdown-toggle" type="button" 
                    data-bs-toggle="dropdown" aria-expanded="false"></button>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1" >
                <li><a id="a-kniveslist" class="dropdown-item" href="#"></a></li>
                <li><a id="a-knivesnew" class="dropdown-item" href="#"></a></li>
                <li><hr class="dropdown-divider"> </li>
                <li><a id="a-knivesedit" class="dropdown-item" href="#"></a></li>
              </ul>
            </div>
            <!-- Users -->
            <div class="dropdown">
              <button id="a-usersadmin" class="btn btn-light dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false"></button>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                <li><a id="a-usersnew" class="dropdown-item" href="/usersregister"></a></li>
                <li><a id="a-usersedit" class="dropdown-item" href="/usersedit"></a></li>
                <li><a id="a-userslogin" class="dropdown-item" href="/userslogin"></a></li>
                <li><hr class="dropdown-divider"> </li>
                <li><a id="a-userslist" class="dropdown-item" href="#"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!---------------------------- The core section ---------------------------->
      <div class="container">
        {{content}}
      </div>
      <!----------------------------  Footer ---------------------------- -->
      <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">
              <p class="version"><?php echo COPYRIGHT ?></p>
        </div>
      </footer>
  </body>
</html>

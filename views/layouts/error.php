<html>
  <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" >
        <script src="jquery.min.js"></script>
        <script src="script.js"></script>
        <script src="js/lang.js"></script>
        <script src="https://kit.fontawesome.com/a33a97f757.js" crossorigin="anonymous"></script>        
        <title><?php echo APPTITLE ?></title>
  </head>
  <body>
      <!---------------------------- The menu section ---------------------------->
      <section class="menu">
          <nav>
              <div id="thelogo">
                  <a id="logo"><img src="/images/BeauMerle.png" alt=""></a>
              </div>
              <div class="nav-links" id="navLinks">   
                <i class="fas fa-times" ></i>
                <ul id="menuentries">
                    <li><a id="a-hometext" >HOME</a></li>
                    <li><span id="a-french"></span> | <span id="a-english"></span></li>
                </ul>
              </div>
              <i class="fas fa-bars"></i>
          </nav>
      </section>
        <!---------------------------- The core section ---------------------------->
        {{content}}

      <!----------------------------  Footer ---------------------------- -->
      <footer class="page-footer font-small blue">
          <div class="footer-copyright text-center py-3">
             <p class="version"><?php echo COPYRIGHT ?></p>
          </div>
        </footer>
  </body>
</html>
<!-- -------------------------------------- -->
<style>
  nav .navbar-nav li a {
  color: white !important;
  } 
</style>

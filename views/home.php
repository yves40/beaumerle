
<?php
  use app\core\Application;
?>


<h1>Home</h1>
<?php if (!Application::isGuest()): ?>
  <h3 class="generalmessage">Glad to see you back <?php echo Application::$app->user->getFirstName() ?></h3>
<?php else: ?>
  <h3 class="generalmessage">Welcome on [ mvcfr ] site</h3>
<?php endif; ?>
  
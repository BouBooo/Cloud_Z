<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="">
      <input type="text" placeholder="mail" name="email"/>
      <input type="password" placeholder="password" name="password"/>
      <button name="login">login</button>
      <p class="message">Not registered? <a href="index.php?page=inscription">Create an account</a></p>
      <br>
      <?= $error_msg; ?>
      <?php 
      if(!empty($_SESSION['sign_succes']))
      {
        echo $_SESSION['sign_success'];
      }
      ?>
    </form>
  </div>
</div>
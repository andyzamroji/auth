<?php
require_once 'core/init.php';

if (Input::get('submit') ){

  $user->register_user(array(
    'username' => Input::get('username'),
    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
  ));

}

require_once 'templates/header.php';

 ?>

<h2>Daftar Di Sini</h2>

<form action="register.php" method="post">
  <label>Username</label>
  <input type="text" name="username"> <br>

  <label>Password</label>
  <input type="password" name="password"> <br>

  <input type="submit" name="submit" value="Register">
</form>

 <?php
 require_once 'templates/footer.php';
  ?>

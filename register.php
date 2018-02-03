<?php
require_once 'core/init.php';

$errors = array();
//uji tombol submit
if (Input::get('submit') ){

  //1. memanggil objek validasi
  $validation = new Validation();

  //2. metode check
  $validation = $validation->check(array(
    'username' => array(
                    'required' => true,
                    'min'      => 3,
                    'max'      => 50,
                  ),
    'password' => array(
                    'required' => true,
                    'min'      => 3,
                  )
  ));

  //3. menguji ke valid an
  if ($validation->passed() ) {
    $user->register_user(array(
      'username' => Input::get('username'),
      'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
  ));
  }else {
    $errors = $validation->errors();
  }

}

require_once 'templates/header.php';

 ?>

<h2>Daftar Di Sini</h2>

<form action="register.php" method="post">

<?php if (!empty($errors)) { ?>
  <div id="errors">
    <?php foreach ($errors as $error) { ?>
      <li> <?php echo $error; ?> </li>
    <?php } ?>
  </div>
<?php } ?>

  <label>Username</label>
  <input type="text" name="username"> <br>

  <label>Password</label>
  <input type="password" name="password"> <br>

  <input type="submit" name="submit" value="Register">
</form>
 <?php require_once 'templates/footer.php'; ?>

<?php
require_once 'core/init.php';

if( Session::exists('username') ){
  header('location: profile.php');
}

$errors = array();
//uji tombol submit
if (Input::get('submit') ){

  //1. memanggil objek validasi
  $validation = new Validation();

  //2. metode check
  $validation = $validation->check(array(
    'username' => array('required' => true,),
    'password' => array('required' => true)
  ));

  //3. menguji ke valid an
  if ( $validation->passed() ) {

  if( $user->cek_nama(Input::get('username'))){
    if( $user->login_user( Input::get('username'), Input::get('password') ) )
    {
      Session::set('username', Input::get('username'));
      header('location: profile.php');
    }else {
      $errors[] = 'login gagal';
    }
  }else {
    $errors[] = 'username belum terdaftar';
  }

  }else {
    $errors = $validation->errors();
  }

}

require_once 'templates/header.php';

 ?>

<h2>Login Di Sini</h2>

<form action="login.php" method="post">

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

  <input type="submit" name="submit" value="Login">
</form>
 <?php require_once 'templates/footer.php'; ?>

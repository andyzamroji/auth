<?php

/**
 *
 */
class Database
{
  private static $INSTANCE = null;
  private $mysqli,
          $HOST = 'localhost',
          $USER = 'root',
          $PASS = '',
          $DBNAME = 'login_oop';

  function __construct()
  {
    $this->mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DBNAME);
    if ( mysqli_connect_error() ){
      die('gagal koneksi');
    }
  }

  /*
    Singleton Pattern,
    Menguji Konkesi agar tidak double
  */
  public static function getInstance(){
    if( !isset( self::$INSTANCE) ){
      self::$INSTANCE = new Database();
    }

    return self::$INSTANCE;
  }
}

 ?>

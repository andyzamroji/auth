<?php

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

  public function insert($table, $fields = array())
  {
    //mengambil kolom
    $column = implode(", ", array_keys($fields));

    //mengambil value
    $valueArrays = array();
    $i = 0;
    foreach($fields as $key => $values) {
      if ( is_int($values) ) {
        $valuesArrays[$i] = $this->escape($values);
      }else {
        $valuesArrays[$i] = "'" . $this->escape($values) . "'";
      }
      $i++;
    }
    //var_dump($valuesArrays);
    $values = implode(", ", $valuesArrays);

    $query = "INSERT INTO $table ($column) VALUES ($values)";

    return $this->run_query($query, 'masalah saat memasukkan data!');
  }

  public function get_info($table, $column, $value)
  {
    if ( !is_int($value) )
    {
      $value = "'" . $value . "'";
    }

    $query = "SELECT * FROM $table WHERE $column = $value";
    $result = $this->mysqli->query($query);

    while ($row = $result->fetch_assoc() )
    {
      return $row;
    }
  }

  public function run_query($query, $msg)
  {
    if($this->mysqli->query($query)) return true;
    else die($msg);
  }

  public function escape($name)
  {
    return $this->mysqli->real_escape_string($name);
  }

}

 ?>

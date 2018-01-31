<?php

/**
 *
 */
class User
{

  private $_db;

  function __construct()
  {
    $this->_db = DB::getInstance();
  }

  function register_user($fields = array())
  {
    if ($this->_db->insert($fields) ) return true;
    else return false;
  }
}


 ?>

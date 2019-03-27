<?php //setuptable.php (with changes)
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);
/*
  $query = "CREATE TABLE test_table (
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    type     VARCHAR(10) NOT NULL
  )";

  $result = $connection->query($query);
  if (!$result) die($connection->error);
*/
  $salt1    = "qm&h*";
  $salt2    = "pg!@";

  $type     = 'user';
  $username = 'bsmith';
  $password = 'mysecret';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $username, $token, $type );

  $type     = 'user';
  $username = 'pjones';
  $password = 'acrobat';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $username, $token, $type);

  $type     = 'admin';
  $username = 'admin';
  $password = 'admin';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $username, $token, $type);

  echo 'Table lab4_users created and populated';
  $connection->close();

  function add_user($connection, $un, $pw, $ty )
  {
    $query  = "INSERT INTO test_table (username, password, type) "
            . "VALUES( '$un', '$pw', '$ty')";
    $result = $connection->query($query);
    if (!$result) die($connection->error);
  }
?>

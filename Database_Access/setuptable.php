<?php //setuptable.php (with changes)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'login.php';
$connection = new mysqli($hn, $un, $pw, $db);

if ($connection->connect_error) die($connection->connect_error);
/*
$query = "CREATE TABLE game_table (
    gameID VARCHAR(50) NOT NULL,
    numPlayers int NOT NULL,
    PRIMARY KEY (gameID)
  )";

$result = $connection->query($query);
if (!$result) die($connection->error);*/

$query = "CREATE TABLE account_table (
    username VARCHAR(50) NOT NULL, 
    password VARCHAR(50) NOT NULL,
    type     VARCHAR(10) NOT NULL,
    charID   VARCHAR(50) NOT NULL,
    gameID   VARCHAR(50) NOT NULL
  )";

$result = $connection->query($query);
if (!$result) die($connection->error);

$query = "CREATE TABLE character_table (
    charID   VARCHAR(50) NOT NULL,
    level    INT         NOT NULL,
    bGround  VARCHAR(300) NOT NULL,
    charInfoString VARCHAR(2000) NOT NULL
  )";

$result = $connection->query($query);
if (!$result) die($connection->error);


/*$salt1    = "qm&h*";
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
}*/
?>

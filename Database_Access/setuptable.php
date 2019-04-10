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
/*$password = 'testpassword1';
$salt1 = "dcsp15";
$salt2 = "51pscd";

$PassCheck = hash('ripemd128', "$salt1$password$salt2");

$query = "INSERT INTO account_table( username, password, type, charID, gameID )
          VALUES ('testuser1', '$PassCheck', 'player', 'jbp371', 'group15');
  ";

$result = $connection->query($query);
if (!$result) die($connection->error);*/
/*
$query = "CREATE TABLE character_table (
    charID   VARCHAR(50) NOT NULL,
    level    INT         NOT NULL,
    bGround  VARCHAR(300) NOT NULL,
    charInfoString VARCHAR(2000) NOT NULL
  )";

$result = $connection->query($query);
if (!$result) die($connection->error);*/


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

require_once "../classes/Game.php";

$testgame = NEW Game("MichaelHawk", "jim", 3, "This is the big test, please work", true)

?>

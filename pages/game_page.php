<!--Perhaps the admin and player pages should be merged?-->

<!DOCTYPE html>
<html lang="en-us">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <title>View Game</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['game'])){
    $tempGame = unserialize($_SESSION['game']);

    $username = $tempGame->GMusername;
    $gameDescription = $tempGame->gameDescription;
    $_SESSION['username'] = $username;
    $_SESSION['type'] = "admin";

}
elseif(isset($_SESSION['username']) && isset($_SESSION['type'])){
    $username = $_SESSION['username'];

    require_once '../Database_Access/login.php';

    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die($connection->connect_error);

    $query = "SELECT gameID FROM account_table WHERE username = '$username';";

    $result = $connection->query($query);
    $rows = $result->fetch_array(MYSQLI_ASSOC);
    $gameID = $rows['gameID'];
    $query = "SELECT gameDescription FROM game_table WHERE gameID = '$gameID'";
    $result = $connection->query($query);
    $rows = $result->fetch_array(MYSQLI_ASSOC);
    $gameDescription = $rows['gameDescription'];

}



//Present in a table
// character name, description


// Test commit mark
require_once("../classes/Character.php");
$users = [];
$character1 = "";
$character2 = "";
$character3= "";
$character4 = "";
$game_master = "";
$game_id = "";
echo $character1;
echo $character2;
echo $character3;
echo $character4;
echo $game_master;
echo $game_id;
?>
</body>
</html>
<!--Perhaps the admin and player pages should be merged?-->

<!DOCTYPE html>
<html lang="en-us">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <style>
        .content {
            width: 1024px;
        }

        td {
            padding: 1em 1em 1em 1em;
        }
        th, td {
            background: black;
        }
        body{
            background: black;
        }
        table {
            background: white;
            width: 100%;
        }

        th {

            height: 50px;
        }

    </style>
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

    require_once '../Database_Access/login.php';

    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die($connection->connect_error);

    $query = "SELECT username, charID FROM account_table WHERE type = 'player' AND gameID = '$gameID' AND username <> '$username';";
    $result = $connection->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo '<p>'.$gameDescription.'</p>';

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $charID = $row['charID'];
        $query = "SELECT charClass FROM character_table WHERE charID = '$charID';";
        $charClassResult = $connection->query($query);
        $charClassResult = $charClassResult->fetch_array(MYSQLI_ASSOC);
        $tempClass = unserialize($charClassResult['charClass']);

        echo '<tr>';
        $value = $row['username'];
        echo "<td>" . $value . "</td>";
        $value = $tempClass->level;
        echo "<td>" . $value . "</td>";
        $value = $tempClass->name;
        echo "<td>" . $value . "</td>";
        echo '</tr>';

    }

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

    $query = "SELECT username, charID FROM account_table WHERE type = 'player' AND gameID = '$gameID' AND username <> '$username';";
    $result = $connection->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo '<p>'.$gameDescription.'</p>';

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $charID = $row['charID'];
        $query = "SELECT charClass FROM character_table WHERE charID = '$charID';";
        $charClassResult = $connection->query($query);
        $charClassResult = $charClassResult->fetch_array(MYSQLI_ASSOC);
        $tempClass = unserialize($charClassResult['charClass']);

        echo '<tr>';
        $value = $row['username'];
        echo "<td>" . $value . "</td>";
        $value = $tempClass->level;
        echo "<td>" . $value . "</td>";
        $value = $tempClass->name;
        echo "<td>" . $value . "</td>";
        echo '</tr>';

    }



}
else{
    header("../pages/login_page.php");
}


        ?>
    </table>
</div>
</body>

</html>
    <?php


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
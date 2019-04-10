<!DOCTYPE html>
<html lang="en">
<head>
    <title>Game Page</title>
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




$ID = $_GET["id"];
echo ''. $ID . '';
echo 'Players, Usernames and levels are listed Below';


?>



<div class="content">


<table>
    <tr>
        <th>Username</th>
        <th>Character Name</th>
        <th>Character Level</th>
    </tr>
    <?php
    for(($i = 0);($i<4);($i++))
    {
        echo "<tr>";
        echo "<td>Username</td>";
        echo "<td>Character Name</td>";
        echo "<td>Character Level</td>";
        echo "</tr>";
    }
    ?>




        <?php






        while($row = $result->fetch_array())
        {
            echo '<tr>';
            $value=$row['users'];
            echo "<td>".$value."</td>" ;
            $value=$row['characters'];
            echo "<td>".$value."</td>" ;
            $value=$row['levels'];
            echo "<td>".$value."</td>" ;
            echo '</tr>';
        }


        ?>
    </table>
</div>
</body>

</html>
    <?php


//Present in a table
// character name, description
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



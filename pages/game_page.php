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
<div>

<?php
session_start();

//if(isset($_SESSION['username']) && isset($_SESSION['type']) && isset($_SESSION['gameId'])){
$username = $_SESSION['username'];
$gameID = $_SESSION['gameId'];

require_once '../Database_Access/login.php';

$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die($connection->connect_error);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT gameDescription FROM game_table WHERE gameID = '$gameID';";
$result = $connection->query($query);
$rows = $result->fetch_array(MYSQLI_ASSOC);
$gameDescription = $rows['gameDescription'];


$query = "SELECT username, charID FROM account_table WHERE type = 'player' AND gameID = '$gameID';"; // AND username <> '$username';";
$result = $connection->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);

echo '<p>'.$gameDescription.'</p>';
echo '<table>';
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



//}
//else{
//    header("../pages/login_page.php");
//}


        ?>
    </table>
</div>
</body>
</html>
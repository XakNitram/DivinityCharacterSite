<!--Perhaps the admin and player pages should be merged?-->

<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>DivinityHub</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <link rel="stylesheet" type="text/css" href="../styles/game.css">
</head>
<?php
session_start();
if (!isset($_SESSION['type'])) {
    header("Location: ../pages/login.php");
    exit();
}
$type = $_SESSION['type'];

$username = $_SESSION['username'];
$gameID = $_SESSION['gameId'];

require_once '../Database_Access/login.php';
require_once '../classes/Character.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die($connection->connect_error);
?>
<body>
<!--Head-->
<div class="head">
    <div class="wide-2 head">
        <div class="head-left">
            <h1 class="head">DivinityHub</h1>
            <nav class="head">
                <a class="link" href="game.php">Game</a>
                <?php if ($type != "admin") {
                    echo "<a class='link' href='player.php'>Character</a>";
                }?>
            </nav>
        </div>
        <div class="head-right">
            <nav class="head">
                <a class="link" href="account.php">Account</a>
                <a class="link" href="logout.php">Log Out</a>
            </nav>
        </div>
    </div>
</div>

<!--Content-->
<div class="content">
    <div class="wide-3">
        <h2 class="no-margin">Game ID</h2>
        <hr>
        <div class="wide-2">
            <p>Your game ID is <a class="number"><?php echo $gameID?></a>. This will be used to login.</p>
            <!--71286333-->
        </div>
    </div>
    <div class="wide-3">
        <h2>Game Description</h2>
        <hr>
        <div class="wide-2">
            <?php
                $query = "SELECT gameDescription FROM game_table WHERE gameID = '$gameID';";
                $result = $connection->query($query);
                $rows = $result->fetch_array(MYSQLI_ASSOC);
                $gameDescription = $rows['gameDescription'];
            ?>
            <p><?php echo $gameDescription ?></p>
        </div>
    </div>
    <div class="wide-3">
        <h2>Players</h2>
        <hr>
        <table class="wide-2">
            <tr>
                <th class="w-25">Player</th>
                <th class="w-50">Character</th>
                <?php
                if ($type == 'admin') {
                    echo "<th>Password</th>";
                }
                ?>
            </tr>
            <?php
            $query = "SELECT username, charID, isChanged, password FROM account_table WHERE type = 'player' AND gameID = '$gameID';"; // AND username <> '$username';";
            $result = $connection->query($query);
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $username = $row['username'];
                $charID = $row['charID'];

                // fetch character
                $character = unserialize($connection->query(
                    "SELECT charClass FROM character_table WHERE charID = '$charID';"
                )->fetch_array(
                        MYSQLI_ASSOC)['charClass']
                );

                // display player information
                echo "<tr>";
                echo "<td><a class='number' href='player.php?player=$username'>$username</a></td>";
                echo "<td>$character->name: Level $character->level $character->race</td>";
                if ($type == 'admin') {
                    if ($row['isChanged'] == 0) {
                        $password = $row['password'];
                        echo "<td>$password</td>";
                    } else {
                        echo "<td>hidden</td>";
                    }
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <br class="wide">
    <?php
    if ($type == 'admin') {
        echo "<div class='wide-3'>";
        echo "<h3>Finished Playing?</h3>";
        echo "<hr>";
        echo "<div class=\"wide-2\">";
        echo "<p>End the game <a class=\"number\" href=\"end.php\">here</a>.</p>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
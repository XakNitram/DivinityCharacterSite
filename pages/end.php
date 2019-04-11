<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>End Game</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <style>


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
        input {
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            color: #111111;
            width: calc(100% - 18px);
            /*width: 100%;*/
            border: 2px solid #333333;
            padding: 4px 8px;
        }

        input.button {
            width: 100%;
            background-color: orange;
            font-size: 13px;
            line-height: 29px;
            margin-bottom: 0;
        }
        body {
            background: #000000 url("../images/login.jpg") no-repeat fixed center center;
            background-size: cover;
        }
    </style>
</head>

<div class="content">
<div class="wide-3">


    <h1>End Game?</h1>
    <hr>
    <p>Are you sure you want to end your journey? This will delete all characters.</p>
    <hr>
    <?php
    // require_once "../classes/Game.php"
    session_start();
    if(isset($_POST['submit'])) {
        $gameID = $_SESSION['gameId'];
        require_once '../Database_Access/login.php';

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $connection = new mysqli($hn, $un, $pw, $db);
        if ($connection->connect_error) die($connection->connect_error);
        $query = "SELECT charID FROM account_table WHERE gameID = '$gameID';";
        $result = $connection->query($query);

        $query = "DELETE FROM account_table WHERE gameID = '$gameID';";

        $result1 = $connection->query($query);
        if (!result) {
            echo "Could not delete account from account table, please try again.";
        }
        $query = "DELETE FROM game_table WHERE gameID = '$gameID';";

        $result1 = $connection->query($query);
        if (!result) {
            echo "Could not delete account from account table, please try again.";
        }

        while ($rows = $result->fetch_array(MYSQLI_ASSOC)) {
            $value = $rows['charID'];
            $query = "DELETE FROM character_table WHERE charID = '$rows[$value]';";
            $result2 = $connection->query($query);
        }
        session_unset();
        session_destroy();
        header("Location: ../pages/login.php");
        exit();
    }
    // confirmation page for the "End Game" option.

    // if they confirm the deletion, delete the game and send them back to the login.

    // else send them back to their account page.

    ?>
    <form method="post" action="end.php">



    <div class="buttons">


        <input  class="button" type="submit" name="submit" value="End Game" />
    </div>
    </div>
    </form>
</div>
</body>
</html>

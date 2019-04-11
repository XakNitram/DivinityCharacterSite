<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Create Game</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <link rel="stylesheet" type="text/css" href="../styles/newgame.css">
    <?php
    require_once "../classes/Game.php";


    $gm_username = "";
    $gm_password = "";
    $player_num = "";
    $game_description = "";
    $gm_email = "";
    $errored = false;
    if (isset($_POST["create"])) {
        $gm_username = addslashes(htmlspecialchars($_POST['username']));
        $gm_password = addslashes(htmlspecialchars($_POST['password']));
        $player_num = addslashes(htmlspecialchars($_POST['players']));
        $game_description = addslashes(htmlspecialchars($_POST['description']));

        if (!preg_match('/^[a-zA-Z0-9]+/', $gm_password)) {
            $error = "Incorrect format for password. Password must be letters or numbers with no spaces.";
            $errored = true;
        }

        if (!preg_match('/^[a-zA-Z0-9]+/', $gm_username)) {

            $error = "Incorrect format for username. Username must be letters or numbers with no spaces.";
            $errored = true;
        }
        require_once '../Database_Access/login.php';

        $connection = new mysqli($hn, $un, $pw, $db);
        if ($connection->connect_error) die($connection->connect_error);

        $query = "SELECT * FROM account_table WHERE username = '$gm_username';";
        $result = $connection->query($query);

        if($result->num_rows > 0){
            $error = "Username is taken, please try another.";
            $errored = true;
        }


        if (!$errored) {
            require_once "../classes/Game.php";
            $newGame = NEW Game($gm_username, $gm_password, $player_num, $game_description, true);
            $infoString = $newGame->playerInfoString;
            session_start();
            $_SESSION['username'] = $newGame->GMusername;
            $_SESSION['type'] = 'admin';
            $_SESSION['gameId'] = $newGame->ID;

            header("Location: ../pages/game.php");
        }
    }
    ?>
</head>
<body>
<div class="content">
    <form method="post" action="new.php">
        <div class="wide-3">
            <h1>Create Game</h1>
            <hr>
            <div class="section">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username">
            </div>
            <div class="section">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password">
            </div>
            <div class="error padded" <?php if (!$errored) {echo "style=\"display: none;\"";} ?>>
                <div>
                    <span> <?php echo $error ?> </span>
                </div>
            </div>
            <div class="section">
                <label for="players">Number of Players:</label><br>
                <select id="players" name="players">
                    <option value="1" selected="selected">One</option>
                    <option value="2" >Two</option>
                    <option value="3" >Three</option>
                    <option value="4" >Four</option>
                </select>
            </div>
            <div class="section">
                <label for="description">Game Description:</label><br>
                <textarea id="description" name="description" maxlength="1024" rows="8"></textarea>
            </div>
            <div></div>
            <div>
                <input class="button" type="submit" name="create" value="Create">
            </div>
        </div>
    </form>
</div>
</body>
</html>
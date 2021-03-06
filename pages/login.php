<!--Perhaps the admin and login pages should be merged?-->
<!--Tate Mioton-->
<!--Jesse Parker-->
<!--Austin Pace-->
<!--Tate Againoton -->
<!--jim-->

<!DOCTYPE html>
<html lang="en-us">
<?php
// imports here
session_start();
if (isset($_SESSION['username']) && false) {
    $type = $_SESSION['type'];
    if ($type == 'admin') {
        header('Location: game.php');
        exit();
    }
    else {
        header('Location: game.php');
        exit();
    }
}
?>
<head>
    <title>DivinityHub</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
</head>
<body>
<div class="content">
    <div class="wide-3">
        <h1>Sign in</h1>
        <hr>
        <br>
        <?php
        $username = "";
        $password = "";
        $gameId = "";

        $errorMsg = "";
        $showError = false;

        if (isset($_POST["sign_in"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $gameId = $_POST["gameId"];


            # get information from database here.

            if(!preg_match('/^[A-Za-z0-9]+$/', $password) OR !preg_match('/^[A-Za-z0-9]+$/', $username) OR
                !preg_match('/^[A-Za-z0-9]+$/', $gameId)){
                $errorMsg = "incorrect format for username ,password, or game ID, must be letters or numbers with no spaces.";
                $showError = true;
            }

            else {



                require_once '../Database_Access/login.php';

                $connection = new mysqli($hn, $un, $pw, $db);
                if ($connection->connect_error) die($connection->connect_error);

                $query = "SELECT * FROM account_table WHERE username = '$username' AND gameID = '$gameId';";

                $result = $connection->query($query);

                if ($result->num_rows === 0) {
                    $errorMsg = "Incorrect Username or Password, please verify and resubmit.";
                    $showError = true;
                }


                else{

                    $rows = $result->fetch_array(MYSQLI_ASSOC);

                    if($rows['isChanged'] == 1){
                        $salt1 = "dcspg15";
                        $salt2 = "51gpscd";

                        $PassCheck = hash('ripemd128', "$salt1$password$salt2");
                    }
                    else{
                        $PassCheck = $password;
                    }

                    $query = "SELECT * FROM account_table WHERE password = '$PassCheck' AND username = '$username' AND gameID = '$gameId';";
                    $result = $connection->query($query);
                    $rows = $result->fetch_array(MYSQLI_ASSOC);

                    if ($result->num_rows === 0) {
                        $errorMsg = "Incorrect Username or Password, please verify and resubmit.";
                        $showError = true;
                    }
                    else {
                        $type = $rows['type'];
                        $charID = $rows['charID'];

                        $query = "SELECT charClass FROM character_table WHERE charID = '$charID';";

                        $result = $connection->query($query);
                        $rows = $result->fetch_array(MYSQLI_ASSOC);

                        $charClass = $rows['charClass'];

                        require_once "../classes/Character.php";


                        $_SESSION['character'] = $charClass;
                        $_SESSION['username'] = $username;
                        $_SESSION['gameId'] = $gameId;
                        $_SESSION['type'] = $type;


                        header('Location: game.php');
                        exit();
                    }
                }
            }
        }
        ?>

        <form method="post" action="login.php" style="margin-bottom: 100px">
            <div class="padded">
                <!-- Game ID Section-->
                <div class="forgot">
                    <label for="gameId">Game ID:</label>
                    <a href="login.php?f=id">Forgot ID?</a>
                </div>
                <input
                        type="text"
                        id="gameId"
                        name="gameId"
                        autocomplete="off"
                        value="<?php echo $gameId ?>"
                >
            </div>
            <div class="padded">
                <div class="forgot">
                    <label for="username">Username:</label>
                    <a href="login.php?f=pass">Forgot username?</a>
                </div>
                <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?php echo $username ?>"
                >
            </div>
            <div class="padded">
                <div class="forgot">
                    <label for="password">Password:</label>
                    <a href="login.php?f=name">Forgot password?</a>
                </div>
                <input
                        type="password"
                        id="password"
                        name="password"
                        value="<?php echo $password ?>"
                >
            </div>
            <div class="error padded" <?php if (!$showError) {echo "style=\"display: none;\"";} ?>>
                <div>
                    <span> <?php echo $errorMsg ?> </span>
                </div>
            </div>
            <input class="button" type="submit" name="sign_in" value="Sign in">
        </form>
        <div class="padded">
            <h5 style="margin-bottom: 0">Starting a campaign?</h5>
            <hr style="margin-bottom: 10px; margin-top: 2px;">
        </div>
        <form action="new.php" method="post">
            <input class="button" type="submit" name="create_game" value="Create game">
        </form>
    </div>
</div>
</body>
</html>
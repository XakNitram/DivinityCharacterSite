<!DOCTYPE html>
<html lang="en-us">
<?php
// imports here
session_start();
if (isset($_SESSION['username']) && false) {
    $type = $_SESSION['type'];
    if ($type == 'admin') {
        header('Location: admin_page.php');
        exit();
    }
    else {
        header('Location: player_page.php');
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
<section class="content">
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
            $type = 'player';

            # get information from database here.

            if ($username != "") {
                $errorMsg = "";
                $showError = false;

                $_SESSION['username'] = $username;
                $_SESSION['gameId']   = $gameId;
                $_SESSION['type']     = $type;

                if ($type == 'admin') {
                    header('Location: admin_page.php');
                    exit();
                }
                else {
                    header('Location: player_page.php');
                    exit();
                }
            }
            else {
                $errorMsg = "An error occurred.";
                $showError = true;
            }
        }
        ?>

        <form method="post" action="login_page.php" style="margin-bottom: 100px">
            <div class="padded">
                <!-- Game ID Section-->
                <div class="forgot">
                    <label for="gameId">Game ID:</label>
                    <a href="login_page.php?f=id">Forgot ID?</a>
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
                    <a href="login_page.php?f=pass">Forgot username?</a>
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
                    <a href="login_page.php?f=name">Forgot password?</a>
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
        <form action="login_page.php" method="post">
            <input class="button" type="submit" name="create_game" value="Create game">
        </form>
    </div>
</section>
</body>
</html>
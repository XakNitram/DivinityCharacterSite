<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['type'])) {
        header("Location: ../pages/login.php");
        exit();
    }
    $type = $_SESSION['type'];

    $oldUsername = $_SESSION['username'];

    if (isset($_POST['save'])) {
        $newPassword = addslashes(htmlspecialchars($_POST['password']));
        if (!preg_match('/^[A-Za-z0-9]+$/', $newPassword) and $newPassword != '') {
            $errored = true;
            $error = 'Incorrect format for password. Must be letters or numbers with no spaces.';
        }

        $newUsername = addslashes(htmlspecialchars($_POST['username']));
        if (!preg_match('/^[A-Za-z0-9]+$/', $newUsername) and $newUsername != '') {
            $errored = true;
            $error = 'Incorrect format for username. Must be letters or numbers with no spaces.';
        }

        if(!$errored) {
            if ($newPassword != '') {
                $salt1 = 'dcspg15';
                $salt2 = '51gpscd';

                $newPassword = hash('ripemd128', "$salt1$newPassword$salt2");
                require_once '../Database_Access/login.php';

                $connection = new mysqli($hn, $un, $pw, $db);
                if ($connection->connect_error) die($connection->connect_error);

                $query = "UPDATE account_table
                          SET password = '$newPassword', isChanged = 1
                          WHERE username = '$oldUsername';";

                $result = $connection->query($query);
            }

            if ($newUsername != '') {
                require_once '../Database_Access/login.php';

                $connection = new mysqli($hn, $un, $pw, $db);
                if ($connection->connect_error) die($connection->connect_error);

                $query = "SELECT * FROM account_table WHERE username = '$newUsername';";
                $result = $connection->query($query);

                if ($result->num_rows > 0) {
                    $error = "Username is taken, please try another.";
                    $errored = true;
                } else {
                    $query = "UPDATE account_table
                      SET username = '$newUsername'
                      WHERE username = '$oldUsername';";

                    $result = $connection->query($query);
                    $_SESSION['username'] = $newUsername;
                }
            }

            header("Location: ../pages/game.php");
            exit();
        }
    }
    elseif (isset($_POST['cancel'])) {
        header("Location: ../pages/game.php");
        exit();
    }


    ?>
    <title>DivinityHub</title>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/account.css">
</head>
<body>
<!--Head-->
<div class="head">
    <div class="wide-2 head">
        <div class="head-left">
            <h1 class="head">DivinityHub</h1>
            <nav class="head">
                <a class="link" href="game.php">Game</a>
                <?php if ($type != "admin") {echo "<a class=\"link\" href=\"player.php\">Character</a>";}?>
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
    <form method="post" action="account.php">
        <div class="wide-3">
            <!--Header-->
            <h1>Edit Account</h1>
            <hr>

            <!--Username-->
            <div class="section w-100">
                <label for="username">New Username:</label><br>
                <input type="text" name="username" id="username" value="<?php echo $newUsername ?>"><br>
            </div>

            <!--Password-->
            <div class="section w-100">
                <label for="password">New Password:</label><br>
                <input type="password" name="password" id="password" value="<?php echo $newPassword ?>"><br>
            </div>

            <div class="error padded" <?php if (!$errored) {echo "style=\"display: none;\"";} ?>>
                <div>
                    <span> <?php echo $error ?> </span>
                </div>
            </div>

            <!--Submitting-->
            <div class="col-container w-100">
                <div class="col w-50">
                    <input class="button" type="submit" name="save" value="Save">
                </div>
                <div class="col w-50">
                    <input class="button" type="submit" name="cancel" value="Cancel">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
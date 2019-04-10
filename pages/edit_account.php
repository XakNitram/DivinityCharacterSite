<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php
    session_start();
    $oldUsername = $_SESSION['username'];
    require_once "../classes/Account.php";

    if (isset($_POST['save'])) {

        if(isset($_POST['password'])) {
            $newPassword = $_POST['password'];

            require_once '../Database_Access/login.php';

            $connection = new mysqli($hn, $un, $pw, $db);
            if ($connection->connect_error) die($connection->connect_error);

            $query = "UPDATE account_table
              SET username = '$tempchar'
              WHERE username = '$newPassword';";

            $result = $connection->query($query);

        }
        if(isset($_POST['username'])) {
            $newUsername = $_POST['username'];

            require_once '../Database_Access/login.php';

            $connection = new mysqli($hn, $un, $pw, $db);
            if ($connection->connect_error) die($connection->connect_error);

            $query = "UPDATE account_table
                      SET username = '$newUsername'
                      WHERE username = '$oldUsername';";

            $result = $connection->query($query);

        }
        header("Location: ../pages/login_page.php");
        exit();



    }


    ?>
    <title>DivinityHub</title>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/account.css">
</head>
<body>
<div class="content">
    <form method="post" action="../pages/edit_account.php">
        <div class="wide-3">
            <!--Header-->
            <h1>Edit Account</h1>
            <hr>

            <!--Username-->
            <div class="section w-100">
                <label for="username">New Username:</label><br>
                <input name="username" id="username"><br>
            </div>

            <!--Password-->
            <div class="section w-100">
                <label for="password">New Password:</label><br>
                <input name="password" id="password"><br>
            </div>

            <!--Submitting-->
            <input class="button" type="submit" name="save" value="Save">
        </div>
    </form>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php

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
            <div class="wide-2">
                <p>Change your username and password here.</p>
            </div>
            <hr>

            <!--Username-->
            <div class="section w-100">
                <label for="username">Username:</label><br>
                <input name="username" id="username"><br>
            </div>

            <!--Password-->
            <div class="section w-100">
                <label for="password">Password:</label><br>
                <input name="password" id="password"><br>
            </div>

            <!--Submitting-->
            <input class="button" type="submit" name="save" value="Save">
        </div>
    </form>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>DivinityHub</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <style>
        body {
            background: #000000;
        }

        a {
            color: #ffa500;
        }
    </style>
</head>
<body>
<?php
    session_unset();
    session_destroy();
?>
<div class="content">
    <div class="wide-3" style="height: 500px">
        <h3>Logout Successful.</h3>
        <hr>
        <p class="wide-3">Return to <a href="login_page.php">login page</a></p>
    </div>
</div>
</body>
</html>
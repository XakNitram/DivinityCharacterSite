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

    // confirmation page for the "End Game" option.

    // if they confirm the deletion, delete the game and send them back to the login.

    // else send them back to their account page.

    ?>
    <form method="post" action="end_game.php">



    <div class="buttons">


        <input  class="button" type="submit" name="submit" value="End Game" />
    </div>
    </div>
    </form>
</div>
</body>
</html>

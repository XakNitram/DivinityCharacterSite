<!DOCTYPE html>
<html lang="en-us">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <title>End Game</title>
    <style>
        select, option, input {
            color: black;
        }


    </style>
</head>
<body>

<div id="form_container">

    <h1><a>Create Game</a></h1>
    <form method="post" action="create_game.php" style="margin-bottom: 100px">

        <div class="content">
            <h2>Create Game</h2>
            <p>Choose the amount of Players</p>




                <label class="description" for="element_1"> </label>
                <div class=" wide-3">
                    <select class="" id="player_num" name="player_num">

                        <option value="1" selected="selected">One</option>
                        <option value="2" >Two</option>
                        <option value="3" >Three</option>
                        <option value="4" >Four</option>

                    </select>

                <div class="padded">
                    <label class="description" for="gm_password">Enter your Desired Password </label>
                    <div>
                        <input id="gm_password" name="gm_password" type="password" class="element text medium"  maxlength="255" value=""/>
                        <?php
                        echo $passError;
                        ?>
                    </div>
                </div>
        <div class="padded">
            <label class="description" for="gm_password">Enter your Email </label>

            <div>
                <input id="gm_email" name="gm_email" class="element text medium" type="text" maxlength="255" value=""/>
                <?php

                echo $email_error;
                ?>
            </div>
        </div>

            <div class="buttons">>


                <input  class="button" type="submit" name="submit" value="Submit Game" />
            </div>

        </div>
        </div>
    </form>
    <?php
    $gm_email = "";
    $gm_password = "";
    $player_num = "";

    $email_error = "";
    $passError = "";
    $showError = false;

    if (isset($_POST["submit"])) {
        $gm_email = $_POST["gm_email"];
        $player_num = $_POST["player_num"];
        $gm_password = $_POST["gm_password"];


        # get information from database here.
        if (!preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9.]*[a-zA-Z0-9]+.[a-z0-9A-Z]+$/', $gm_email)) {
            $email_error = "Must be valid email";

        }
        if (!preg_match('[a-zA-Z0-9]+', $gm_password)) {
            $passError = "incorrect format for password, must be letters or numbers with no spaces.";
            $showError = true;
        }
    }
    ?>

</body>
</html>
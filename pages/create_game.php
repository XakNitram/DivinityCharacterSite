<!DOCTYPE html>
<html lang="en-us">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <title>Create Game</title>
    <style>
        select, option, input, textarea {
            color: black;
        }
        <?php
require_once "../classes/Game.php";


    $gm_username = "";
    $gm_email = "";
    $gm_password = "";
    $player_num = "";
    $game_description = "";
    $email_error = "";
    $passError = "";
    $showError = false;
    $usernameError= "";
    $description_error = "";
    if (isset($_POST["submit"])) {
        $gm_username = $_POST["gm_username"];
        $gm_email = $_POST["gm_email"];
        $player_num = $_POST["player_num"];
        $gm_password = $_POST["gm_password"];
        $game_description = "";

        # get information from database here.
        if (!preg_match('/^[A-Za-z0-9]+@[A-Za-z0-9]+.[A-Za-z]+$/', $gm_email)) {
            $email_error = "Must be valid email";

            //'/^[a-zA-Z0-9]+@[a-zA-Z0-9.]*[a-zA-Z0-9]+.[a-z0-9A-Z]+$/'
        }
        if (!preg_match('/^[a-zA-Z0-9]+/', $gm_password)) {
            $passError = "incorrect format for password, must be letters or numbers with no spaces.";

        }
        if (!preg_match('/^[a-zA-Z0-9]+/', $gm_username)) {
            $usernameError = "incorrect format for username, must be letters or numbers with no spaces.";

        }
        if (!preg_match('/^[a-zA-Z0-9. ]*/', $game_description)){
            $description_error = "Description is suspicious, please watch your use of special characters such as \";\", \"'\", etc.";
        }


    }





 ?>

    </style>
</head>
<body>

<div id="form_container">

    <h1><a>Create Game</a></h1>
    <form method="post" action="create_game.php" style="margin-bottom: 100px">

        <div class="content">
            <h2>Create Game</h2>





                <label class="description" for="element_1"> </label>
                <div class=" wide-3">

                    <div class="padded">
                        <label class="description" for="gm_username">Enter your Username </label>

                        <div>
                            <input id="gm_username" name="gm_username" class="element text medium" type="text" maxlength="255" value=""/>
                            <?php

                            echo $usernameError;
                            ?>
                        </div>
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
                    <div class="padded">
                        <label class="description" for="game_description">Enter description of Game </label>

                        <div>

                            <textarea id="game_description" name="game_description" class="element text medium" type="text" maxlength="1024" >


                            </textarea>
                            <?php

                            echo $description_error;
                            ?>
                        </div>
                    </div>
                        <p>Choose the amount of Players</p>
                        <select class="" id="player_num" name="player_num">

                            <option value="1" selected="selected">One</option>
                            <option value="2" >Two</option>
                            <option value="3" >Three</option>
                            <option value="4" >Four</option>

                        </select>

            <div class="buttons">


                <input  class="button" type="submit" name="submit" value="Submit Game" />
            </div>

        </div>
        </div>
    </form>
    <?php
        if(isset($_POST['submit'])) {
            if (!$description_error && !$passError && !$email_error && !$usernameError) {
                require_once "../classes/Game.php";
                $newGame = NEW Game($gm_username, $gm_password, $player_num, $game_description, $gm_email, true);

                header("Location: ../pages/game_page.php");
            }
        }

    ?>

</body>
</html>
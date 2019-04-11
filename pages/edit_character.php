<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php

    session_start();
    if (!isset($_SESSION['type'])) {
        header("Location: ../pages/login_page.php");
    }
    $type = $_SESSION['type'];
    if ($type == 'admin') {
        header('Location: ../pages/game_page.php');
        exit();
    }
    $username = $_SESSION['username'];
    require_once "../classes/Character.php";
    $character = unserialize($_SESSION['character']);
    ?>
    <title><?php echo "$character->name ($username) at DivinityHub"; ?></title>
    <link rel="stylesheet" href="../styles/general.css">
    <style>
        body {
            background: black;
        }

        .content {
            width: 1024px;
        }

        .talent-box {
            width: 100%;
            height: 684.5px;
            /*overflow-y: scroll;*/
            overflow: auto;
            /*border: 1px solid #333333;*/
        }

        .talent {
            margin: 8px 8px 12px 8px;
            padding: 8px;
            border: 1px solid #ffa500;
            box-shadow:  -1px 1px #ffa500,
            -2px 2px #ffa500,
            -3px 3px #ffa500
        }

        .talent-off {
            margin: 8px 8px 12px 8px;
            padding: 8px;
            border: 1px solid #333333;
            box-shadow:  -1px 1px #333333,
            -2px 2px #333333,
            -3px 3px #333333;
        }

        label.h2 {
            font-size: 1.5em;
        }

        input.h2 {
            font-size: 1.5em;
        }

        label.h3 {
            font-size: 1.3em;
        }

        input.h3 {
            font-size: 1.3em;
        }

        label, a {
            font-size: 13px;
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
            font-size: 13px;
        }

        input.button {
            width: 100%;
            background-color: orange;
            font-size: 13px;
            line-height: 29px;
            margin-bottom: 0;
        }

        textarea {
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            color: #111111;
            width: calc(100% - 18px);
            border: 2px solid #333333;
            padding: 4px 8px;
            font-size: 13px;
            resize: none
        }

        input.name {
            width: 256px;
        }

        input.number {
            width: 32px;
        }

        input.inc-button {
            background-color: orange;
            text-align: center;
        }

        h3, h4, p {
            margin-top: 0;
            margin-bottom: 0;
        }

        p {
            font-size: 16px;
        }

        hr {
            margin-top: 2px;
            width: 100%;
        }

        div.section {
            margin-bottom: 8px;
            margin-left: 8px;
        }
    </style>
</head>
<body>
<?php
if (isset($_POST['save'])) {
    // save
    // non-looping
    $character->name = htmlspecialchars($_POST['name']);
    $character->level = intval(htmlspecialchars($_POST['level']));
    $character->talents = intval(htmlspecialchars($_POST['talents']));
    $character->background = htmlspecialchars($_POST['background']);

    foreach ($abilities as $name) {
        $post_id = strtolower(str_replace(' ', '', $name));
        $character->setAbility($name, intval(htmlspecialchars($_POST[$post_id])));
    }
    unset($name);

    foreach ($attributes as $name) {
        $post_id = strtolower(str_replace(' ', '', $name));
        $character->setAttribute($name, intval(htmlspecialchars($_POST[$post_id])));
    }
    unset($name);

    // Update Session and Database
    $_SESSION['character'] = serialize($character);
    $tempchar = serialize($character);
    require_once '../Database_Access/login.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die($connection->connect_error);

    $query = "SELECT charID FROM account_table WHERE username = '$username';";

    $result = $connection->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $charID = $row['charID'];

    $query = "UPDATE character_table
              SET charClass = '$tempchar'
              WHERE charID = '$charID';";

    $result = $connection->query($query);

    if(!$result) echo "could not update character info, please try again.";

    header("Location: ../pages/player_page.php");
    exit();
}
elseif (isset($_POST['cancel'])) {
    header("Location: ../pages/player_page.php");
    exit();
}
?>
<!--Head-->
<div class="head">
    <div class="wide-2 head">
        <div class="head-left">
            <h1 class="head">DivinityHub</h1>
            <nav class="head">
                <a class="link" href="game_page.php">Game</a>
                <?php if ($type != "admin") {echo "<a class=\"link\" href=\"player_page.php\">Character</a>";}?>
            </nav>
        </div>
        <div class="head-right">
            <nav class="head">
                <a class="link" href="edit_account.php">Account</a>
                <a class="link" href="logout_page.php">Log Out</a>
            </nav>
        </div>
    </div>
</div>

<!--Content-->
<div class="content">
    <form method="post" action="../pages/edit_character.php" name="edit">
    <div class="wide-4">
        <!--Names-->
        <div class="wide-2">
            <h1><?php echo $username ?></h1>

            <input
                    class="name h2" id="name" type="text"
                    value="<?php echo $character->name?>"
                    maxlength="32"
                    name="name"
            >
            <br>
            <input
                    class="name h3" id="level" type="number"
                    max="50" value="<?php echo $character->level ?>"
                    name="level"
            >
        </div>

        <!--Background-->
        <div class="wide-2">
            <h3>Background</h3>
            <hr>
            <textarea id="background" name="background" rows="4"><?php echo $character->background ?></textarea>
        </div>

        <!--Abilities, Attributes, and Talents-->
        <div class="col-container">
            <!--Abilities-->
            <div class="col w-50 wide-2">
                <h3>Combat Abilities</h3>
                <hr>
                <?php
                $combatAbilities = array(
                    "Weapons" => $weaponCombatAbilityNames,
                    "Defence" => $defenceCombatAbilityNames,
                    "Skills"  => $skillCombatAbilityNames
                );

                foreach ($combatAbilities as $key => $section) {
                    echo "<h4>$key</h4>";
                    echo "<div class='section'>";
                    foreach ($section as $skill) {
                        $value = $character->getAbility($skill);
                        echo '<div class="col-container">';

                        $desc = addslashes($abilityDescriptions[$skill]);
                        $div_id = $skill . "_inc";
                        $post_id = strtolower(str_replace(' ', '', $skill));
                        echo    "<div class='col w-75' id='$div_id' onclick=\"showAbilityDescription('$skill', '$desc')\">";
                        echo        "<p>$skill</p>";
                        echo    "</div>";

                        echo    "<div class=\"col w-25\">";
                        echo        "<div class='col-container'>";
                        echo            "<input name='$post_id' id='$skill' type='text' class='col number' value='$value' readonly='true'>";
                        echo            "<input class='col inc-button' type='button' value='+' onclick=\"add('$skill', 20)\">";
                        echo            "<input class='col inc-button' type='button' value='-' onclick=\"minus('$skill', 0)\">";
                        echo        "</div>";
                        echo    "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
                ?>

                <h3>Civil Abilities</h3>
                <hr>
                <?php
                $civilAbilities = array(
                    "Personality"=>$personalityCivilAbilities,
                    "Craftsmanship"=>$craftingCivilAbilities,
                    "Nasty Deeds"=>$nastyCivilAbilities
                );
                foreach ($civilAbilities as $key => $section) {
                    echo "<h4>$key</h4>";
                    echo '<div class="section">';
                    foreach ($section as $skill) {
                        $value = $character->getAbility($skill);
                        echo '<div class="col-container">';

                        $desc = addslashes($abilityDescriptions[$skill]);
                        $div_id = $skill . "_inc";
                        $post_id = strtolower(str_replace(' ', '', $skill));
                        echo    "<div class='col w-75' id='$div_id' onclick=\"showAbilityDescription('$skill', '$desc')\">";
                        echo        "<p>$skill</p>";
                        echo    "</div>";

                        echo    "<div class=\"col w-25\">";
                        echo        "<div class='col-container'>";
                        echo            "<input name='$post_id' id='$skill' type='text' class='col number' value='$value' readonly='true'>";
                        echo            "<input class='col inc-button' type='button' value='+' onclick=\"add('$skill', 20)\">";
                        echo            "<input class='col inc-button' type='button' value='-' onclick=\"minus('$skill', 0)\">";
                        echo        "</div>";
                        echo    "</div>";
                        echo "</div>";
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <!--Attributes and Talents-->
            <div class="col w-50 wide-2">
                <h3>Attributes</h3>
                <hr>
                <?php
                foreach ($attributes as $name) {
                    $value = $character->getAttribute($name);
                    echo '<div class="col-container">';

                    $div_id = $name . "_inc";
                    $post_id = strtolower(str_replace(' ', '', $name));
                    $desc = addslashes($attributeDescriptions[$name]);
                    echo    "<div class=\"col w-75\" id=\"$div_id\" onclick=\"showAbilityDescription('$name', '$desc')\">";
                    echo        "<p>$name</p>";
                    echo    "</div>";

                    echo    "<div class=\"col w-25\">";
                    echo        "<div class='col-container'>";
                    echo            "<input name='$post_id' id='$name' type='text' class='col number' value='$value' readonly='true'>";
                    echo            "<input class='col inc-button' type='button' value='+' onclick=\"add('$name', 70)\">";
                    echo            "<input class='col inc-button' type='button' value='-' onclick=\"minus('$name', 10)\">";
                    echo        "</div>";
                    echo    "</div>";
                    echo "</div>";
                }
                unset($name);
                unset($skills);

                ?>
                <br>
                <h3>Talents</h3>
                <hr>
                <input name="talents" id="talents" type="text" value="<?php echo $character->talents ?>" hidden>
                <div class="talent-box">
                    <?php
                    $talentHaves = array();
                    $talentHaveNots = array();
                    foreach ($talentCodes as $name => $code) {
                        if ($character->hasTalent($code)) {
                            array_push($talentHaves, $name);

                        }
                        else {
                            array_push($talentHaveNots, $name);
                        }
                    }

                    // unset loop variables
                    // apparently php does not purge
                    // variables after the loop ends.
                    unset($name);
                    unset($code);

                    $skippedFirst = false;
                    foreach ($talentHaves as $name) {
                        $name = addslashes($name);
                        if (!$skippedFirst) {
                            $style = "style='margin-top: 0'";
                        }
                        else {
                            $style = "";
                        }
                        $desc = addslashes($talentDescriptions[$name]);
                        $code = $talentCodes[$name];
                        $div_id = $name . "_div";
                        $button_id = $name . "_button";
                        echo "<div class='talent bordered' id='$div_id' $style>";
                        echo    "<div class='col-container w-100'>";
                        echo        "<div class='col w-75' onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo            "<h3>$name</h3>";
                        echo        "</div>";
                        echo        "<div class='col w-25'>";
                        echo            "<input id='$button_id' value='Remove' class='inc-button' type='button' onclick=\"setTalent('$name', $code)\">";
                        echo        "</div>";
                        echo    "</div>";
                        echo    "<div class='w-100' id='$name' onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo    "</div>";
                        echo "</div>";
                    }
                    unset($name);

                    foreach ($talentHaveNots as $name) {
                        $name = addslashes($name);
                        if (!$skippedFirst) {
                            $style = "style='margin-top: 0'";
                        }
                        else {
                            $style = "";
                        }
                        $desc = addslashes($talentDescriptions[$name]);
                        $code = $talentCodes[$name];
                        $div_id = $name . "_div";
                        $button_id = $name . "_button";
                        echo "<div class='talent-off bordered' id='$div_id' $style>";
                        echo    "<div class='col-container w-100'>";
                        echo        "<div class='col w-75' onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo            "<h3>$name</h3>";
                        echo        "</div>";
                        echo        "<div class='col w-25'>";
                        echo            "<input id='$button_id' value='Add' class='inc-button' type='button' onclick=\"setTalent('$name', $code)\">";
                        echo        "</div>";
                        echo    "</div>";
                        echo    "<div class='w-100' id='$name' onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo    "</div>";
                        echo "</div>";
                    }
                    unset($name);
                    unset($desc);
                    unset($talentHaves);
                    unset($talentHaveNots);
                    ?>
                </div>
            </div>
        </div>
        <br>
        <div>
            <div class="col-container w-100">
                <div class="col w-50">
                    <input type="submit" value="Save" name="save" class="button">
                </div>
                <div class="col w-50">
                    <input type="submit" name="cancel" value="Cancel" class="button">
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    let showingTalentDesc = false;
    let backTalentID;

    let htmlTStart  = "<hr><p>";
    let htmlTEnd    = "</p>";

    function showTalentDescription(id, description) {
        // close old description
        if (showingTalentDesc) {
            if (id !== backTalentID) {
                document.getElementById(backTalentID).innerHTML = "";
                showingTalentDesc = false;
            }
            else {
                document.getElementById(id).innerHTML = "";
                showingTalentDesc = false;
                return;
            }
        }

        // show new description
        document.getElementById(id).innerHTML = htmlTStart + description + htmlTEnd;
        backTalentID = id;
        showingTalentDesc = true;
    }

    let showingAbilityDesc = false;
    let backAbilityID;

    // 9769 - Cross
    let htmlAStart  = "<div class='wide-2 no-margin'><p>&#9769 ";
    let htmlAMiddle = "</p><hr><div class='wide-2'><p class='no-margin'>";
    let htmlAEnd    = "</p></div></div>";

    function showAbilityDescription(id, description) {
        // close old description
        if (showingAbilityDesc) {
            if (id !== backAbilityID) {
                document.getElementById(backAbilityID + "_div").innerHTML = "<p>" + backAbilityID + "</p>";
                // document.getElementById(backAbilityID).classList.remove("bordered");
                showingAbilityDesc = false;
            }
            else {
                document.getElementById(id + "_div").innerHTML = "<p>" + id + "</p>";
                // document.getElementById(id).classList.remove("bordered");
                showingAbilityDesc = false;
                return;
            }
        }

        //show new ability description
        document.getElementById(id + "_div").innerHTML = htmlAStart + id + htmlAMiddle + description + htmlAEnd;

        // document.getElementById(id).classList.add("bordered");
        backAbilityID = id;
        showingAbilityDesc = true;
    }

    let id_array = [];

    function add(id, max) {
        let value = id_array[id];
        if (value === undefined) {
            value = document.getElementById(id).value;
        }

        if (value < max) {
            value++;
        }
        else {
            value = max;
        }
        document.getElementById(id).value = value;
        id_array[id] = value;
    }

    function minus(id, min){
        let value = id_array[id];
        if (value === undefined) {
            value = document.getElementById(id).value;
        }

        if (value > min) {
            value--;
        }
        else {
            value = min;
        }

        document.getElementById(id).value = value;
        id_array[id] = value;
    }

    function setTalent(id, code) {
        let talents = document.getElementById('talents');
        let item = document.getElementById(id + "_div");

        if (item.classList.contains('talent-off')) {
            item.classList.remove('talent-off');
            item.classList.add('talent');
            console.log(talents.value);
            talents.value = parseInt(talents.value) + code;
            document.getElementById(id + "_button").value = "Remove";
        }
        else if (item.classList.contains('talent')) {
            item.classList.remove('talent');
            item.classList.add('talent-off');
            talents.value = parseInt(talents.value) - code;
            document.getElementById(id + "_button").value = "Add"
        }
    }
</script>
</body>
</html>
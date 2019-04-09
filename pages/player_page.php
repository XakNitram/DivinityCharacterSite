<!--Perhaps the admin and player pages should be merged?-->

<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>DivinityHub</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <style>

        body {
            background: #000000 url("../images/login.jpg") no-repeat fixed center center;
            background-size: cover;
        }

        .content {
            width: 1024px;
        }

        .col-container {
            width: 100%;
            display: flex;
            flex-direction: row;
        }

        .col {
            display: flex;
            flex-direction: column;
        }

        .talent-box {
            width: 100%;
            height: 540.5px;
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
            margin: 8px 8px 8px 8px;
            padding: 10px;
            border: 1px solid #333333;
            box-shadow:  -1px 1px #333333,
            -2px 2px #333333,
            -3px 3px #333333;
        }

        .number {
            color: #ffa500;
        }

        .wide-4 {
            margin: 32px;
            width: calc(100% - 64px);
        }

        .wide-3 {
            margin: 16px;
            width: calc(100% - 32px);
        }

        .wide-2 {
            margin: 8px;
            width: calc(100% - 16px);
        }

        .center {
            text-align: center;
        }

        .no-margin {
            margin-top: 0;
            margin-bottom: 0;
        }

        .w-25 {
            width: 25%;
        }

        .w-50 {
            width: 50%;
        }

        .w-75 {
            width: 75%;
        }

        .w-100 {
            width: 100%;
        }

        h3, h4, p {
            margin-top: 0;
            margin-bottom: 0;
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
require_once("../classes/Character.php");

// ****** Variable Initialization ******
$username = "";
$type = "";

session_start();
if (isset($_SESSION['type'])) {
    $type = $_SESSION['type'];
    if ($type == 'admin') {
        $username = $_GET['player'];
    }
}

if (!$username) {
    if (!isset($_SESSION['username'])) {
        $username = "UNKNOWN USER";
    } else {
        $username = $_SESSION['username'];
    }
}

if (!isset($_SESSION['character'])) {
    $character = new Character(true);
    $talents = mt_rand(0, intval(pow(2, 43)));
    $character->talents = $talents;
    $character->name = "Sebille";

    foreach ($character->abilities as $key => &$value) {
        $value = mt_rand(0, 20);
    }
    unset($value);

    $_SESSION['character'] = serialize($character);
}
else {
    $character = unserialize($_SESSION['character']);
}
//$tab = $_GET['tab'];

//foreach ($character->abilities) {}
?>

<div class="content">
    <div class="wide-4">
        <div class="wide-2">
            <h1 class="no-margin">
                <?php echo $username ?>
            </h1>
            <h2 class="no-margin" style="color: #C0C0C0">
                <?php echo $character->name ?>
            </h2>
            <h3 class="no-margin" style="color: #A0A0A0">
                <?php echo "Level: " . $character->level ?>
            </h3>
            <br>
        </div>
        <div class="wide-2">
            <h3>Background</h3>
            <hr>
            <p><?php echo $character->background ?></p>
        </div>
        <div class="col-container">
            <div class="col w-50 wide-2">
                <h3>Combat Abilities</h3>
                <hr>
                <?php
                $combatAbilities = array(
                    "Weapons"=>$weaponCombatAbilityNames,
                    "Defence"=>$defenceCombatAbilityNames,
                    "Skills"=>$skillCombatAbilityNames
                );
                foreach ($combatAbilities as $key => $section) {
                    echo "<h4>$key</h4>";
                    echo '<div class="section">';
                    foreach ($section as $skill) {
                        $value = $character->getAbility($skill);
                        echo '<div class="col-container">';

                        $desc = addslashes($abilityDescriptions[$skill]);
                        echo    "<div class=\"col w-75\" id=\"$skill\" onclick=\"showAbilityDescription('$skill', '$desc')\">";
                        echo        "<p>$skill</p>";
                        echo    "</div>";

                        echo    "<div class=\"col w-25\">";
                        echo        "<span class=\"number\">$value</span>";
                        echo    "</div>";
                        echo "</div>";
                    }
                    echo '</div>';
                }
                ?>

                <h3>Civil Abilities</h3>
                <hr>
                <?php
                $civilAbilities = array(
                    "Personality"=>['Bartering', 'Lucky Charm', 'Persuasion'],
                    "Craftsmanship"=>['Loremaster', 'Telekinesis'],
                    "Nasty Deeds"=>['Sneaking', 'Thievery']
                );
                foreach ($civilAbilities as $key => $section) {
                    echo "<h4>$key</h4>";
                    echo '<div class="section">';
                    foreach ($section as $skill) {
                        $value = $character->getAbility($skill);
                        echo '<div class="col-container">';

                        $desc = addslashes($abilityDescriptions[$skill]);
                        echo    "<div class=\"col w-75\" id=\"$skill\" onclick=\"showAbilityDescription('$skill', '$desc')\">";
                        echo        "<p>$skill</p>";
                        echo    "</div>";

                        echo    "<div class=\"col w-25\">";
                        echo        "<span class=\"number\">$value</span>";
                        echo    "</div>";
                        echo "</div>";
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <div class="col w-50 wide-2">
                <h3>Attributes</h3>
                <hr>
                <?php
                $skills = [
                    'Strength', 'Finesse', 'Intelligence',
                    'Constitution', 'Memory', 'Wits'
                ];
                foreach ($skills as $name) {
                    $value = $character->getAttribute($name);
                    echo '<div class="col-container">';

                    $desc = addslashes($attributeDescriptions[$name]);
                    echo    "<div class=\"col w-75\" id=\"$name\" onclick=\"showAbilityDescription('$name', '$desc')\">";
                    echo        "<p>$name</p>";
                    echo    "</div>";

                    echo    "<div class=\"col w-25\">";
                    echo        "<span class=\"number\">$value</span>";
                    echo    "</div>";
                    echo "</div>";
                }
                unset($name);
                ?>
                <br>
                <h3>Talents</h3>
                <hr>
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
                        echo "<div id='$name' class='talent bordered' $style onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo    "<h3>$name</h3>";
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
                        echo "<div id='$name' class='talent-off bordered' $style onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo    "<h3>$name</h3>";
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
    </div>
</div>
</body>
<script>
    let showingTalentDesc = false;
    let backTalentID;

    let htmlTStart  = "<h3>";
    let htmlTMiddle = "</h3><hr><p>";
    let htmlTEnd    = "</p>";

    function showTalentDescription(id, description) {
        // close old description
        if (showingTalentDesc) {
            if (id !== backTalentID) {
                document.getElementById(backTalentID).innerHTML = "<h3>" + backTalentID + "</h3>";
                showingTalentDesc = false;
            }
            else {
                document.getElementById(id).innerHTML = "<h3>" + id + "</h3>";
                showingTalentDesc = false;
                return;
            }
        }

        // show new description
        document.getElementById(id).innerHTML = htmlTStart + id + htmlTMiddle + description + htmlTEnd;
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
                document.getElementById(backAbilityID).innerHTML = "<p>" + backAbilityID + "</p>";
                // document.getElementById(backAbilityID).classList.remove("bordered");
                showingAbilityDesc = false;
            }
            else {
                document.getElementById(id).innerHTML = "<p>" + id + "</p>";
                // document.getElementById(id).classList.remove("bordered");
                showingAbilityDesc = false;
                return;
            }
        }

        //show new ability description
        document.getElementById(id).innerHTML = htmlAStart + id + htmlAMiddle + description + htmlAEnd;

        // document.getElementById(id).classList.add("bordered");
        backAbilityID = id;
        showingAbilityDesc = true;
    }
</script>
</html>

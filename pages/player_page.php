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

session_start();
if (!isset($_SESSION['username'])) {
    $username = "Simmons";
}
else {
    $username = $_SESSION['username'];
}

$character = new Character(true);
$talents = 0x0;
$talentCount = 0;
for ($i = 1; $i < 10; $i++) {
    $val = mt_rand(0, 10-$i);
    if ($val != 0) {
        $talentCount++;
        $talents += intval(pow(16, $val));
    }
}
$character->talents = $talents;
$_SESSION['character'] = serialize($character);
$character->name = "Sebille";
$tab = $_GET['tab'];
?>

<div class="content">
    <div class="wide-4">
        <div class="wide-2">
            <h1 class="no-margin">
                <?php echo $username ?>
            </h1>
            <h3 class="no-margin" style="color: #888888">
                <?php echo $character->name ?>
            </h3>
        </div>
        <div class="wide-2">
            <h3>Background</h3>
            <hr>
            <p>This is a story all about how your life got twisted upside down.</p>
        </div>
        <div class="col-container">
            <div class="col w-50 wide-2">
                <h3>Combat Abilities</h3>
                <hr>
                <?php
                $combatAbilities = array(
                    "Weapons"=>[
                        'Dual Wielding', 'Ranged', 'Single-Handed',
                        'Two-Handed'
                    ],
                    "Defence"=>[
                        'Leadership', 'Perseverance', 'Retribution'
                    ],
                    "Skills"=>[
                        'Aerotheurge', 'Geomancer', 'Huntsman',
                        'Hydrosophist', 'Necromancer', 'Polymorph',
                        'Pyrokinetic', 'Scoundrel', 'Summoning',
                        'Warfare'
                    ]
                );
                foreach ($combatAbilities as $key => $value) {
                    echo "<h4>$key</h4>";
                    echo '<div class="section">';
                    foreach ($value as $skill) {
                        //  $value = $character->getAbility(strtolower($name));
                        $value = 0;
                        echo '<div class="col-container w-100">';
                        echo "<p class='col w-75'>$skill</p>";
                        echo "<div class='col w-25'>
                                <span class='number'>$value</span>
                              </div>";
                        echo '</div>';
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
                foreach ($civilAbilities as $key => $value) {
                    echo "<h4>$key</h4>";
                    echo '<div class="section">';
                    foreach ($value as $skill) {
                        //  $value = $character->getAbility(strtolower($name));
                        $value = 0;
                        echo '<div class="col-container">';
                        echo "<p class='col w-75'>$skill</p>";
                        echo "<div class='col w-25'>
                                <span class='number'>$value</span>
                              </div>";
                        echo '</div>';
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
                    //  $value = $character->getAbility(strtolower($name));
                    $value = 0;
                    echo '<div class="col-container w-100">';
                    echo "<p class='col w-75'>$name</p>";
                    echo "<div class='col w-25'>
                            <span class='number'>$value</span>
                          </div>";
                    echo '</div>';
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
                        echo "<div class='talent bordered' $style onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo "<h3>$name</h3>";
                        echo "<hr id='".$name."_hr' style='display: none'>";
                        echo "<span id='".$name."_desc'></span>";
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
                        echo "<div class='talent-off bordered' $style onclick=\"showTalentDescription('$name', '$desc')\">";
                        echo "<h3 id='$name'>$name</h3>";
                        echo "<hr id='".$name."_hr' style='display: none'>";
                        echo "<span id='".$name."_desc'></span>";
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
    let showingDesc = false;
    let backID;

    function showTalentDescription(id, description) {
        // close old description
        if (showingDesc) {
            if (id !== backID) {
                document.getElementById(backID + "_desc").innerHTML = "";
                document.getElementById(backID + "_hr").style.display = 'none';
                showingDesc = false;
            }
            else {
                document.getElementById(id + "_desc").innerHTML = "";
                document.getElementById(id + "_hr").style.display = 'none';
                showingDesc = false;
                return;
            }
        }

        // show new description
        document.getElementById(id + "_desc").innerHTML = description;
        document.getElementById(id + "_hr").style.display = 'block';
        backID = id;
        showingDesc = true;
    }
</script>
</html>

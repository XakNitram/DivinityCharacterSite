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
            height: 100%;
            min-height: 100%;
            display: flex;
            flex-direction: row;
        }

        .col {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .talent-box {
            width: 100%;
            height: 540.5px;
            overflow: auto;
            border: 1px solid #333333;
        }

        .talent {
            margin: 8px 8px 8px 8px;
            padding: 10px;
            border: 1px solid #ffa500;
            box-shadow:  -1px 1px #ffa500,
            -2px 2px #ffa500,
            -3px 3px #ffa500
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
$_SESSION['character'] = serialize($character);
$character->name = "Sebille";
$tab = $_GET['tab'];
?>

<div class="content">
    <div class="wide-4">
        <div class="wide-2">
            <h1 class="center no-margin">
                <?php echo $username ?>
            </h1>
            <h3 class="center no-margin" style="color: #888888">
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
                ?>
                <br>
                <h3>Talents</h3>
                <hr>
                <div class="talent-box">
                    <?php
                    for ($i = 0; $i < 36; $i++) {
                        echo "<div class='talent bordered'>";
                        echo "<h3>Talent $i</h3>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

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

        /* width */
        ::-webkit-scrollbar {
            width: 20px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #ffa500;
        }

        .content {
            width: 1024px;
        }

        .wrapper {
            overflow: auto;
        }

        .wrap-col {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            white-space: nowrap;
            float: left;
            width: 50%;
        }

        [class*="wrap-col"].pad {
            margin: 8px;
            width: calc(50% - 16px);
        }

        p[class*="wrap-col"] {
            width: 75%;
        }

        p[class*="wrap-col"] ~ div[class*="wrap-col"] {
            width: 25%;
        }

        .wide-3 {
            margin: 16px;
            width: calc(100% - 32px);
        }
        .wide-2 {
            margin: 8px;
            width: calc(100% - 16px);
        }

        .bordered {
            border: 1px solid #333333;
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
$username = "Dickleberg";
$character = new Character(true);
$character->name = "Sebille";
$tab = $_GET['tab'];
?>

<div class="content">
    <div class="wrapper wide-3">
        <div class="w-25 wrap-col">
            <div class="wide-2">
                <h1 class="center no-margin">
                    <?php echo $username; ?>
                </h1>
                <h3 class="center no-margin"
                    style="color: #888888"
                >
                    <?php echo $character->name; ?>
                </h3>
            </div>
        </div>
        <div class="w-75 wrap-col">
            <div class="wide-2 wrapper clear-fix">
                <div class="wide-3">
                    <h3>Background</h3>
                    <hr>
                    <p class="wide-2">This is the story all about how my life got twisted upside down.</p>
                </div>
                <div class="wrap-col pad">
                        <!--Abilities-->
                        <div class="wrapper wide-2">
                            <h3>Combat Abilities</h3>
                            <hr>
                            <h4>Weapons</h4>
                            <div class="section">
                                <?php
                                $skills = [
                                    'Dual Wielding', 'Ranged', 'Single-Handed',
                                    'Two-Handed'
                                ];
                                foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                                    $value = 0;
                                    echo "<p class='wrap-col'>$name</p>";
                                    echo "<div class='wrap-col'><span>$value</span></div>";
                                    echo "<br>";

                                }
                                ?>
                            </div>

                            <h4>Defence</h4>
                            <div class="section">
                                <?php
                                $skills = [
                                    'Leadership', 'Perseverance', 'Retribution'
                                ];
                                foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                                    $value = 0;
                                    echo "<p class='wrap-col'>$name</p>";
                                    echo "<div class='wrap-col'><span>$value</span></div>";
                                    echo "<br>";

                                }
                                ?>
                            </div>

                            <h4>Skills</h4>
                            <div class="section">
                                <?php
                                $skills = [
                                        'Aerotheurge', 'Geomancer', 'Huntsman',
                                    'Hydrosophist', 'Necromancer', 'Polymorph',
                                    'Pyrokinetic', 'Scoundrel', 'Summoning',
                                    'Warfare'
                                ];
                                foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                                    $value = 0;
                                    echo "<p class='wrap-col'>$name</p>";
                                    echo "<div class='wrap-col'><span>$value</span></div>";
                                    echo "<br>";

                                }
                                ?>
                            </div>
                            <br>

                            <h3>Civil Abilities</h3>
                            <hr>
                            <h4>Personality</h4>
                            <div class="section">
                                <?php
                                $skills = [
                                        'Bartering', 'Lucky Charm', 'Persuasion'
                                ];
                                foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                                    $value = 0;
                                    echo "<p class='wrap-col'>$name</p>";
                                    echo "<div class='wrap-col'><span>$value</span></div>";
                                    echo "<br>";

                                }
                                ?>
                            </div>

                            <h4>Craftsmanship</h4>
                            <div class="section">
                                <?php
                                $skills = [
                                    'Loremaster', 'Telekinesis'
                                ];
                                foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                                    $value = 0;
                                    echo "<p class='wrap-col'>$name</p>";
                                    echo "<div class='wrap-col'><span>$value</span></div>";
                                    echo "<br>";

                                }
                                ?>
                            </div>

                            <h4>Nasty Deeds</h4>
                            <div class="section">
                                <?php
                                $skills = [
                                    'Sneaking', 'Thievery'
                                ];
                                foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                                    $value = 0;
                                    echo "<p class='wrap-col'>$name</p>";
                                    echo "<div class='wrap-col'><span>$value</span></div>";
                                    echo "<br>";

                                }
                                ?>
                            </div>
                    </div>
                </div>
                <div class="wrap-col pad">
                    <div class="wrapper wide-2">
                        <!--Attributes and Talent Box-->
                        <h3>Attributes</h3>
                        <hr>
                        <?php
                        $skills = [
                            'Strength', 'Finesse', 'Intelligence',
                            'Constitution', 'Memory', 'Wits'
                        ];
                        foreach ($skills as $name) {
//                                    $value = $character->getAbility(strtolower($name));
                            $value = 0;
                            echo "<p class='wrap-col'>$name</p>";
                            echo "<div class='wrap-col'><span>$value</span></div>";
                            echo "<br>";

                        }
                        ?>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<?php
//    session_unset();
//    session_destroy();
?>
</body>
</html>

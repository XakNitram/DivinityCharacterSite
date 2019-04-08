<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php
    $username = "";
    $characterName = "";  // should be $character->name;
    // Get user info; Create Character and Player classes here.
    ?>
    <title><?php echo "$characterName ($username)"; ?></title>
    <link rel="stylesheet" href="../styles/general.css">
    <style>
        body {
            background: black;
        }

        .content {
            width: 1024px;
        }

        .col.label {
            width: 256px;
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
    </style>
</head>
<body>
<?php
require_once "../classes/Character.php";
if (isset($_SESSION['character'])) {
    $character = unserialize($_SESSION['character']);
}
else {
    $character = new Character(true);
    $character->name = "Sebille";
}
?>
<div class="content">
    <form method="post" action="edit_character.php" name="edit">
    <div class="wide-4">
        <!--Names-->
        <div class="wide-2">
            <h1><?php echo $username ?></h1>

            <input
                    class="name h2" id="name" type="text"
                    value="<?php echo $character->name?>"
                    maxlength="32"
            >
            <br>
            <input
                    class="name h3" id="level" type="number"
                    max="50" value="<?php echo $character->level ?>"
            >
        </div>

        <!--Background-->
        <div class="wide-2">
            <h3>Background</h3>
            <hr>
            <textarea form="edit" rows="4"><?php echo $character->background ?></textarea>
        </div>

        <!--Abilities, Attributes, and Talents-->
        <div class="col-container">
            <!--Abilities-->
            <div class="col w-50">
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
                        echo "<div class='col-container'>";

                        $desc = addslashes($abilityDescriptions[$skill]);
                        echo    "<div class=\"col w-75\" id=\"$skill\" onclick=\"showAbilityDescription('$skill', '$desc')\">";
                        echo        "<p>$skill</p>";
                        echo    "</div>";

                        echo    "<div class=\"col w-25\">";
                        echo        "<input type='text' class='number' value='$value'>";
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
                        $div_id = $skill . "_inc";
                        echo    "<div class='col w-75' id='$div_id' onclick=\"showAbilityDescription('$div_id', '$skill', '$desc')\">";
                        echo        "<p>$skill</p>";
                        echo    "</div>";

                        echo    "<div class=\"col w-25\">";
                        echo        "<div class='col-container'>";
                        echo            "<input id='$skill' type='text' class='col number' value='$value' readonly='true'>";
                        echo            "<input class='col inc-button' type='button' value='+' onclick=\"add('$skill')\">";
                        echo            "<input class='col inc-button' type='button' value='-' onclick=\"minus('$skill')\">";
                        echo        "</div>";
                        echo    "</div>";
                        echo "</div>";
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <!--Attributes and Talents-->
            <div class="col w-50">

            </div>
        </div>
    </div>
    </form>
</div>
<script>
    let id_array = [];

    function add(id) {
        let value = id_array[id];
        if (value === undefined) {
            value = 1;
        }
        else {
            value++;
        }
        document.getElementById(id).value = value;
        id_array[id] = value;
    }

    function minus(id){
        let value = id_array[id];
        if (value === undefined) {
            value = 0;
        }
        else {
            if (value > 0) {
                value--;
            }
            else {
                value = 0;
            }
        }
        document.getElementById(id).value = value;
        id_array[id] = value;
    }
</script>
<?php exit(); ?>
<div>
    **Attributes**

    <br>
    strength
    <input type="button" value="+" onclick="add('str');"/>
    <input type="button" value="-" onclick="minus('str');"/>

    <span id="str">0</span>
    <script>
        reset();
    </script>


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
            echo '<div class="">';
            echo "<p>$name</p>";
            echo "<span id='$name' class=''>$value</span>";
            echo '<input type="button" value="+" onclick="add('."'$name'".');">';
            echo '<input type="button" value="-" onclick="minus('."'$name'".');">';
            echo '</div>';
        }
        ?>
    <br>

<div>
    // Skills
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
        echo '<div class="">';
            echo "<p class=''>$skill</p>";
            echo "<div class=''>
                    <span id='$skill' class=''>$value</span>";
                echo '<input type="button" value="+" onclick="add('."'$skill'".');">';
                echo '<input type="button" value="-" onclick="minus('."'$skill'".');">';
            echo "</div>";
            echo '</div>';
        }
        echo '</div>';
    }
    ?>



</div>

<div>
    <?php
    $civilAbilities = array(
        "Personality"=>['Bartering', 'Lucky Charm', 'Persuasion'],
        "Craftsmanship"=>['Loremaster', 'Telekinesis'],
        "Nasty Deeds"=>['Sneaking', 'Thievery']
    );
    foreach ($civilAbilities as $key => $value) {
        echo "<h4>$key</h4>";
        echo '<div class="">';
        foreach ($value as $skill) {
            //  $value = $character->getAbility(strtolower($name));
            $value = 0;
            echo '<div class="">';
            echo "<p>$skill</p>";
            echo "<div><span id='$skill'>$value</span>";
            echo '<input type="button" value="+" onclick="add('."'$skill'".');">';
            echo '<input type="button" value="-" onclick="minus('."'$skill'".');">';
            echo "</div>";
            echo '</div>';
        }
        echo '</div>';
    }
    ?>

</div>
<script>
    // Javascript does not really support associative arrays, so maybe we should make
    // the indices numbers?
    let id_array = [];

    function add(id) {
        let value = id_array[id];
        if (value === undefined) {
            value = 1;
        }
        else {
            value++;
        }
        document.getElementById(id).innerHTML = value;
        id_array[id] = value;
    }

    function minus(id){
        let value = id_array[id];
        if (value === undefined) {
            value = 0;
        }
    else {
            if (value > 0) {
                value--;
            }
            else {
                value = 0;
            }
        }
        document.getElementById(id).innerHTML = value;
        id_array[id] = value;
    }

    function reset(id) {
        id_array[id] = 0;
    }
</script>


<form>
    <!--    <input type="button" value="Add one" onclick="add();"/>-->
    <!--</form>-->
    <!--<span id="field">0</span>-->
    <!--<script>-->
    <!--    var value = 0;-->
    <!---->
    <!--    function add() {-->
    <!--        value++;-->
    <!--        document.getElementById("field").innerHTML = value;-->
    <!--    }-->
    <!--</script>-->
    <div style="width:150px;height:150px;line-height:3em;overflow:scroll;padding:5px;">

        <input type="checkbox" <id="AllSkilledUP"> AllSkilledUP <br />
        <input type="checkbox" <id="Ambidestrous"> Ambidestrouss <br />
        <input type="checkbox" <id="ArrowRecover"> ArrowRecovery <br />
        <input type="checkbox" <id="BiggerAndBe"> BiggerAndBetter <br />
        <input type="checkbox" <id="ComebackKid"> ComebackKid <br />
        <input type="checkbox" <id="CorpseEater"> CorpseEater <br />
        <input type="checkbox" <id="Demon "> Demon <br />
        <input type="checkbox" <id="DuckDuckGoo"> DuckDuckGoose <br />
        <input type="checkbox" <id="DwarvenGuil"> DwarvenGuile <br />
        <input type="checkbox" <id="ElementalAf"> ElementalAffinity <br />
        <input type="checkbox" <id="Escapist "> Escapist <br />
        <input type="checkbox" <id="Executioner"> Executioner <br />
        <input type="checkbox" <id="ElementalRa"> ElementalRanger <br />
        <input type="checkbox" <id="FarOutMan "> FarOutMan <br />
        <input type="checkbox" <id="FiveStarDin"> FiveStarDiner <br />
        <input type="checkbox" <id="GlassCannon"> GlassCannon <br />
        <input type="checkbox" <id="Guerrilla "> Guerrilla <br />
        <input type="checkbox" <id="Hothead "> Hothead <br />
        <input type="checkbox" <id="IceKing "> IceKing <br />
        <input type="checkbox" <id="Ingenious "> Ingenious <br />
        <input type="checkbox" <id="Leech "> Leech <br />
        <input type="checkbox" <id="LivingArmou"> LivingArmour <br />
        <input type="checkbox" <id="LoneWolf "> LoneWolf <br />
        <input type="checkbox" <id="Mnemonic "> Mnemonic <br />
        <input type="checkbox" <id="MorningPers"> MorningPerson <br />
        <input type="checkbox" <id="Opportunist"> Opportunist <br />
        <input type="checkbox" <id="ParryMaster"> ParryMaster <br />
        <input type="checkbox" <id="PetPal "> PetPal <br />
        <input type="checkbox" <id="PictureOfHe"> PictureOfHealth <br />
        <input type="checkbox" <id="SavageSorti"> SavageSortilege <br />
        <input type="checkbox" <id="Slingshot "> Slingshot <br />
        <input type="checkbox" <id="Sophisticat"> Sophisticated <br />
        <input type="checkbox" <id="Stench "> Stench <br />
        <input type="checkbox" <id="Sturdy "> Sturdy <br />
        <input type="checkbox" <id="ThePawn "> ThePawn <br />
        <input type="checkbox" <id="Torturer "> Torturer <br />
        <input type="checkbox" <id="Undead "> Undead <br />
        <input type="checkbox" <id="Unstable "> Unstable <br />
        <input type="checkbox" <id="WalkItOff "> WalkItOff <br />
        <input type="checkbox" <id="WhatARush "> WhatARush <br />
    </div>




    <?php
    if (isset($_POST["submit_character"])) {
        $strength = $_POST["str"];
        //character.setAttribute('finesse');

        $intelligence = $_POST["int"];
//        $constitution
//        $memory
//        $wits
//// weapons
//        $Dual_Wielding
//        $Ranged
//        $Single_Handed
//        $Two_Handed
//
//// defence
//        $Leadership
//        $Perseverance
//        $Retribution
//
//// skills
//        $Aerotheurge
//        $Geomancer
//        $Huntsman
//        $Hydrosophist
//        $Necromancer
//        $Polymorph
//        $Pyrokinetic
//        $Scoundrel
//        $Summoning
//        $Warfare
//
//        Bartering
//        Lucky Charm
//        Persuasion
//
//// Craftsmanship
//        Loremaster
//        Telekinesis
//
//// nasty deeds
//        Sneaking
//        Thievery
//
//        $username = $_POST["username"];
//        $password = $_POST["password"];
//        $gameId   = $_POST["gameId"];
//        $type     = 'player';


    }
    ?>
<script>




</script>


    <form action="edit_character.php" method="post">
        <input class="button" type="submit" name="submit_character" value="Submit Character">
    </form>

</body>
</html>
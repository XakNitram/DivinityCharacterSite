<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php
    $username = "";
    $characterName = "";  // should be $character->name;
    // Get user info; Create Character and Player classes here.
    ?>
    <title><?php echo "$characterName ($username)"; ?></title>
</head>
<body>
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
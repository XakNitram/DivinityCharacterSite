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


    <?php

    ?>

    <?php

    ?>
    <br>

    finesse
    <input type="button" value="+" onclick="add('fin');"/>
    <input type="button" value="-" onclick="minus('fin');"/>

    <span id="fin">0</span>
    <br>
    intelligence
    <input type="button" value="+" onclick="add('int');"/>
    <input type="button" value="-" onclick="minus('int');"/>

    <span id="int">0</span>

    <br>
    constitution
    <input type="button" value="+" onclick="add('con');"/>
    <input type="button" value="-" onclick="minus('con');"/>

    <span id="con">0</span>

    <br>
    memory
    <input type="button" value="+" onclick="add('mem');"/>
    <input type="button" value="-" onclick="minus('mem');"/>

    <span id="mem">0</span>

    <br>
    wits
    <input type="button" value="+" onclick="add('wit');"/>
    <input type="button" value="-" onclick="minus('wit');"/>

    <span id="wit">0</span>

    <br>



</div>
<div>
    // ****** Abilities ******
    <br>
    // *** Combat Abilities ***
    <br>
    24
    * Max of 10
    <br>

    // Weapons
    <br>
    Dual Wielding
    <input type="button" value="+" onclick="add('dualwielding');"/>
    <input type="button" value="-" onclick="minus('dualwielding');"/>

    <span id="dualwielding">0</span>

    <br>
    Ranged
    <input type="button" value="+" onclick="add('ranged');"/>
    <input type="button" value="-" onclick="minus('ranged');"/>

    <span id="ranged">0</span>
    <br>

    Single-Handed
    <input type="button" value="+" onclick="add('single');"/>
    <input type="button" value="-" onclick="minus('single');"/>

    <span id="single">0</span>

    <br>
    Two-Handed
    <input type="button" value="+" onclick="add('two');"/>
    <input type="button" value="-" onclick="minus('two');"/>

    <span id="two">0</span>

    <br>

    // Defence
    <br>
    Leadership
    <input type="button" value="+" onclick="add('lead');"/>
    <input type="button" value="-" onclick="minus('lead');"/>

    <span id="lead">0</span>
    <br>
    <br>
    Perseverance
    <input type="button" value="+" onclick="add('pers');"/>
    <input type="button" value="-" onclick="minus('pers');"/>

    <span id="pers">0</span>
    <br>
    Retribution
    <input type="button" value="+" onclick="add('ret');"/>
    <input type="button" value="-" onclick="minus('ret');"/>

    <span id="ret">0</span>
    <br>



</div>

<div>
    // Skills
    Aerotheurge
    <input type="button" value="+" onclick="add('aero');"/>
    <input type="button" value="-" onclick="minus('aero');"/>

    <span id="aero">0</span>
    <br>

    Geomancer
    <input type="button" value="+" onclick="add('geo');"/>
    <input type="button" value="-" onclick="minus('geo');"/>

    <span id="geo">0</span>
    <br>

    Huntsman
    <input type="button" value="+" onclick="add('hunt');"/>
    <input type="button" value="-" onclick="minus('hunt');"/>

    <span id="hunt">0</span>

    <br>

    Hydrosophist
    <input type="button" value="+" onclick="add('hydro');"/>
    <input type="button" value="-" onclick="minus('hydro');"/>

    <span id="hydro">0</span>
    <br>
    Necromancer
    <input type="button" value="+" onclick="add('necro');"/>
    <input type="button" value="-" onclick="minus('necro');"/>

    <span id="necro">0</span>

    <br>
    Polymorph
    <input type="button" value="+" onclick="add('poly');"/>
    <input type="button" value="-" onclick="minus('poly');"/>

    <span id="poly">0</span>

    <br>
    Pyrokinetic
    <input type="button" value="+" onclick="add('pyro');"/>
    <input type="button" value="-" onclick="minus('pyro');"/>

    <span id="pyro">0</span>

    <br>
    Scoundrel
    <input type="button" value="+" onclick="add('scound');"/>
    <input type="button" value="-" onclick="minus('scound');"/>

    <span id="scound">0</span>
    <br>
    Summoning
    <input type="button" value="+" onclick="add('summon');"/>
    <input type="button" value="-" onclick="minus('summon');"/>

    <span id="summon">0</span>
    <br>
    Warfare
    <input type="button" value="+" onclick="add('war');"/>
    <input type="button" value="-" onclick="minus('war');"/>

    <span id="war">0</span>
    <br>


</div>

<div>
    // *** Civil Abilities ***
    * Max of 5

    // Personality
    Bartering
    <input type="button" value="+" onclick="add('bart');"/>
    <input type="button" value="-" onclick="minus('bart');"/>

    <span id="bar">0</span>
    <br>

    Lucky Charm
    <input type="button" value="+" onclick="add('luck');"/>
    <input type="button" value="-" onclick="minus('luck');"/>

    <span id="luck">0</span>
    <br>
    Persuasion
    <input type="button" value="+" onclick="add('persuasion');"/>
    <input type="button" value="-" onclick="minus('persuasion');"/>

    <span id="persuasion">0</span>
    <br>

    // Craftsmanship
    Loremaster
    <input type="button" value="+" onclick="add('craft');"/>
    <input type="button" value="-" onclick="minus('craft');"/>

    <span id="craft">0</span>
    <br>
    Telekinesis
    <input type="button" value="+" onclick="add('tele');"/>
    <input type="button" value="-" onclick="minus('tele');"/>

    <span id="fin">0</span>
    <br>


    // Nasty Deeds
    Sneaking
    <input type="button" value="+" onclick="add('sneak');"/>
    <input type="button" value="-" onclick="minus('sneak');"/>

    <span id="fin">0</span>
    <br>
    Thievery
    <input type="button" value="+" onclick="add('thiev');"/>
    <input type="button" value="-" onclick="minus('fin');"/>

    <span id="thiev">0</span>
    <br>
    help me


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
    <form action="????????????????" method="post">
        <input class="button" type="submit" name="submit_character" value="Sign in">
    </form>
</body>
</html>
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
    <input type="button" value="Add one" onclick="add('str');"/>
    </form>
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
    <input type="button" value="Add one" onclick="add('fin');"/>
    </form>
    <span id="fin">0</span>
    <br>
    intelligence
    <br>
    constitution
    <br>
    memory
    <br>
    wits
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
    <br>
    Ranged
    <br>
    Single-Handed
    <br>
    Two-Handed
    <br>

    // Defence
    <br>
    Leadership
    <br>
    Perseverance
    <br>
    Retribution
    <br>


</div>

<div>
    // Skills
    Aerotheurge
    <br>
    Geomancer
    <br>
    Huntsman
    <br>

    Hydrosophist
    <br>
    Necromancer
    <br>
    Polymorph
    <br>
    Pyrokinetic
    <br>
    Scoundrel
    <br>
    Summoning
    <br>
    Warfare
    <br>


</div>

<div>
    // *** Civil Abilities ***
    * Max of 5

    // Personality
    Bartering
    Lucky Charm
    Persuasion

    // Craftsmanship
    Loremaster
    Telekinesis


    // Nasty Deeds
    Sneaking
    Thievery

    help me


</div>
<script>
    var value = 0;

    function add(id) {
        value++;
        document.getElementById(id).innerHTML = value;

    }
    function reset() {

        value = 0;
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
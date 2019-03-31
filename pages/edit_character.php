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
strength
<br>

finesse
intelligence
constitution
memory
wits

// ****** Abilities ******
// *** Combat Abilities ***
24
* Max of 10

// Weapons
Dual Wielding
Ranged
Single-Handed
Two-Handed

// Defence
Leadership
Perseverance
Retribution

// Skills
Aerotheurge
Geomancer
Huntsman
Hydrosophist
Necromancer
Polymorph
Pyrokinetic
Scoundrel
Summoning
Warfare

// *** Civil Abilities ***
* Max of 5

// Personality
Bartering
Lucky Charm
Persuasion

// Craftsmanship
Loremaster
Telekinesis



test commit



// Nasty Deeds
Sneaking
Thievery
<form>
    <form>
        <input type="button" value="+" onclick="add();"/>
    </form>
    <span id="field">0</span>

    <script>
        var value = 0;

        function add() {
            value++;
            document.getElementById("field").innerHTML = value;
        }
    </script>



    </form>
    <?php

    ?>
</body>
</html>
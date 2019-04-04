<?php

/*
 * There are 36 talents.
 * If we store them as a 9-digit hexadecimal number,
 * we can use "$LoneWolf & $talents" to tell if a player
 * has the Lone Wolf trait.
list of talents:
0x000000001 - Ambidextrous
0x000000002 - All Skilled Up
0x000000004 - Arrow Recovery
0x000000008 - Bigger And Better
0x000000010 - Comeback Kid
0x000000020 - Demon
0x000000040 - Duck Duck Goose
0x000000080 - Elemental Affinity
0x000000100 - Elemental Ranger
0x000000200 - Escapist
0x000000400 - Executioner
0x000000800 - Far Out Man
0x000001000 - Five-Star Diner
0x000002000 - Glass Cannon
0x000004000 - Guerrilla
0x000008000 - Hothead
0x000010000 - Ice King
0x000020000 - Leech
0x000040000 - Living Armour
0x000080000 - Lone Wolf
0x000100000 - Mnemonic
0x000200000 - Morning Person
0x000400000 - Opportunist
0x000800000 - Parry Master
0x001000000 - Pet Pal
0x002000000 - Picture of Health
0x004000000 - Savage Sortilege
0x008000000 - Slingshot
0x010000000 - Sophisticated
0x020000000 - Spellsong
0x040000000 - Stench
0x080000000 - The Pawn
0x100000000 - Torturer
0x200000000 - Unstable
0x400000000 - Walk It Off
0x800000000 - What A Rush

-----------------Talents------------
47 of them
0x000000000001 - All Skilled Up
0x000000000002 - Ambidextrous
0x000000000004 - Arrow Recovery
0x000000000008 - Bigger and Better
0x000000000010 - Comeback Kid
0x000000000020 - Corpse Eater
0x000000000040 - Demon
0x000000000080 - Duck Duck Goose
0x000000000100 - Dwarven Guile
0x000000000200 - Elemental Affinity
0x000000000400 - Escapist
0x000000000800 - Executioner
0x000000001000 - Elemental Ranger
0x000000002000 - Far Out Man
0x000000004000 - Five-Star Diner
0x000000008000 - Glass Cannon
0x000000010000 - Guerrilla
0x000000020000 - Hothead
0x000000040000 - Ice King
0x000000080000 - Ingenious
0x000000100000 - Leech
0x000000200000 - Living Armour
0x000000400000 - Lonewolf
0x000000800000 - Mnemonic
0x000001000000 - Morning Person
0x000002000000 - Opportunist
0x000004000000 - Parry Master
0x000008000000 - Pet Pal
0x000010000000 - Picture of Health
0x000020000000 - Savage Sortilege
0x000040000000 - Slingshot
0x000080000000 - Sophisticated
0x000100000000 - Stench
0x000200000000 - Sturdy
0x000400000000 - The Pawn
0x000800000000 - Torturer
0x001000000000 - Undead
0x002000000000 - Unstable
0x004000000000 - Walk it Off 	Reduces all status duration by 1 turn, positive effects also apply 	N/A
0x008000000000 - What a Rush
*/

/*
 * perhaps we can store the attributes and abilities as arrays? Dictionaries maybe?
// ****** Attributes ******
strength
finesse
intelligence
constitution
memory
wits

// ****** Abilities ******
// *** Combat Abilities ***
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

// Nasty Deeds
Sneaking
Thievery
*/

$talentArray = array("AllSkilledUp" => 0x000000000001, "Ambidextrous" => 0x000000000002, "ArrowRecovery" => 0x000000000004,
    "BiggerAndBetter" => 0x000000000008, "ComebackKid" => 0x000000000010, "CorpseEater" => 0x000000000020, "Demon" => 0x000000000040,
    "DuckDuckGoose" => 0x000000000080, "DwarvenGuile" => 0x000000000100, "ElementalAffinity" => 0x000000000200, "Escapist" => 0x000000000400,
    "Executioner" => 0x000000000800, "ElementalRanger" => 0x000000001000, "FarOutMan" => 0x000000002000, "FiveStarDiner" => 0x000000004000,
    "GlassCannon" => 0x000000008000, "Guerrilla" => 0x000000010000, "Hothead" => 0x000000020000, "IceKing" => 0x000000040000,
    "Ingenious" => 0x000000080000, "Leech" => 0x000000100000, "LivingArmour" => 0x000000200000, "LoneWolf" => 0x000000400000,
    "Mnemonic" => 0x000000800000, "MorningPerson" => 0x000001000000, "Opportunist" => 0x000002000000, "ParryMaster" => 0x000004000000,
    "PetPal" => 0x000008000000, "PictureOfHealth" => 0x000010000000, "SavageSortilege" => 0x000020000000, "Slingshot" => 0x000040000000,
    "Sophisticated" => 0x000080000000, "Stench" => 0x000100000000, "Sturdy" => 0x000200000000, "ThePawn" => 0x000400000000, "Torturer" => 0x000800000000,
    "Torturer" => 0x000800000000, "Undead" => 0x001000000000, "Unstable" => 0x002000000000, "WalkItOff" => 0x004000000000, "WhatARush" => 0x008000000000);
//$AllSkilledUp =      0x000000000001;
//$Ambidextrous =      0x000000000002;
//$ArrowRecovery =     0x000000000004;
//$BiggerAndBetter =   0x000000000008;
//$ComebackKid =       0x000000000010;
//$CorpseEater =       0x000000000020;
//$Demon =             0x000000000040;
//$DuckDuckGoose =     0x000000000080;
//$DwarvenGuile =      0x000000000100;
//$ElementalAffinity = 0x000000000200;
//$Escapist =          0x000000000400;
//$Executioner =       0x000000000800;
//$ElementalRanger =   0x000000001000;
//$FarOutMan =         0x000000002000; // best skill
//$FiveStarDiner =     0x000000004000;
//$GlassCannon =       0x000000008000;
//$Guerrilla =         0x000000010000;
//$Hothead =           0x000000020000;
//$IceKing =           0x000000040000;
//$Ingenious =         0x000000080000;
//$Leech =             0x000000100000;
//$LivingArmour =      0x000000200000;
//$LoneWolf =          0x000000400000;
//$Mnemonic =          0x000000800000;
//$MorningPerson =     0x000001000000;
//$Opportunist =       0x000002000000;
//$ParryMaster =       0x000004000000;
//$PetPal =            0x000008000000;
//$PictureOfHealth =   0x000010000000;
//$SavageSortilege =   0x000020000000;
//$Slingshot =         0x000040000000;
//$Sophisticated =     0x000080000000;
//$Stench =            0x000100000000;
//$Sturdy =            0x000200000000;
//$ThePawn =           0x000400000000;
//$Torturer =          0x000800000000;
//$Undead =            0x001000000000;
//$Unstable =          0x002000000000;
//$WalkItOff =         0x004000000000; 	//Reduces all status duration by 1 turn, positive effects also apply 	N/A
//$WhatARush =         0x008000000000;


class Character {
    // we don't need setters because we will only update
    // when the user submits their changes, meaning that
    // the page will have refreshed and the character
    // info will be converted to a string.
    // All information can then be retrieved from this
    // string.

    // info

    private $attributes;
    private $abilities;
    private $talents;
    private $tags;
    public $level;
    public $name;
    public $background;


    function __construct($isNew=false, $infoString="DEFAULT INFO STRING") {
        // take character info from a string and use it
        // to assign this character's variables.



        if($isNew == true){
            //if the character is new initialize all values to default
            $attributes = array("strength" => 10, "finesse" => 10, "intelligence" => 10, "constitution" => 10, "memory" => 10, "wits" => 10);

            $abilities = array("Dual Wielding" => 0, "Ranged" => 0, "Single-Handed" => 0, "Two-Handed" => 0, "Leadership" => 0,
                "Perseverance" => 0, "Retribution" => 0, "Aerotheurge" => 0, "Geomancer" => 0, "Huntsman" => 0, "Hydrosophist" => 0,
                "Necromancer" => 0, "Polymorph" => 0, "Pyrokinetic" => 0, "Scoundrel" => 0, "Summoning" => 0, "Warfare" => 0);
            $talents = 0;
            $tags = array();
            $name = "";
            $level = "";
            $background = "";
        }
        //if the character being referenced is not new, get the character info string and split it up
        else {

            $CharInfoArray = preg_split(";", $infoString);

            $AttributeSubStr = $CharInfoArray[0];
            $attributes = preg_split(",", $AttributeSubStr);

            $AbilitiesSubStr = $CharInfoArray[1];
            $abilities = preg_split(",", $AbilitiesSubStr);

            $talents = $CharInfoArray[2];

            $TagsSubStr = $CharInfoArray[3];
            $tags = preg_split(',', $TagsSubStr);

            $level = $CharInfoArray[4];
            $name = $CharInfoArray[5];
            $backgroundStr = $CharInfoArray[6];
        }


    }
    function uploadCharString(){
        // query has to use username or password, character information is not necessarily always unique
    }

    function getInfo() {

        $attrInfoStr = "";
        $abilInfoStr = "";
        $tagInfoStr = "";
        foreach($attributes as $value){
            $attrInfoStr = $attrInfoStr . "," . $value;
        }
        foreach($abilities as $value){
            $abilInfoStr = $abilInfoStr . "," . $value;
        }
        foreach($tags as $value){
            $tagInfoStr = $tagInfoStr . "," . $value;
        }
        $fullInfoStr = $attrInfoStr . ";" . $abilInfoStr . ";" . $talents . ";" . $tagInfoStr . ";" . $level . ";" . $name . ";" . $background;
        return $fullInfoStr;

    }

    function getAttribute($name) {
        return $this->attributes[$name];
    }

    function getAbility($name) {
        return $this->abilities[$name];
    }

    function hasTalent($talentID) {
        return $this->talents & $talentID;
    }

    function getTags() {
        return $this->tags;
    }

}
?>
<?php

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

$talentArray = array(
    "All Skilled Up" => 0x1, "Ambidextrous" => 0x2, "Arrow Recovery" => 0x4, "Bigger And Better" => 0x8,
    "Comeback Kid" => 0x10, "Corpse Eater" => 0x20, "Demon" => 0x40, "Duck Duck Goose" => 0x80,
    "Dwarven Guile" => 0x100, "Elemental Affinity" => 0x200, "Escapist" => 0x400, "Executioner" => 0x800,
    "Elemental Ranger" => 0x1000, "Far-Out Man" => 0x2000, "Five Star Diner" => 0x4000,
    "Glass Cannon" => 0x8000, "Guerrilla" => 0x10000, "Hothead" => 0x20000, "Ice King" => 0x40000,
    "Ingenious" => 0x80000, "Leech" => 0x100000, "Living Armour" => 0x200000, "Lone Wolf" => 0x400000,
    "Mnemonic" => 0x800000, "Morning Person" => 0x1000000, "Opportunist" => 0x2000000, "Parry Master" => 0x4000000,
    "Pet Pal" => 0x8000000, "Picture Of Health" => 0x10000000, "Savage Sortilege" => 0x20000000,
    "Slingshot" => 0x40000000, "Sophisticated" => 0x80000000, "Stench" => 0x100000000,
    "Sturdy" => 0x200000000, "The Pawn" => 0x400000000, "Torturer" => 0x800000000,
    "Unstable" => 0x2000000000, "Walk It Off" => 0x4000000000, "What A Rush" => 0x8000000000
);

$talentDescriptions = array(
    "All Skilled Up" => "This."
);


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
    public $talents;
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

            $abilities = array(
                "Dual Wielding" => 0, "Ranged" => 0, "Single-Handed" => 0,
                "Two-Handed" => 0, "Leadership" => 0, "Perseverance" => 0,
                "Retribution" => 0, "Aerotheurge" => 0, "Geomancer" => 0,
                "Huntsman" => 0, "Hydrosophist" => 0, "Necromancer" => 0,
                "Polymorph" => 0, "Pyrokinetic" => 0, "Scoundrel" => 0,
                "Summoning" => 0, "Warfare" => 0
            );
            $this->talents = 0;
            $this->tags = array();
            $this->name = "";
            $this->level = "";
            $this->background = "";
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
        $infoStr = getInfo();
        $charID = ''; //need some way of getting the username of the given character, only way to correctly alter db tables/info
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        if ($connection->connect_error) die($connection->connect_error);

        $query = "UPDATE character_table
                  SET characterInfoString = '$infoStr'
                  WHERE charID = '$charID';";

        $result = $connection->query($query);
        if (!$result) die($connection->error);

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
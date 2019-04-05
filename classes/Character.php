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
    "All Skilled Up" => 0x1, "Ambidextrous" => 0x2, "Ancestral Knowledge" => 0x4, "Arrow Recovery" => 0x8,
    "Bigger and Better" => 0x10, "Comeback Kid" => 0x20, "Corpse Eater" => 0x40, "Demon" => 0x80,
    "Duck Duck Goose" => 0x100, "Dwarven Guile" => 0x200, "Elemental Affinity" => 0x400,
    "Elemental Ranger" => 0x800, "Escapist" => 0x1000, "Executioner" => 0x2000, "Far-Out Man" => 0x4000,
    "Five Star Diner" => 0x8000, "Glass Cannon" => 0x10000, "Guerrilla" => 0x20000, "Hothead" => 0x40000,
    "Ice King" => 0x80000, "Ingenious" => 0x100000, "Leech" => 0x200000, "Living Armour" => 0x400000,
    "Lone Wolf" => 0x800000, "Mnemonic" => 0x1000000, "Morning Person" => 0x2000000,
    "Opportunist" => 0x4000000, "Parry Master" => 0x8000000, "The Pawn" => 0x10000000,
    "Pet Pal" => 0x20000000, "Picture of Health" => 0x40000000, "Savage Sortilege" => 0x80000000,
    "Slingshot" => 0x100000000, "Sophisticated" => 0x200000000, "Spellsong" => 0x400000000,
    "Stench" => 0x800000000, "Sturdy" => 0x1000000000, "Thrifty" => 0x2000000000,
    "Torturer" => 0x4000000000, "Unstable" => 0x8000000000, "Walk It Off" => 0x10000000000,
    "What A Rush" => 0x20000000000, "Undead" => 0x40000000000
);

$talentDescriptions = array(
    "All Skilled Up" => "All Skilled Up immediately gives you 1 extra Combat Ability point and 1 extra Civil Ability point.",
    "Ambidextrous" => "Reduces the cost of using grenades and scrolls by 1AP if your offhand is free.",
    "Ancestral Knowledge" => "Gives you +1 to Loremaster.",
    "Arrow Recovery" => "Grants a 33% chance to recover a special arrow after firing it.",
    "Bigger and Better" => "Immediately grants 2 extra attribute points.",
    "Comeback Kid" => "Once per combat, if an enemy lands a fatal blow, Comeback Kid will help you bounce back to life with 20% health. If you die and are resurrected in combat, Comeback Kid will be available again.",
    "Corpse Eater" => "Lets you eat body parts to access the memory of the dead.",
    "Demon" => "Gain 15% fire resistance and 15% water weakness. Max fire resistance also increases by 10. Cannot be used with Ice King.",
    "Duck Duck Goose" => "Lets you evade attacks of opportunity.",
    "Dwarven Guile" => "Gives you +1 in Sneaking.",
    "Elemental Affinity" => "Lowers the Action Point cost of spells by 1 when standing in a surface of the same element.",
    "Elemental Ranger" => "Arrows will deal bonus elemental damage depending on the surface the target is standing in.",
    "Escapist" => "Allows you to flee combat even when enemies are right next to you.",
    "Executioner" => "Gain 2 AP after dealing a killing blow (once per turn). Does not work with The Pawn.",
    "Far-Out Man" => "Increase the range of spells and scrolls by 2m. Does not affect melee and touch-ranged skills.",
    "Five Star Diner" => "Doubles the effects of foods and potions.",
    "Glass Cannon" => "You start every combat round with Maximum AP, but Magic and Physical Armour do not protect you from statuses.",
    "Guerrilla" => "While sneaking, your attack damage is increased by 40%. Reduces the AP cost of sneaking in combat by 1 AP, to 3 AP.",
    "Hothead" => "While you are at maximum Vitality, Hothead grants you an extra 10% critical chance and 10% more accuracy.",
    "Ice King" => "Grants +15% Water resistance and +15% fire weakness. Max water resistance is raised by 10. Cannot work with Demon.",
    "Ingenious" => "Gives you 5% bonus Critical Chance and 10% extra Critical Multiplier.",
    "Leech" => "Heals you when standing in blood.",
    "Living Armour" => "35% of all healing you receive is added to your Magic Armour.",
    "Lone Wolf" => "Lone Wolf provides +2 Max AP, +2 Recovery AP, +30% Vitality, +30% Physical Armour, +30% Magic Armour, and doubles invested points in attributes - up to a maximum of 40- and combat abilities (except Polymorph ability) - up to a maximum of 10, while you are adventuring solo or with at most one companion. This bonus is temporarily removed while there are more than two members in the current party.",
    "Mnemonic" => "Gives you 3 extra points in your Memory attributes.",
    "Morning Person" => "When resurrected, you resurrect to full health.",
    "Opportunist" => "Gives you the ability to perform attacks of opportunity.",
    "Parry Master" => "Gives you a 10% bonus dodge chance while dual wielding.",
    "The Pawn" => "Permits your character 1 AP worth of free movement per turn. Does not work with Executioner.",
    "Pet Pal" => "Enables you to talk to animals.",
    "Picture of Health" => "Grants +3% extra Vitality for every point of Warfare.",
    "Savage Sortilege" => "Gives all magical skills a critical chance equal to your critical chance score.",
    "Slingshot" => "Adds an extra 5m range to your grenade throws.",
    "Sophisticated" => "Gives you +10% Fire Resistance and +10% Poison Resistance.",
    "Spellsong" => "Gives you +1 to Persuasion.",
    "Stench" => "Decreases everyone's attitude towards you by 25, but melee combatants will find you less attractive.",
    "Sturdy" => "Gives you +10% max Vitality and +5% Dodging.",
    "Thrifty" => "Gives +1 to Bartering",
    "Torturer" => "With Torturer, certain statues caused by you are no longer blocked by Magic or Physic Armour, and their duration is extended by one turn. Burning, Poisoned, Bleeding, Death Wish, and Ruptured Tendons are affected by this talent.",
    "Unstable" => "You explode upon death, dealing 50% of your vitality as physical damage in a 3 meter radius.",
    "Walk It Off" => "Reduces all status durations by 1 turn. This also affects positive statuses.",
    "What A Rush" => "Increases your recovery and maximum Action Points by 1 when your health is below 50%.",
    "Undead" => "Lets you heal from poison, but regular healing will damage you instead."
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
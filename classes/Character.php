<?php

require_once '../Database_Access/login.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$GLOBALS['connection'] = new mysqli($hn, $un, $pw, $db);
if ($GLOBALS['connection']->connect_error) die($GLOBALS['connection']->connect_error);

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

Bartering
Lucky Charm
Persuasion
Loremaster
Telekinesis
Sneaking
Thievery
*/

$talentNames = array(
    "All Skilled Up",    "Ambidextrous",    "Ancestral Knowledge", "Arrow Recovery",
    "Bigger and Better", "Comeback Kid",    "Corpse Eater",        "Demon",
    "Duck Duck Goose",   "Dwarven Guile",   "Elemental Affinity",  "Elemental Ranger",
    "Escapist",          "Executioner",     "Far-Out Man",         "Five Star Diner",
    "Glass Cannon",      "Guerrilla",       "Hothead",             "Ice King",
    "Ingenious",         "Leech",           "Living Armour",       "Lone Wolf",
    "Mnemonic",          "Morning Person",  "Opportunist" ,        "Parry Master",
    "The Pawn",          "Pet Pal",         "Picture of Health",   "Savage Sortilege",
    "Slingshot",         "Sophisticated",   "Spellsong",           "Stench",
    "Sturdy",            "Thrifty",         "Torturer",            "Unstable",
    "Walk It Off",       "What A Rush",     "Undead"
);

$talentCodes = array();
for ($i = 0; $i < sizeof($talentNames); $i++) {
    $code = intval(pow(2, $i));
    $talentCodes[$talentNames[$i]] = $code;
}

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

// Combat Abilities
$weaponCombatAbilityNames  = array("Dual Wielding", "Ranged", "Single-Handed", "Two-Handed");
$defenceCombatAbilityNames = array("Leadership", "Perseverance", "Retribution");
$skillCombatAbilityNames   = array(
    'Aerotheurge', 'Geomancer', 'Huntsman',
    'Hydrosophist', 'Necromancer', 'Polymorph',
    'Pyrokinetic', 'Scoundrel', 'Summoning',
    'Warfare'
);

// Combine Combat Abilities
$combatAbilities = array_merge(
    $weaponCombatAbilityNames,
    $defenceCombatAbilityNames,
    $skillCombatAbilityNames
);

// Civil Abilities
$personalityCivilAbilities = array('Bartering', 'Lucky Charm', 'Persuasion');
$craftingCivilAbilities = array('Loremaster', 'Telekinesis');
$nastyCivilAbilities = array('Sneaking', 'Thievery');

// Combine Civil Abilities
$civilAbilities = array_merge(
    $personalityCivilAbilities,
    $craftingCivilAbilities,
    $nastyCivilAbilities
);

// Combine All Abilities
$abilities = array_merge($combatAbilities, $civilAbilities);

// Give Descriptions of Abilities
$abilityDescriptions = array(
    "Dual Wielding" => "Dual Wielding increases damage and Dodging when dual-wielding two one-handed weapons.",
    "Ranged"        => "Ranged increases damage and Critical Chance when using bows and crossbows.",
    "Single-Handed" => "Single-handed increases damage and Accuracy when using a one-handed weapon (dagger, sword, axe, mace or wand) with a shield or empty off-hand.",
    "Two-Handed"    => "Two-Handed increases damage and critical multiplier when using two-handed melee weapon (Sword, axe, mace, spear or staff).",
    "Leadership"    => "Leadership grants dodging and resistance bonuses to all allies in a 5m radius.",
    "Perseverance"  => "Perseverance restores Magic Armor after you recover from Frozen or Stunned, and restores Physical Armor after knocked down or Petrified.",
    "Retribution"   => "Retribution reflects received damage to your attacker.",
    "Aerotheurge"   => "Aerotheurge increases all Air damage you deal.",
    "Geomancer"     => "Geomancer increases all Poison and Earth damage you deal, and any Physical Armour restoration you cause.",
    "Huntsman"      => "Huntsman increases the damage bonus when attacking from high ground.",
    "Hydrosophist"  => "Hydrosophist increases all Water damage you deal, and any Vitality healing or Magic Armour restoration that you cause.",
    "Necromancer"   => "heals you every time you deal damage to Vitality. Damage from reflection effects yields half heal. Also increase the damage dealt by Necromancy skills.",
    "Polymorph"     => "Polymorph provides one free attribute point per point invested.",
    "Pyrokinetic"   => "Pyrokinetic increases all Fire damage you deal.",
    "Scoundrel"     => "Scoundrel increases movement speed and boosts your Critical Modifier.",
    "Summoning"     => "Summoning increases Vitality, Damage, Physical Armour and Magical Armour of your summons and totems.",
    "Warfare"       => "Warfare increases all Physical damage you deal.",
    "Bartering"     => "Bartering improves your haggling skills with traders.",
    "Lucky Charm"   => "Lucky Charm increases your likelihood of finding extra treasure whenever loot is stashed.",
    "Persuasion"    => "Persuasion helps you convince characters to do your bidding in dialogues, and increases how much characters like you.",
    "Loremaster"    => "Loremaster identifies enemies and allows you to identify items. Increasing Loremaster allows you to identify more, faster.",
    "Telekinesis"   => "Telekinesis allows you to move items telepathically regardless of weight.",
    "Sneaking"      => "Sneaking determines how well you can sneak without getting caught.",
    "Thievery"      => "Thievery improves your lockpicking and pickpocketing skills."
);

$attributes = array(
    'Strength', 'Finesse', 'Intelligence',
    'Constitution', 'Memory', 'Wits'
);

$attributeDescriptions = array(
    "Strength"     => "Increases the damage dealt with strength-based weapons and skills, as well as the carry weight and the ability to move heavier objects. This is also a prerequisite for Heavy armors that focus more on physical armor than magical armor.",
    "Finesse"      => "Increases damage dealt with finesse-based weapons and skills, and certain amounts of it are necessary for higher grade Leather armors that have balanced defenses.",
    "Intelligence" => "Increases damage dealt with intelligence-based weapons and skills. Also a prerequisite for Magical armors.",
    "Constitution" => "Determines the amount of Vitality  the character has. Also a prerequisite for higher-grade Shields.",
    "Memory"       => "Determines how many Skills can be memorized at any one time.  Most skills only require a single memory slot. More powerful skills require more memory slots and source points.",
    "Wits"         => "Affects your Critical Chance, Initiative, and ability to detect traps and find hidden treasures."
);


class Character {
    // we don't need setters because we will only update
    // when the user submits their changes, meaning that
    // the page will have refreshed and the character
    // info will be converted to a string.
    // All information can then be retrieved from this
    // string.

    // info

    public $attributes;
    public $abilities;
    public $talents;
    public $tags;
    public $level;
    public $name;
    public $background;

    public $connection;



    function __construct($isNew=false, $infoString="DEFAULT INFO STRING") {
        // take character info from a string and use it
        // to assign this character's variables.



        if($isNew == true){
            //if the character is new initialize all values to default
            $this->attributes = array("Strength" => 10, "Finesse" => 10, "Intelligence" => 10, "Constitution" => 10, "Memory" => 10, "Wits" => 10);

            $this->abilities = array(
                "Dual Wielding" => 0, "Ranged" => 0, "Single-Handed" => 0,
                "Two-Handed" => 0, "Leadership" => 0, "Perseverance" => 0,
                "Retribution" => 0, "Aerotheurge" => 0, "Geomancer" => 0,
                "Huntsman" => 0, "Hydrosophist" => 0, "Necromancer" => 0,
                "Polymorph" => 0, "Pyrokinetic" => 0, "Scoundrel" => 0,
                "Summoning" => 0, "Warfare" => 0, "Bartering" => 0,
                "Lucky Charm" => 0, "Persuasion" => 0, "Loremaster" => 0,
                "Telekinesis" => 0, "Sneaking" => 0, "Thievery" => 0
            );

            $this->talents = 0;
            $this->tags = array();
            $this->name = "Default Nameson";
            $this->level = 0;
            $this->background = "This is a story all about how your life got twisted upside down.";
        }

        //if the character being referenced is not new, get the character info string and split it up
        else {

            $CharInfoArray = preg_split(";", $infoString);

            $AttributeSubStr = $CharInfoArray[0];
            $this->attributes = preg_split(",", $AttributeSubStr);

            $AbilitiesSubStr = $CharInfoArray[1];
            $this->abilities = preg_split(",", $AbilitiesSubStr);

            $this->talents = $CharInfoArray[2];

            $TagsSubStr = $CharInfoArray[3];
            $this->tags = preg_split(',', $TagsSubStr);

            $this->level = $CharInfoArray[4];
            $this->name = $CharInfoArray[5];
            $this->background = $CharInfoArray[6];
        }

        $this->connection = $GLOBALS['connection'];


    }

    function uploadCharString($charID){

        $infoStr = getInfo();

        $query = "UPDATE character_table
                  SET characterInfoString = '$infoStr'
                  WHERE charID = '$charID';";

        $result = $this->connection->query($query);
        if (!$result) die($this->connection->error);

    }

    function getInfo() {

        $attrInfoStr = "";
        $abilInfoStr = "";
        $tagInfoStr = "";
        $isfirst = true;

        foreach($this->attributes as $value){
            if($isfirst == true){
                $attrInfoStr = $value;
                $isfirst = false;
            }
            else {
                $attrInfoStr = $attrInfoStr . "," . $value;
            }
        }
        $isfirst = true;
        foreach($this->abilities as $value){
            if($isfirst == true){
                $abilInfoStr = $value;
                $isfirst = false;
            }
            else {
                $abilInfoStr = $abilInfoStr . "," . $value;
            }
        }
        $isfirst = true;
        foreach($this->tags as $value){
            if($isfirst == true){
                $tagInfoStr = $value;
                $isfirst = false;
            }
            else {
                $tagInfoStr = $tagInfoStr . "," . $value;
            }
        }
        $fullInfoStr = $attrInfoStr . ";" . $abilInfoStr . ";" . $this->talents . ";" . $tagInfoStr . ";" . $this->level . ";" . $this->name . ";" . $this->background;
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
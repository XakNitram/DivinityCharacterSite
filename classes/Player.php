<?php
require_once "Character.php";

class Player extends Account {
    public $character;
    public $name;

    function __construct($name, $isNew=false) {
        Account::__construct($name, 'player', $isNew);
        $this->character = new Character(true);
    }

    function getCharacter() {
        return $this->character;
    }
}
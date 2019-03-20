<?php

class Game {
    private $ID;
    private $admin;
    private $players;

    function __construct(
        $admin, $players,
        $isNew=false
    ) {
        $this->admin = $admin;
        $this->players = $players;

        if ($isNew) {
            echo "GAME CREATED";
        }
    }

    function end() {
        // will only be done on
        // confirmation page.
        // SQL query
    }

    function getID() {
        return $this->ID;
    }

    function getAdmin() {
        return $this->admin;
    }

    function getPlayer($name) {
        return $this->players[$name];
    }
}

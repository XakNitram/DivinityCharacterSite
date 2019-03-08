<?php
class Account {
    private $name;

    function __construct($name) {
        $this->name = $name;
    }

    function createNew($name) {
        $this->name = $name;
        // SQL query to insert
    }
}

<?php
class Account {
    private $type;
    private $name;

    function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
    }

    function create_new($name, $type) {
        $this->type = $type;
        $this->name = $name;
        // SQL query to insert
    }
}

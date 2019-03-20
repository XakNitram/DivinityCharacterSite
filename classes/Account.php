<?php
class Account {
    private $name;
    public $type;

    function __construct($name, $type, $isNew=false) {
        $this->name = $name;
        $this->type = $type;

        if ($isNew) {
            // Create database entry here.
            echo "CREATED ACCOUNT";
        }
    }
}

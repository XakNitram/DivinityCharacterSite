<?php

class GameMaster extends Account {
    function __construct($name, $isNew = false) {
        parent::__construct(
            $name, 'admin',
            $isNew
        );
    }
}
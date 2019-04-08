<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../Database_Access/login.php';

global $connection;
$GLOBALS['connection'] = new mysqli($hn, $un, $pw, $db);


class Game {

    public $ID;
    public $admin;
    public $players;
    public $connection;

    function __construct(
        $admin, $players,
        $isNew=false
    ) {
        $this->ID = 0;
        $this->admin = $admin;
        $this->players = $players;
        $this->connection = $GLOBALS['connection'];
        if ($isNew) {
            echo "GAME CREATED";
            //must create player profiles
        }
    }

    function end() {
        // will only be done on
        // confirmation page.
        // SQL query

        if ($this->connection->connect_error) die($this->connection->connect_error);


        $query = "SELECT charID FROM account_table WHERE gameID = '$this->ID' ";

        $result = $this->connection->query($query);
        if (!$result) die($this->connection->error);

        else {
            foreach ($result->fetch_array(MYSQLI_ASSOC) as $value) {

                $query = "DELETE * FROM character_table WHERE charID = '$value';";

                $result = $this->connection->query($query);
                if (!result) die($this->connection->error);

            }
        }

        $query = "DELETE * FROM account_table WHERE gameID = '$this->ID' ";

        $result = $this->connection->query($query);
        if (!$result) die($this->connection->error);

        $query = "DELETE * FROM game_table WHERE gameID = '$this->ID' ";

        $result = $this->connection->query($query);
        if (!$result) die($this->connection->error);

        /*$query = "DELETE * FROM character_table WHERE gameID = '$this->ID' ";

        $result = $this->connection->query($query);
        if (!$result) die($this->connection->error);*/
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

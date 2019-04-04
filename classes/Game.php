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
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        if ($connection->connect_error) die($connection->connect_error);

        $query = "DELETE * FROM account_table WHERE gameID = '$ID' ";

        $result = $connection->query($query);
        if (!$result) die($connection->error);
        $query = "DELETE * FROM game_table WHERE gameID = '$ID' ";

        $result = $connection->query($query);
        if (!$result) die($connection->error);
        $query = "DELETE * FROM character_table WHERE gameID = '$ID' ";

        $result = $connection->query($query);
        if (!$result) die($connection->error);
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

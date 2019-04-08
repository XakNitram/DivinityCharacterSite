<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../Database_Access/login.php';


$GLOBALS['connection'] = new mysqli($hn, $un, $pw, $db);


class Game {

    public $ID;
    public $GMusername;
    public $GMpassword;
    public $players;
    public $connection;

    function __construct(
        $GMusername, $GMpassword, $players, $gameID="DEFAULT GAME ID",
        $isNew=false
    ) {
        $this->GMusername = $GMusername;
        $this->GMpassword = $GMpassword;
        $this->players = $players;
        $this->connection = $GLOBALS['connection'];

        if ($isNew) {
            $this->ID = random_int(00000000, 99999999);  //should be randomized the first time

            //upload game information to the database
            if ($this->connection->connect_error) die($this->connection->connect_error);
            $query = "INSERT INTO game_table(gameID, numPlayers)
                      VALUES ('$this->ID', '$this->players')";
            $result = $this->connection->query($query);
            if (!$result) die($this->connection->error);

            echo "GAME CREATED";

            require_once "../classes/GameMaster.php";
            //create admin account for GM
            $query = "INSERT INTO account_table(username, password, type, charID, gameID)
                      VALUES ('$this->GMusername', '$this->GMpassword', 'admin', 'default', '$this->ID');";
            $result = $this->connection->query($query);
            if (!$result) die($this->connection->error);

            //must create player profiles

            for($value = 0; $value <= $players - 1; $value++){
                $distinct = false;
                $temp = random_bytes(10);
                $temp2 = random_bytes(10);
                $salt1 = "dcsp15";
                $salt2 = "51pscd";
                $token = hash('ripemd128', "$salt1$temp2$salt2");

                while($distinct == false){

                    $query = "SELECT * FROM account_table WHERE username = '$temp';";
                    $result = $this->connection->query($query);
                    if (!$result){
                        $distinct = true;
                    }
                    else{
                        $temp = random_bytes(10);
                    }
                }

                $query = "INSERT INTO account_table(username, password, type, charID, gameID)
                          VALUES ('$temp', '$token', 'player', 'default', '$this->ID');";

                $result = $this->connection->query($query);
                if (!$result) die($this->connection->error);

            }
        }
        else{
            $this->ID = $gameID;

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

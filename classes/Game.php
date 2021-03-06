<?php

require_once '../Database_Access/login.php';


$GLOBALS['connection'] = new mysqli($hn, $un, $pw, $db);
if ($GLOBALS['connection']->connect_error) die($GLOBALS['connection']->connect_error);

class Game {

    public $ID;
    public $GMusername;
    public $GMpassword;
    public $players;
    public $gameDescription;
    public $GMemail;
    public $playerInfoString;
    public $connection;

    function __construct(
        $GMusername, $GMpassword, $players, $gameDescription, $isNew=false, $gameID="DEFAULT GAME ID"
    ) {
        $this->GMusername = $GMusername;
        $this->GMpassword = $GMpassword;
        $this->players = $players;
        $this->gameDescription = $gameDescription;

        $this->connection = $GLOBALS['connection'];

        if ($isNew) {

            $distinct = false;
            $this->ID = mt_rand(00000000, 99999999);  //should be randomized the first time

            while(!$distinct){

                $query = "SELECT gameID FROM game_table WHERE gameID = '$this->ID';";
                $result = $this->connection->query($query);

                if ($result->num_rows === 0){
                    $distinct = true;
                }
                else{
                    $this->ID = mt_rand(00000000, 99999999);
                }
            }
            //upload game information to the database

            $query = "INSERT INTO game_table(gameID, numPlayers, gameDescription)
                      VALUES ('$this->ID', '$this->players', '$this->gameDescription')";
            $result = $this->connection->query($query);
            if (!$result) die($this->connection->error);

            echo "GAME CREATED";
            $salt1 = "dcspg15";
            $salt2 = "51gpscd";

            //create admin account for GM
            $this->GMpassword = hash('ripemd128', "$salt1$this->GMpassword$salt2");

            $query = "INSERT INTO account_table(username, password, type, charID, gameID, isChanged)
                      VALUES ('$this->GMusername', '$this->GMpassword', 'admin', 'default', '$this->ID', 1);";
            $result = $this->connection->query($query);
            if (!$result) die($this->connection->error);

            //must create player profiles
            $playerInfoString = "";
            for($value = 0; $value <= $players - 1; $value++){
                $distinct = false;


                $temp = mt_rand(00000000, 99999999);
                $temp2 = mt_rand(00000000, 99999999);

                //substr(md5(microtime()), rand(0,26), 10 )

                $count = $value + 1;
                $playerInfoString = $playerInfoString."Player ".$count."\nUsername: ".$temp."\nPassword: ".$temp2."\n\n";
                $token = hash('ripemd128', "$salt1$temp2$salt2");
                //$temp and $temp2 must be sent to user
                while(!$distinct){

                    $query = "SELECT * FROM account_table WHERE username = '$temp';";
                    $result = $this->connection->query($query);
                    if ($result->num_rows === 0){
                        $distinct = true;
                    }
                    else{
                        $temp = mt_rand(00000000, 99999999);
                    }
                }

                //$distinct = false;
                $character = mt_rand(00000000, 99999999);

                /*while(!$distinct){

                    $query = "SELECT * FROM game_table WHERE charID = '$character';";
                    $result = $this->connection->query($query);

                    if ($result->num_rows === 0){
                        $distinct = true;
                    }
                    else{
                        $character = mt_rand(00000000, 99999999);
                    }
                }*/
                require_once "../classes/Character.php";

                $charClass = serialize(NEW Character());

                $query = "INSERT INTO character_table(charID, charClass)
                          VALUES ('$character','$charClass');";

                $result = $this->connection->query($query);
                if (!$result) die($this->connection->error);

                $query = "INSERT INTO account_table(username, password, type, charID, gameID, isChanged)
                          VALUES ('$temp', '$temp2', 'player', '$character', '$this->ID', 0);";

                $result = $this->connection->query($query);
                if (!$result) die($this->connection->error);

            }

            /*$headers = 'From: pluto.cse.msstate.edu' . "\r\n" .
                'Reply-To: pluto.cse.msstate.edu' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();*/
            $this->playerInfoString = $playerInfoString;
            //mail($this->GMemail, "Your Players' Account info!", $playerInfoString."\n\nStart your adventure!", $headers);

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

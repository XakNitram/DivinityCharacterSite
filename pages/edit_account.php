<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php

    require_once("../classes/Character.php");

// ****** Variable Initialization ******
$username = "";
$type = "";

session_start();
if (isset($_SESSION['type'])) {
    $type = $_SESSION['type'];
    if ($type == 'admin') {
        $username = $_GET['player'];
    }
}

if (!$username) {
    if (!isset($_SESSION['username'])) {
        $username = "UNKNOWN USER";
    } else {
        $username = $_SESSION['username'];
    }
}

if (!isset($_SESSION['character'])) {
    $character = new Character(true);
    $talents = mt_rand(0, intval(pow(2, 43)));
    $character->talents = $talents;
    $character->name = "Sebille";

    foreach ($character->abilities as $key => &$value) {
        $value = mt_rand(0, 20);
    }

    $_SESSION['character'] = serialize($character);
}
else {
    $character = unserialize($_SESSION['character']);
}
    ?>
    <title><?php echo $username; ?></title>
</head>
<body>
<div>
    <form id="edit_account"   method="post" action="">
        <div class="form_description">
            <h2>Untitled Form</h2>
            <p>Edit Password</p>
        </div>
        <


                <label class="description" for="element_1">Username </label>
                <div>
                    <input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/>
                </div>

                <label class="description" for="element_2">Old Password </label>
                <div>
                    <input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/>
                </div>

                <label class="description" for="element_3">New Password </label>
                <div>
                    <input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value=""/>
                </div>


            <li class="buttons">
                <input type="hidden" name="form_id" value="58628" />

                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
            </li>

    </form>

</div>
<?php

?>
</body>
</html>
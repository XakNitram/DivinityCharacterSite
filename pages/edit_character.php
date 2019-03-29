<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php
    $username = "";
    $characterName = "";  // should be $character->name;
    // Get user info; Create Character and Player classes here.
    ?>
    <title><?php echo "$characterName ($username)"; ?></title>
</head>
<body>
<div id="talents_container">

    <h1><a>Edit Character</a></h1>
    <form id="form_56566" class="appnitro"  method="post" action="">
        <div class="form_description">
            <h2>Edit Character</h2>
            <p>Edit your character here</p>
        </div>
        <ul >

            <li id="li_1" >
                <label class="description" for="element_1">Drop Down </label>
                <div>
                    <select class="element select medium" id="element_1" name="element_1">
                        <option value="" selected="selected"></option>
                        <option value="1" >First option</option>
                        <option value="2" >Second option</option>
                        <option value="3" >Third option</option>

                    </select>
                </div><p class="guidelines" id="guide_1"><small>Select Your talent then press the submit talents button</small></p>
            </li>

            <li class="buttons">
                <input type="hidden" name="form_id" value="56566" />

                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit Talents" />
            </li>
        </ul>
    </form>
    <?php

    ?>
</body>
</html>
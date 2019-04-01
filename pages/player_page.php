<!--Perhaps the admin and player pages should be merged?-->

<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>DivinityHub</title>
    <link rel="stylesheet" type="text/css" href="../styles/general.css">
    <style>
        body {
            background: #000000;
        }
        .content {
            width: 1024px;
        }

        .wide-3 {
            margin: 16px;
            width: calc(100% - 32px);
        }
        .wide-2 {
            margin: 8px;
            width: calc(100% - 16px);
        }

        .bordered {
            border: 1px solid #333333;
        }

        td.picture {
            width: 25%;
        }

        .center {
            text-align: center;
        }

        .no-margin {
            margin-top: 0;
            margin-bottom: 0;
        }

        td.info {
            width: 75%;
        }
    </style>
</head>
<body>
<?php
require_once("../classes/Character.php");

session_start();
$username = "Dickleberg";
$character = new Character(true);
$character->name = "Sebille";
$tab = $_GET['tab'];
?>

<div class="content">
    <table class="wide-3">
        <tr>
            <!--Picture section-->
            <td class="bordered picture">
                <div class="wide-2 bordered">
                    <h1 class="center no-margin">
                        <?php echo $username; ?>
                    </h1>

                    <h3 class="center no-margin"
                        style="color: #888888"
                    >
                        <?php echo $character->name; ?>
                    </h3>
                </div>
            </td>

            <!--Information Section-->
            <td class="bordered info">
                <div class="wide-2 bordered">
                    <p>CONTENT MOTHER FUCKER</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php
//    session_unset();
//    session_destroy();
?>
</body>
</html>

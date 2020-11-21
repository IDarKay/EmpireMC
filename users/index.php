<html lang="fr">
    <head>
        <title>EmpireMC Stats</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="icon" type="image/png" href="../img/ico.png"/>
        <link rel="stylesheet" type="text/css" href="../main.css" />
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <script type="text/javascript" src="javascript/index_script.js"></script>
        <script type="text/javascript" src="../javascript/EmpireUtils.js"></script>
    </head>
    <body onload="init()">
        <div id="dom-target" style="display: none;">
            <?php
                include "../helper.php";
                checkUpdate();

                if(isset($_GET['UUID']))
                {
                    try
                    {

                        $stats = file_get_contents("../tmp/stats/" . $_GET['UUID'] . ".json");
                        echo $stats;
                    }
                    catch (Exception $e1)
                    {
    //                    echo $e1->getMessage();
                        header("location: ./search_user.html?error=Le+joueur+n'est+pas+sure+le+serveur+!");
                        return;
                    }
                }
                else
                {
                    header("location: ./search_user.html");
                }
            ?>
        </div>
        <div id="dom-target-key" style="display: none">
            <?php
                $key = file_get_contents("../data/key.json");
                echo $key;
            ?>
        </div>
        <div id="viewport">
            <div id="categories-div">
                <button onclick="showCustom()">Génerale</button>
                <button onclick="showBlock()">Block / Item</button>
                <button onclick="showMob()">Mob</button>
            </div>
            <div id="table-div">
                <table id="table">
                    <tr>
                        <th colspan="100%"> <?php echo $_GET['user']?> </th>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>

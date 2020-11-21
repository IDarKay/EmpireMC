<html>
    <head>
        <title>EmpireMC Stats</title>
        <!--		<meta charset="UTF-8">-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="icon" type="image/png" href="../img/ico.png"/>
        <link rel="stylesheet" type="text/css" href="../main.css" />
        <link rel="stylesheet" type="text/css", href="./css/filter.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
        <script src="../javascript/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="javascript/filter_script.js"></script>
        <script type="text/javascript" src="../javascript/EmpireUtils.js"></script>


    </head>
    <body onload="init()">
        <div id="dat" style="display: none;">
            <?php
                $key = file_get_contents("../data/key.json");
                echo $key;
            ?>
        </div>
        <div id="dom-target-key" style="display: none">
            <?php
            $key = file_get_contents("../data/key.json");
            echo $key;
            ?>
        </div>
        <div id="categories-div">
            <button onclick="setSelect('custom')">Génerale</button>
            <button onclick="setSelect('block')">Block / Item</button>
            <button onclick="setSelect('mob')">Mob</button>
        </div>
        <form method="get" action="index.php">
            <select id="key-select" name="key">
            </select>
            <input type="submit" value="Valider" />
        </form>
    </body>
</html>
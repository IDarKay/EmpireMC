<html>
    <head>
        <title>EmpireMC Stats</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="icon" type="image/png" href="../img/ico.png"/>
        <link rel="stylesheet" type="text/css" href="../main.css" />
        <link rel="stylesheet" type="text/css" href="./css/index.css" />
        <script type="text/javascript" src="./javascript/index_script.js"></script>
        <script type="text/javascript" src="../javascript/EmpireUtils.js"></script>
    </head>
    <body onload="init()">
        <div id="dom-target" style="display: none">
            <?php
                if(isset($_GET['key']))
                {
                    $split_key = explode(';', $_GET['key']);

                    include "../helper.php";
                    checkUpdate();
                    $data = array("category" => $split_key[0], "key" => $split_key[1]);
                    $sub_data = array();
                    $username_cache = json_decode(file_get_contents("../data/uuid_username.json"), true);

                    $files = scandir("../tmp/stats");
                    if(!empty($files))
                    {
                        foreach ($files as $entry)
                        {
                            if ($entry == '.' || $entry == '..') continue;
                            $json = json_decode(file_get_contents("../tmp/stats/$entry"), true)['stats'];
                            $current_dat = array();
                            switch ($split_key[0])
                            {
                                case "custom":
                                    $current_dat = readCat($current_dat, "minecraft:custom", $split_key[1], $json);
                                    break;
                                case "mob":
                                    $current_dat = readCat($current_dat, "minecraft:killed", $split_key[1], $json);
                                    $current_dat = readCat($current_dat, "minecraft:killed_by", $split_key[1], $json);
                                    break;
                                case "block":
                                    $current_dat = readCat($current_dat, "minecraft:mined", $split_key[1], $json);
                                    $current_dat = readCat($current_dat, "minecraft:broken", $split_key[1], $json);
                                    $current_dat = readCat($current_dat, "minecraft:crafted", $split_key[1], $json);
                                    $current_dat = readCat($current_dat, "minecraft:used", $split_key[1], $json);
                                    $current_dat = readCat($current_dat, "minecraft:picked_up", $split_key[1], $json);
                                    $current_dat = readCat($current_dat, "minecraft:dropped", $split_key[1], $json);
                            }
                            $uuid = explode('.', $entry)[0];
                            $name = isset($username_cache[$uuid]) ? $username_cache[$uuid] : "unknown";
                            array_push($sub_data, array($current_dat, $uuid, $name));
                        }
                    }
                    $data['data'] = $sub_data;
                    echo json_encode($data);
                }
                else
                {
                    header("location: ./filter.php");
                }

                function readCat($array, $categories, $key, $json)
                {
                    if(array_key_exists($categories, $json))
                    {
                        $c = $json[$categories];
                        $array[$categories] = array_key_exists($key, $c) ? $c[$key] : 0;
                    }
                    else
                    {
                        $array[$categories] = 0;
                    }
                    return $array;
                }
            ?>
        </div>
        <div id="dom-target-key" style="display: none">
            <?php
            $key = file_get_contents("../data/key.json");
            echo $key;
            ?>
        </div>
        <div id="table-div" style="overflow-y: auto">
            <table id="table">

            </table>
        </div>
    </body>
</html>
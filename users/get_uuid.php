<?php

    if(isset($_GET['username']))
    {
        $username = htmlspecialchars($_GET['username']);
        $cache = json_decode(file_get_contents("../data/username_uuid.json"), true);
        $cache2 = json_decode(file_get_contents("../data/uuid_username.json"), true);
        $uuid = "";
        if(!(isset($_GET['force']) && $_GET['force'] === 'true') && array_key_exists($username, $cache))
        {
            $uuid = $cache[$username];
        }
        else
        {
            $xml_uuid = file_get_contents("https://api.mojang.com/users/profiles/minecraft/" . $username . "?at=" . (new DateTime)->getTimestamp());
            $xml_json = json_decode($xml_uuid, true);
            if(!array_key_exists("id", $xml_json))
            {
                header("location: ./search_user.html?error=Nom+invalide");
                return;
            }
            $uuid = un_strip_uuid($xml_json['id']);

            $cache[$username] = $uuid;
            $fp = fopen("../data/username_uuid.json", 'w');
            fwrite($fp, json_encode($cache));
            fclose($fp);
            $cache2[$uuid] = $username;
            $fp = fopen("../data/uuid_username.json", 'w');
            fwrite($fp, json_encode($cache2));
            fclose($fp);
        }
//        if(!isset($uuid) || $uuid.length === 0)
//        {
//            header("location: ./search_user.html?error=Nom+invalide");
//            return;
//        }
        header("location: ./index.php?UUID=" . $uuid . "&user=" . $username);
    }
    else
    {
        header("location: ./search_user.html?error=Acune+Valuer", FALSE);
    }

    function un_strip_uuid($uuid)
    {
        return substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
    }

?>


<?php
    function checkUpdate()
    {
        $time = (int)file_get_contents("../tmp/update");
        $date = (new DateTime)->getTimestamp();
        if (($date - $time) > 600) {
            $connection = ssh2_connect("ip", 2022);
            ssh2_auth_password($connection, "id", "pass");
            $sftp = ssh2_sftp($connection);

            $localDir = '../tmp/stats';
            $remoteDir = '/world/stats';

            $files = scandir('ssh2.sftp://' . $sftp . $remoteDir);
            if (!empty($files)) {
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $fp = fopen("$localDir/$file", 'w');
                        fwrite($fp, file_get_contents('ssh2.sftp://' . $sftp . $remoteDir . '/' . $file));
                        fclose($fp);
    //                                ssh2_scp_recv($connection, "$remoteDir/$file", "$localDir/$file");
                    }
                }
            }

            $fp = fopen("../tmp/update", 'w');
            fwrite($fp, $date);
            fclose($fp);
        }
    }
?>
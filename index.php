<?php
require 'vendor/autoload.php';

use TrueMe\Services\Process;

//Process syschronous
    echo "\n Memory Consumption is   ";
    echo round(memory_get_usage()/1048576,2).''.' MB';
    echo '<br/>============================<br/>';

    $responses = [];
    $start0 = microtime(true);
    echo '============================<br/>';
    echo "Xử lý đồng bộ: 0 <br/>";
    echo '============================<br/>';

    $process = new Process();
    for ($i = 0; $i < 10; $i++) {
        echo $process->getData(); echo "<br/>";
    }


    echo '============================<br/>';
    echo 'Kết xử lý đồng bộ: <span style="color:red; font-size: 20px;">'
        . (microtime(true) - $start0) .' (s)</span><br/>';
    echo '============================<br/>';

    echo "\n Memory Consumption is   ";
    echo round(memory_get_usage()/1048576,2).''.' MB';
    echo '<br/>============================<br/>';

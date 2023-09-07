<?php
require 'vendor/autoload.php';

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Promise\Utils;
use TrueMe\Services\Process;

// Get the global task queue

//Process asychronous
    echo "\n Memory Consumption is   ";
    echo round(memory_get_usage()/1048576,2).''.' MB';
    echo '<br/>============================<br/>';

    $responses = [];
    $start0 = microtime(true);
    echo '============================<br/>';
    echo "Xử lý bất đồng bộ: 0 <br/>";
    echo '============================<br/>';
//////////////////////////////////////////////////////////////////


    /**
     * This is promise get data function and delay 2 seconds
     * @return [type] [description]
     */
    function promiseFunction() { 
        $process = new Process();
        $promise =  new Promise(
             function () use ($process) {

                //Get data api and delay
                $response = $process->getData();
                echo 'promiss funtion getData';
                echo '<br/>';

                return $response;
             },
             function ($promise) {
                $promise->reject(); // just to know which index has failed or rejected.
              }
        );

        return $promise;
    }


    // LOOP....LOOP....LOOP....LOOP....
    $promises = [];
    $promiseResultArray = [];
    for ($i = 0; $i < 5; $i++) {
        $promises[$i] = new Promise();
        $promises[$i]->then(function ($value) use (&$promiseResultArray) {
            $promiseResultArray[] = promiseFunction();

            echo 'loop function';
            echo '<br/>';

            return $promiseResultArray;

        }, function($reason) {});

        $promises[$i]->resolve($i);
        Utils::queue()->run();
    }


    var_dump(2323, $promiseResultArray);die;




//////////////////////////////////////////////////////////////////
    echo '============================<br/>';
    echo 'Kết xử lý bất đồng bộ: <span style="color:red; font-size: 20px;">'
        . (microtime(true) - $start0) .' (s)</span><br/>';
    echo '============================<br/>';

    echo "\n Memory Consumption is   ";
    echo round(memory_get_usage()/1048576,2).''.' MB';
    echo '<br/>============================<br/>';
<?php 
    require('config.php');
    echo 'Test<br>';

    /***
    $netgsm->voice
    ->numbers(['05422156201'])
    ->messages(['Hello World'])
    ->send();*/

    $query = $netgsm->sms
    ->numbers(['05422156201'])
    ->messages('Hello World')
    ->send();

    echo $query;
?>
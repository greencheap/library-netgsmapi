<?php 
    require('../vendor/autoload.php');
    require('../env.php');

    /**
     * Details Env-dev.php For Env.php
     */

    use SenemCO\Netgsm;
    $netgsm = new Netgsm();
    $netgsm->setConfig($conf);

    if($netgsm->errHandler){
        echo '<br><strong>Everything stopped due to error</strong>';
        return false;
    }
?>
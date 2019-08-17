<?php

namespace SenemCO\Helpers;

use Curl\Curl;
use SenemCO\Libraries\Voice;
use SenemCO\Libraries\Sms;

class Main
{
    public $api = 'https://api.netgsm.com.tr/';

    public $errHandler = false;

    public $username;

    public $password;

    public $companyname;

    public function setConfig(array $options = [])
    {
        try {
            $options = array_merge(array_fill_keys(['companyname', 'username', 'password'], ''), $options);
            extract($options, EXTR_SKIP);
            if (!$username) {
                throw new \Exception('Invalid Username');
            }
            $this->username = $username;

            if (!$password) {
                throw new \Exception('Invalid Password');
            }
            $this->password = $password;

            if (!$companyname) {
                throw new \Exception('Invalid Company');
            }
            $this->companyname = $companyname;

            $config = [
                'username' => $this->username,
                'password' => $this->password,
                'companyname' => $this->companyname,
                'api' => $this->api
            ];

            $this->voice = new Voice($config);
            $this->sms = new Sms($config);
        } catch (\Exception $e) {
            $this->errHandler = true;
            echo 'Error: ' . $e->getMessage();
        }
    }
}

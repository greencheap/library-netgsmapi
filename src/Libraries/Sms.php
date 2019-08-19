<?php

namespace SenemCO\Libraries;

use SenemCO\Helpers\Main;

class Sms
{
    public $conf;

    private $numbers;

    private $start;

    private $messages = [];

    public function __construct($options)
    {
        $this->conf = $options;
    }

    public function numbers(array $numbers = [])
    {
        foreach($numbers as $number){
            $this->numbers .= "<no>{$number}</no>";
        }
        return $this;
    }

    public function startDate(string $date = ''){
        $today = new \DateTime('now');
        if($date){
            $today->modify($date);
        }
        $this->start = $today->format('dmYh');
        return $this;
    }

    public function messages(string $messages = '')
    {
        $this->messages = $messages;
        return $this;
    }

    public function send()
    {
        $xml="<?xml version='1.0' encoding='UTF-8'?>
        <mainbody>
            <header>
                <company dil='TR'>{$this->conf['companyname']}</company>
                <usercode>{$this->conf['username']}</usercode>
                <password>{$this->conf['password']}</password>
                <startdate>{$this->start}</startdate>
                <stopdate></stopdate>
                <type>1:n</type>
                <msgheader>{$this->conf['companyname']}</msgheader>
                </header>
                <body>
                <msg><![CDATA[{$this->messages}]]></msg>
                {$this->numbers}
                </body>
        </mainbody>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"{$this->conf['api']}sms/send/xml");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $result = curl_exec($ch);
        return $result;       
    }

    public function registerBlackList( bool $option = false , array $registerNumbers = []){
        if(!$registerNumbers){
            return false;
        }
        $numbers = '';

        if(!$option){
            $option = 2;
        }

        foreach($registerNumbers as $number){
            $numbers .= "<number>{$number}</number>";
        }

        $xml="<?xml version='1.0' encoding='UTF-8'?>
        <mainbody>
            <header>
                    <company>Netgsm</company>
                    <usercode>{$this->conf['username']}</usercode>
                    <password>{$this->conf['password']}</password>
                    <tip>{$option}</tip>
                </header>
                <body>
                    {$numbers}
                </body>
        </mainbody>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"{$this->conf['api']}sms/blacklist/xml");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $result = curl_exec($ch);
        return $result;     
    }

    public function receive(){
        $xml="<?xml version='1.0' encoding='UTF-8'?>
        <mainbody>
            <header>
                    <usercode>{$this->conf['username']}</usercode>
                    <password>{$this->conf['password']}</password>
                    <startdate></startdate>
                    <stopdate></stopdate>
                    <type>1</type>
                </header>
        </mainbody>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"{$this->conf['api']}sms/receive/xml");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $result = curl_exec($ch);
        return $result;       
    }
}

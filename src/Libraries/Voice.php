<?php

namespace SenemCO\Libraries;

class Voice
{
    public $conf;

    private $numbers = [];

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

    public function messages(array $messages = [])
    {
        $data = '';
        foreach($messages as $key => $message){
            $data .= "
            <series s='{$key}'>
                {$message}
            </series>
            ";
        }
        $this->messages = $data;
        return $this;
    }

    public function send()
    {
        $xml = "<?xml version='1.0' encoding='UTF-8'?>
        <mainbody>
            <header>
                <usercode>{$this->conf['username']}</usercode>
                <password>{$this->conf['password']}</password>
                <key>0</key>
            </header>
            <body>
                <voicemail>
                    <scenario>
                        {$this->messages}
                        <number>
                            {$this->numbers}
                        </number>
                    </scenario>
                </voicemail>
            </body>
        </mainbody>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->conf['api']}voicesms/send");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $result = curl_exec($ch);
        return $result;
    }
}

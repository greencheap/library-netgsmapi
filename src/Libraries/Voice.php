<?php

namespace SenemCO\Libraries;

use Curl\Curl;

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
        $this->numbers = $numbers;
        return $this;
    }

    public function messages(array $messages = [])
    {
        $this->messages = $messages;
        return $this;
    }

    public function send()
    {

        $curl = new Curl();
        $curl->setHeader('Content-Type', 'text/xml');
        $url = "{$this->conf['api']}voicesms/send";

        $data = "
        <?xml version='1.0'?>
        <mainbody>
            <header>
                <company>NETGSM</company>
                <usercode>" . $this->conf['username'] . "</usercode>
                <password>" . $this->conf['password'] . "</password>
                <startdate></startdate>
                <starttime></starttime>
                <stopdate></stopdate>
                <stoptime></stoptime>
                <key>0</key>
                <version>1</version>
            </header>
            <body>
                <voicemail>
                    <scenario>
                        <series >
                            <text>sese çevrilmesi istenen metin 1</text>
                        </series>
                        <number>
                            <no>905422156201</no>
                        </number>
                    </scenario>
                </voicemail>
            </body>
        </mainbody>
        ";

        $curl->post($url, $data);
        echo ($curl->response);
    }
}

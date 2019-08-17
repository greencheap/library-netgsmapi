<?php

namespace SenemCO\Libraries;

class Sms
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

    public function messages(string $messages = '')
    {
        $this->messages = $messages;
        return $this;
    }

    public function send()
    {
       
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'http://api.netgsm.com.tr/xmlbulkhttppost.asp');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
		$result = curl_exec($ch);
		return $result;
    }
}

<?php

namespace GreenCheap\Components;

use Curl\Curl;
use GreenCheap\NetGsm;
use GreenCheap\Sender;
use Sabre\Xml\Service;

/**
 * Class SmsFoundation
 * @package GreenCheap\NetGSM\Components
 */
class SmsFoundation extends Sender
{

    /**
     * SmsFoundation constructor.
     * @param NetGsm $netgsm
     */
    public function __construct(NetGsm $netgsm)
    {
        $this->setInitialize($netgsm->getInitialize());
    }

    /**
     * @param array|string $numbers
     * @param array|string $message
     * @return object
     */
    public function sendMessage($numbers, $message): object
    {
        if(is_string($numbers)){
            $numbers = [$numbers];
        }

        $phoneNumbers = [];
        foreach($numbers as $number){
            $phoneNumbers[] = [
                'name' => 'no',
                'value' => $number
            ];
        }

        $service = new Service();
        $xmlData = $service->write('mainbody', [
            'header' => (array) $this->getInitialize(),
            'body' => [
                'msg' => '<![CDATA['.$message.']]>',
                $phoneNumbers
            ]
        ]);

        return $this->postXml('https://api.netgsm.com.tr/sms/send/xml' , $xmlData);
    }

    /**
     * @param $startdate
     * @param $stopdate
     * @return object
     */
    public function getMessages($startdate , $stopdate)
    {
        $initialize = $this->getInitialize();
        $service = new Service();
        $xmlData = $service->write('mainbody', [
            'header' => [
                'usercode' => $initialize->usercode,
                'password' => $initialize->password,
                'startdate' => '010720191000',
                'stopdate' => '061220201000',
                'type' => 0
            ],
        ]);

        return $this->postXml('https://api.netgsm.com.tr/sms/receive' , $xmlData);
    }
}


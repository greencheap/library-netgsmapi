<?php

namespace GreenCheap\NetGsm\Components;

use GreenCheap\NetGsm\NetGsm;
use GreenCheap\NetGsm\Sender;
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
     * @return $this
     */
    public function sms($numbers, $message): SmsFoundation
    {
        if(is_string($numbers)){
            $numbers = [$numbers];
        }

        $phoneNumbers = [];
        foreach($numbers as $number){
            $phoneNumbers[] = [
                "name" => "no",
                "value" => $number
            ];
        }

        $service = new Service();
        $this->xmlData = $service->write("mainbody", [
            "header" => (array) $this->getInitialize(),
            "body" => [
                "msg" => "<![CDATA[".$message."]]>",
                $phoneNumbers
            ]
        ]);
        $this->uri = "https://api.netgsm.com.tr/sms/send/xml";
        return $this;
    }

    /**
     * @param $start
     * @param $finish
     * @return object
     * @deprecated
     */
    public function messages($start , $finish): object
    {
        $initialize = $this->getInitialize();
        $service = new Service();
        $this->xmlData = $service->write("mainbody", [
            "header" => [
                "usercode" => $initialize->usercode,
                "password" => $initialize->password,
                "startdate" => $start,
                "stopdate" => $finish,
                "type" => 0
            ],
        ]);
        $this->uri = "https://api.netgsm.com.tr/sms/receive";
        return $this;
    }
}


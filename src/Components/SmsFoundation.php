<?php

namespace GreenCheap\Components;

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
    public function setMessage($numbers = '' , $message): object
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
}

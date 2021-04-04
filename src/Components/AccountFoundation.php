<?php

namespace GreenCheap\NetGsm\Components;

use GreenCheap\NetGsm\NetGsm;
use GreenCheap\NetGsm\Sender;
use Sabre\Xml\Service;

class AccountFoundation extends Sender
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
     * @return $this
     */
    public function getCredit(): AccountFoundation
    {
        $initialize = $this->getInitialize();
        $service = new Service();
        $this->xmlData = $service->write("mainbody", [
            "header" => [
                "usercode" => $initialize->usercode,
                "password" => $initialize->password,
                "stip" => 2
            ],
        ]);
        $this->uri = "https://api.netgsm.com.tr/balance/list/xml";
        return $this;
    }

    /**
     * @return $this
     */
    public function getPackage(): AccountFoundation
    {
        $initialize = $this->getInitialize();
        $service = new Service();
        $this->xmlData = $service->write("mainbody", [
            "header" => [
                "usercode" => $initialize->usercode,
                "password" => $initialize->password,
                "stip" => 1
            ],
        ]);
        $this->uri = "https://api.netgsm.com.tr/balance/list/xml";
        return $this;
    }
}
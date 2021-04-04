<?php

namespace GreenCheap\NetGsm;

use Curl\Curl;

/**
 * Class Sender
 * @package GreenCheap
 */
class Sender
{
    /**
     * @var
     */
    protected $uri;

    /**
     * @var
     */
    protected $xmlData;

    /**
     * @var
     */
    protected $initialize;

    /**
     * @param $initialize
     */
    public function setInitialize($initialize)
    {
        $this->initialize = $initialize;
    }

    /**
     * @return mixed
     */
    public function getInitialize()
    {
        return $this->initialize;
    }

    /**
     * @return mixed
     */
    public function run(): mixed
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]);
        $curl->setTimeout(30);
        $curl->post($this->uri , $this->xmlData);

        if ($curl->error) {
            return (object) [
                "status" => "error",
                "code" => $curl->errorCode,
                "message" => $curl->errorMessage
            ];
        } else {
            return $curl->response;
        }
    }
}

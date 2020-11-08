<?php

namespace GreenCheap;

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
     * @param $uri
     * @param $data
     * @return object
     */
    public function postXml($uri , $data)
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]);
        $curl->setTimeout(30);
        $curl->post($uri , $data);

        if ($curl->error) {
            return (object) [
                'status' => 'error',
                'code' => $curl->errorCode,
                'message' => $curl->errorMessage
            ];
        } else {
            preg_match('/[\w{2}]+/' , $curl->response , $code);
            $code = $code[0];
            return (object) [
                'status' => $code != '00' && $code != '01' && $code != '02' ? 'error':'success',
                'code' => $code,
                'message' => $code != '00' && $code != '01' && $code != '02' ? 'An error has occurred during the sending process. Visit the GreenCheap Documentation.' : $curl->response
            ];
        }
    }
}

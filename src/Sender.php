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
            preg_match('/([0-9{2}+]+)\s?([0-9]+)?/' , $curl->response , $code);

            $messageId = isset($code[2]) ? $code[2] : 'Error';
            $code = $code[1];

            return (object) [
                'status' => $code != '00' && $code != '01' && $code != '02' ? 'error':'success',
                'code' => $code,
                'message_id' => $code != '00' && $code != '01' && $code != '02' ? 'An error has occurred during the sending process. Visit the GreenCheap Documentation.' : $messageId
            ];
        }
    }
}

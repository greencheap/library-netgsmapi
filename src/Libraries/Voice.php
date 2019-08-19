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

    }
}

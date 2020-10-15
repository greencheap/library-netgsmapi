<?php

namespace GreenCheap\Components;

/**
 * Class SmsFoundation
 * @package GreenCheap\NetGSM\Components
 */
class SmsFoundation
{
    /**
     * @var int|array
     */
    protected $numbers;

    /**
     * @var string
     */
    protected string $content;

    /**
     * @param $numbers
     * @return $this
     */
    public function setNumbers($numbers): self
    {
        $this->numbers = $numbers;

        return $this;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }
}

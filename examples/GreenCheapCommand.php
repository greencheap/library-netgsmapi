<?php

namespace GreenCheap\Test;

use GreenCheap\NetGsm\NetGsm;
use Symfony\Component\Console\Command\Command;

/**
 * Class GreenCheapCommand
 * @package GreenCheap\Test
 */
class GreenCheapCommand extends Command
{
    /**
     * @var int
     */
    protected int $configure_user;

    /**
     * @var string
     */
    protected string $configure_password;

    protected $netgsm;

    /**
     * @return string
     */
    protected function getUser(): string
    {
        return getenv("USER");
    }

    /**
     * @return string
     */
    protected function getPassword(): string
    {
        return getenv("PASSWORD");
    }

    /**
     * @return string
     */
    protected function getHeader(): string
    {
        return getenv("HEADER");
    }

    /**
     * @return NetGsm
     */
    protected function getNetGsm(): NetGsm
    {
        $this->netgsm = new NetGsm($this->getUser(), $this->getPassword(), $this->getHeader());
        return $this->netgsm;
    }

}
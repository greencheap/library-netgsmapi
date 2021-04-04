<?php
namespace GreenCheap\Test;

use GreenCheap\NetGsm\Components\AccountFoundation;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetCreditConsole extends GreenCheapCommand
{
    protected static $defaultName = "account:credit";

    protected function configure()
    {
        $this->setDescription("It shows you the credit in your account");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $accountFoundation = new AccountFoundation($this->getNetGsm());
        $value = $accountFoundation->getCredit();
        $data = $value->run();
        $output->writeln("<info>Your credit</info>");
        $output->writeln("<info>-</info> $data");
        return 0;
    }
}
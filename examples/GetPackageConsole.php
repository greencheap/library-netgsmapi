<?php
namespace GreenCheap\Test;

use GreenCheap\NetGsm\Components\AccountFoundation;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPackageConsole extends GreenCheapCommand
{
    protected static $defaultName = "account:package";

    protected function configure()
    {
        $this->setDescription("It shows you the packages in your account");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $accountFoundation = new AccountFoundation($this->getNetGsm());
        $value = $accountFoundation->getPackage();
        $datas = array_filter(explode("<BR>", $value->run()));
        $output->writeln("<info>Your packages</info>");
        foreach ($datas as $data){
            $output->writeln("<info>-</info> $data");
        }
        return 0;
    }
}
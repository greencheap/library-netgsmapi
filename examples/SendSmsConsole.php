<?php
namespace GreenCheap\Test;

use GreenCheap\NetGsm\Components\SmsFoundation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class SendSmsConsole extends GreenCheapCommand
{
    /**
     * @var string
     */
    protected static $defaultName = "sms:send";

    protected function configure()
    {
        $this->setDescription("Allows you to send SMS");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper("question");
        $questionNumber = new Question("Enter the phone number to send an SMS without a leading zero!: ");

        $number = $helper->ask($input, $output, $questionNumber);
        if(!$number){
            $output->writeln("<error>You have to enter a phone number</error>");
            return 0;
        }
        $output->writeln("You have just selected: <info>$number</info>");

        $questionMessage = new Question("Enter the text you want to send: ");

        $message = $helper->ask($input, $output, $questionMessage);
        if(!$message){
            $output->writeln("<error>You have to enter a message</error>");
            return 0;
        }

        $smsFoundation = new SmsFoundation($this->getNetGsm());
        $smsFoundation->sms($number, $message);

        if(!$data = $smsFoundation->run()){
            $output->writeln("<error>There was an error sending it</error>");
            return 0;
        }

        $output->writeln("Output: <info>$data</info>");

        return Command::SUCCESS;
    }
}
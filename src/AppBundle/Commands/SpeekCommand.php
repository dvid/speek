<?php

namespace AppBundle\Commands;

use AppBundle\LoggerDependency;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;

class SpeekCommand extends Command{
    protected function configure()
    {
        $this->setName('say')
             ->setDescription('Speak text')
             ->addArgument(
                 'message', InputArgument::OPTIONAL, 'What should I say?', 'Hello World'
             )
            ->addOption('lang', '--lang', InputArgument::OPTIONAL, 'Language', 'en');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $voice = '--voice ';
        switch ($input->getOption('lang')){
            case 'fr':
                $voice .= 'Thomas';
                break;
            case 'en':
                $voice .= 'Alex';
                break;
        }
        $message = $input->getArgument('message');

        exec('say ' . $message . ' ' . $voice);

        /*
        // Launch command in VERBOSITY_VERY_VERBOSE to be able to see the info message
        // ex: ./speek say "in english" --lang en -vv

        // Otherwhise specify it here as following:
        $verbosityLevelMap = array(
            LogLevel::INFO   => OutputInterface::VERBOSITY_NORMAL,
        );
        */

        $logger = new ConsoleLogger($output);
        $myDependency = new LoggerDependency($logger);
        $myDependency->logInfo($message);
    }
}
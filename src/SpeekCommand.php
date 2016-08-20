<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        exec('say '. $input->getArgument('message').' '.$voice);
        $output->writeln('<info>Said</info>');
    }
}
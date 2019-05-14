<?php

namespace App\Command;

use App\Adapter\MailAdapter;
use App\Controller\MessageController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class MailSendCommand
 * @package App\Command
 */
class MailSendCommand extends Command
{
    protected static $defaultName = 'app:mail:send';
    /**
     * @var MessageController
     */
    private $messageController;

    /**
     * MailSendCommand constructor.
     * @param MessageController $messageController
     */
    public function __construct(MessageController $messageController)
    {
        parent::__construct();
        $this->messageController = $messageController;
    }

    protected function configure()
    {
//        $this
//            ->setDescription('Add a short description for your command')
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        $this->messageController->sendMessages();
    }
}

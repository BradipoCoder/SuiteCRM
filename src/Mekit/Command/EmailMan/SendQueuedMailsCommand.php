<?php
/**
 * Created by Adam Jakab.
 * Date: 29/06/16
 * Time: 14.56
 */

namespace Mekit\Command\EmailMan;

use SuiteCrm\Console\Command\Command;
use SuiteCrm\Console\Command\CommandInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendQueuedMailsCommand extends Command implements CommandInterface
{
  const COMMAND_NAME = 'emailman:send-queued-mails';
  const COMMAND_DESCRIPTION = 'Send Emails in queue';

  /**
   * Constructor
   */
  public function __construct()
  {
    parent::__construct(NULL);
  }

  /**
   * Configure command
   */
  protected function configure()
  {
    $this->setName(static::COMMAND_NAME);
    $this->setDescription(static::COMMAND_DESCRIPTION);
  }

  /**
   * @param InputInterface  $input
   * @param OutputInterface $output
   * @return bool
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    parent::_execute($input, $output);
    $this->log("Starting command " . static::COMMAND_NAME . "...");
    $this->executeCommand();
    $this->log("Command " . static::COMMAND_NAME . " done.");
  }

  /**
   * Execute Command
   */
  protected function executeCommand()
  {
    $this->log(static::COMMAND_NAME . " working...");
  }

}
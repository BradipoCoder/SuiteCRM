<?php
/**
 * Created by Adam Jakab.
 * Date: 06/06/16
 * Time: 14.21
 */

namespace Mekit\Maintenance;

use Mekit\Maintenance\Account\AccountFixer;
use SuiteCrm\Console\Command\Command;
use SuiteCrm\Console\Command\CommandInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixAccountCommand extends Command implements CommandInterface
{
  const COMMAND_NAME = 'fix:account';
  const COMMAND_DESCRIPTION = 'Execute data fixes on accounts...';

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
    $this->setDefinition(
      [
        new InputArgument(
          'config_file', InputArgument::REQUIRED,
          'The yaml(.yml) configuration file inside the "' . $this->configDir . '" subfolder.'
        ),
        //@todo: add --force option to override dry mode
      ]
    );
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
    $fixer = new AccountFixer([$this, 'log']);
    $fixer->execute($input->getOptions());
    $this->log("Command " . static::COMMAND_NAME . " done.");
  }
}
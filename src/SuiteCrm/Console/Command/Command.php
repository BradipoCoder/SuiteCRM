<?php
/**
 * Created by Adam Jakab.
 * Date: 07/10/15
 * Time: 14.27
 */

namespace SuiteCrm\Console\Command;

use Mekit\Console\Configuration;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Command
 *
 * @package SuiteCrm\Console\Command
 */
class Command extends ConsoleCommand {
  /** @var  InputInterface */
  protected $cmdInput;

  /** @var  OutputInterface */
  protected $cmdOutput;

  /** @var string */
  protected $configDir = 'config';

  /**
   * @param string $name
   */
  public function __construct($name = NULL) {
    parent::__construct($name);
  }

  /**
   * @param InputInterface $input
   * @param OutputInterface $output
   */
  protected function _execute(InputInterface $input, OutputInterface $output) {
    $this->cmdInput = $input;
    $this->cmdOutput = $output;
    $this->setConfigurationFile();
  }

  /**
   * Parse yml configuration
   */
  protected function setConfigurationFile() {
    if ($this->cmdInput->hasArgument('config_file')) {
      $config_file = $this->cmdInput->getArgument('config_file');
      $configPath = realpath($config_file);
      if (!$configPath) {
        $configPath = realpath(PROJECT_ROOT . '/config/' . $config_file);
      }
      if (!$configPath) {
        throw new \InvalidArgumentException("The configuration file does not exist!");
      }
      Configuration::initializeWithConfigurationFile($configPath);
    }
  }

  /**
   * @param string $msg
   */
  public function log($msg) {
    $this->cmdOutput->writeln($msg);
  }
}
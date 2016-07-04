<?php
/**
 * Created by Adam Jakab.
 * Date: 01/07/16
 * Time: 17.51
 */

namespace SuiteCrm\Commands\Fix;

use Mekit\Logger\LoggerManager;
use SuiteCrm\Console\Command\Command;
use SuiteCrm\Console\Command\CommandInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RepairCommand extends Command implements CommandInterface
{
    const COMMAND_NAME = 'admin:quick-repair-rebuild';
    const COMMAND_ALIAS = 'qrr';
    const COMMAND_DESCRIPTION = 'Quick Repair and Rebuild';

    /** @var  LoggerManager */
    protected $loggerManager;

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
        $this->setAliases([static::COMMAND_ALIAS]);
        $this->setDescription(static::COMMAND_DESCRIPTION);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return bool
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::_execute($input, $output);
        $this->loggerManager = new LoggerManager($this->cmdOutput);
        $this->log("Starting command " . static::COMMAND_NAME . "...", 'info');
        $this->executeCommand();
        $this->log("Command " . static::COMMAND_NAME . " done.", 'info');
    }

    protected function executeCommand()
    {
        require_once PROJECT_ROOT . '/src/SuiteCrm/Utils/console_entry_point.php';
        require_once(PROJECT_ROOT . '/modules/Administration/QuickRepairAndRebuild.php');

        $actions = array('clearAll');
        $RAC = new \RepairAndClear();
        $RAC->repairAndClearAll($actions, array('All Modules'), TRUE, FALSE);
    }


    /**
     * @param string $msg
     * @param string $level - available: debug|info|warn|deprecated|error|fatal|security|off
     */
    public function log($msg, $level = 'warn')
    {
        //fix for SugarPHPMailer debug level (use -vv to see)
        if(!array_key_exists($level, $this->loggerManager->getLoggerLevels())) {
            $level = 'info';
        }
        $this->loggerManager->log($msg, $level);
    }
}
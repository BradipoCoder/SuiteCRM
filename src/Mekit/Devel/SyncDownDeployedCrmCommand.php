<?php
/**
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2016 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

/**
 * Created by Adam Jakab.
 * Date: 06/06/16
 * Time: 14.21
 */

namespace Mekit\Devel;

use Mekit\Console\Configuration;
use Mekit\System\CommandExecutor;
use SuiteCrm\Console\Command\Command;
use SuiteCrm\Console\Command\CommandInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SyncDownDeployedCrmCommand
 *
 * @package Mekit\Devel
 */
class SyncDownDeployedCrmCommand extends Command implements CommandInterface
{
    const COMMAND_NAME = 'devel:sync-down-deployed-crm';
    const COMMAND_DESCRIPTION = 'Creates a working copy of a remote deployment.';
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(null);
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
            ]
        );
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
        $this->log("Starting command " . static::COMMAND_NAME . "...");
        //$this->log("CFG: " . json_encode(Configuration::getConfiguration(), JSON_PRETTY_PRINT));
        $this->downloadRemoteFiles();
        $this->dumpRemoteDatabase();
        $this->restoreFromRemoteDatabase();
        $this->log("done.");
    }
    
    /**
     * @return array
     * @throws \Exception
     */
    protected function restoreFromRemoteDatabase()
    {
        $cfg = Configuration::getConfiguration();
        $cmd = $cfg["sync"]["database"]["restore"]["sync_command"];
        $args = $cfg["sync"]["database"]["restore"]["sync_arguments"];
        $tempFile = $cfg["sync"]["database"]["temp_file"];
        array_push($args, '< ' . $tempFile);
        
        if (!is_file($tempFile))
        {
            throw new \Exception("Dumped sql file does not exist!");
        }
        
        $this->log("Restoring database...");
        $executor = new CommandExecutor();
        $execResults = $executor->execute($cmd, $args);
        if ($execResults["return_value"] != 0)
        {
            throw new \Exception("Database restore failed:\n" . json_encode($execResults, JSON_PRETTY_PRINT));
        }
        
        return $execResults;
    }
    
    /**
     * @return array
     * @throws \Exception
     */
    protected function dumpRemoteDatabase()
    {
        $cfg = Configuration::getConfiguration();
        $cmd = $cfg["sync"]["database"]["dump"]["sync_command"];
        $args = $cfg["sync"]["database"]["dump"]["sync_arguments"];
        $tempFile = $cfg["sync"]["database"]["temp_file"];
        array_push($args, '> ' . $tempFile);
        
        $this->log("Dumping database...");
        $executor = new CommandExecutor();
        $execResults = $executor->execute($cmd, $args);
        if ($execResults["return_value"] != 0)
        {
            throw new \Exception("Database dump failed:\n" . json_encode($execResults, JSON_PRETTY_PRINT));
        }
        
        return $execResults;
    }
    
    /**
     * Executes rsync and updates files in current branch from remote deployment
     *
*@return array
     * @throws \Exception
     */
    protected function downloadRemoteFiles()
    {
        $cfg = Configuration::getConfiguration();
        $cmd = $cfg["sync"]["file"]["sync_command"];
        $args = $cfg["sync"]["file"]["sync_arguments"];
        $src = $cfg["sync"]["file"]["sync_source"];
        $dst = $cfg["sync"]["file"]["sync_destination"];
        array_push($args, $src, $dst);
        
        if (!is_dir($dst))
        {
            throw new \Exception("Destination folder does not exist!");
        }
        $this->log("Syncing files...");
        $executor = new CommandExecutor();
        $execResults = $executor->execute($cmd, $args);
        if ($execResults["return_value"] != 0)
        {
            throw new \Exception("Files sync failed:\n" . json_encode($execResults, JSON_PRETTY_PRINT));
        }
        
        return $execResults;
    }
    
}
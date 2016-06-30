<?php
/**
 * Created by Adam Jakab.
 * Date: 29/06/16
 * Time: 14.56
 */

namespace Mekit\Command\EmailMan;

use Mekit\Logger\LoggerManager;
use SuiteCrm\Console\Command\Command;
use SuiteCrm\Console\Command\CommandInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendQueuedMailsCommand extends Command implements CommandInterface
{
  const COMMAND_NAME = 'emailman:send-queued-mails';
  const COMMAND_DESCRIPTION = 'Send Emails in queue';

  /** @var  LoggerManager */
  protected $loggerManager;

  /** @var array */
  private $processed_campaigns_for_supression = [];

  /** @var array */
  private $outbound_accounts = [];

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct(NULL);
  }

  /**
   * Configure command
   */
  protected function configure() {
    $this->setName(static::COMMAND_NAME);
    $this->setDescription(static::COMMAND_DESCRIPTION);
  }

  /**
   * @param InputInterface $input
   * @param OutputInterface $output
   *
   * @return bool
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    parent::_execute($input, $output);
    $this->loggerManager = new LoggerManager($this->cmdOutput);
    $this->log("Starting command " . static::COMMAND_NAME . "...");
    $this->executeCommand();
    $this->log("Command " . static::COMMAND_NAME . " done.");
  }

  /**
   * Execute Command
   */
  protected function executeCommand() {
    define('sugarEntry', TRUE);

    /* Substituting Sugar's logger*/
    $GLOBALS['log'] = $this->loggerManager;

    /** @var array $sugar_config */
    global $sugar_config;

    /** @var  \User $current_user */
    global $current_user;

    /** @var \DBManager $db */
    global $db;

    /** @var array $beanList */
    global $beanList;

    /** @var array $beanFiles */
    global $beanFiles;

    /** @var array $app_list_strings */
    global $app_list_strings;

    /** @var array $app_strings */
    global $app_strings;

    /** \Localization $locale */
    global $locale;

    require PROJECT_ROOT . '/config.php';
    require_once PROJECT_ROOT . '/include/entryPoint.php';
    require_once(PROJECT_ROOT . '/include/Localization/Localization.php');
    $this->requireSugarClass('SugarPHPMailer', PROJECT_ROOT . '/include/SugarPHPMailer.php');

    $locale = new \Localization();

    $mail = new \SugarPHPMailer();

    if (empty($current_language)) {
      $current_language = $sugar_config['default_language'];
    }

    $app_list_strings = return_app_list_strings_language($current_language);
    $app_strings = return_application_language($current_language);

    $current_user = new \User();
    $current_user->getSystemUser();

    //$this->log("CFG: " . json_encode($sugar_config, JSON_PRETTY_PRINT));
    //$this->log("BL: " . json_encode($beanList, JSON_PRETTY_PRINT));
    //$this->log("BF: " . json_encode($beanFiles, JSON_PRETTY_PRINT));
    //$this->log("LANG: " . $current_language);
    //$this->log("APP-LST-STR: " . json_encode($app_list_strings, JSON_PRETTY_PRINT));
    //$this->log("APP-STR: " . json_encode($app_strings, JSON_PRETTY_PRINT));

    //FROM : modules/EmailMan/EmailManDelivery.php
    $admin = new \Administration();
    $admin->retrieveSettings();

    $max_emails_per_run = 500;
    if (isset($admin->settings['massemailer_campaign_emails_per_run'])) {
      $max_emails_per_run = $admin->settings['massemailer_campaign_emails_per_run'];
      $max_emails_per_run = 1;//@todo: remove me!
    }
    $this->log("max_emails_per_run: " . $max_emails_per_run);


    $massemailer_email_copy = 0;
    if (isset($admin->settings['massemailer_email_copy'])) {
      $massemailer_email_copy = $admin->settings['massemailer_email_copy'];
    }
    $this->log("massemailer_email_copy: " . $massemailer_email_copy);

    $db = \DBManagerFactory::getInstance();
    $timedate = \TimeDate::getInstance();
    $emailman = new \EmailMan();

    $res = $this->getQueuedMailListResource($emailman->table_name, $max_emails_per_run);

    $count = 0;
    while ($row = $db->fetchByAssoc($res)) {
      $this->log("PROCESSING({$count}/{$max_emails_per_run}): " . json_encode($row, JSON_PRETTY_PRINT));

      //$emailman = new \EmailMan();
      $emailman->retrieve($row["id"]);
      //$this->log("EMAILMAN: " . print_r($emailman, true));

      if (empty($emailman->campaign_id)) {
        $this->log(
          'No campaign id on EmailMan item: ' . $emailman->id . " - DELETING..."
        );
        $emailman->mark_deleted($emailman->id);
        continue;
      }

      if (!$emailman->verify_campaign($emailman->marketing_id)) {
        $this->log(
          'Error verifying templates for the campaign on EmailMan item: '
          . $emailman->id . " - DELETING..."
        );
        $emailman->mark_deleted($emailman->id);
        continue;
      }

      //fetch user that scheduled the campaign.
      if (empty($current_user) or $emailman->user_id != $current_user->id) {
        $current_user->retrieve($emailman->user_id);
      }

      //verify the email template
      $current_emailmarketing = new \EmailMarketing();
      $current_emailmarketing->retrieve($emailman->marketing_id);

      $current_emailtemplate = new \EmailTemplate();
      $current_emailtemplate->retrieve($current_emailmarketing->template_id);

      $this->updateRestricedDomainsAddresses($emailman);

      if(!$current_emailmarketing->outbound_email_id) {
        $this->log(
          'No outbound Email id for EmailMarketing: '
          . $current_emailmarketing->id . " - DELETING..."
        );
        $emailman->mark_deleted($emailman->id);
        continue;
      }

      $this->log("USING OUTBOUND ID: " . $current_emailmarketing->outbound_email_id);

      if(!array_key_exists($current_emailmarketing->outbound_email_id, $this->outbound_accounts)) {
        $this->outbound_accounts[$current_emailmarketing->outbound_email_id] = \BeanFactory::getBean('OutboundEmailAccounts', $current_emailmarketing->outbound_email_id);
      }

      /** @var \OutboundEmailAccounts $outboundEmailAccount */
      $outboundEmailAccount = $this->outbound_accounts[$current_emailmarketing->outbound_email_id];

      //$this->log("OUTBOUND: " . print_r($outboundEmailAccount, true));

      $mail->Username = $outboundEmailAccount->mail_smtpuser;
      $mail->Password = $outboundEmailAccount->mail_smtppass;
      $mail->Host = $outboundEmailAccount->mail_smtpserver;
      $mail->Port = $outboundEmailAccount->mail_smtpport;
      //$mail->oe->mail_sendtype = 'SMTP';
      //$mail->oe->mail_smtpdisplay = 'Gmail';
      $mail->oe->mail_smtpauth_req = $outboundEmailAccount->mail_smtpauth_req;
      $mail->oe->mail_smtpuser = $outboundEmailAccount->mail_smtpuser;
      $mail->oe->mail_smtppass = $outboundEmailAccount->mail_smtppass;
      $mail->oe->mail_smtpserver = $outboundEmailAccount->mail_smtpserver;
      $mail->oe->mail_smtpport = $outboundEmailAccount->mail_smtpport;
      $mail->oe->mail_smtpssl = $outboundEmailAccount->mail_smtpssl;

      $this->log("sending...");
      /*
      if(!$emailman->sendEmail($mail, $massemailer_email_copy))
      {
        $this->log('EmailMan delivery failure: ' . $emailman->id . ".");
      } else {
        $this->log('EmailMan delivery success: ' . $emailman->id . ".");
      }

      if($mail->isError())
      {
        $this->log('EmailMan delivery error message: ' . $mail->ErrorInfo);
      }
      */
      $count++;
    }
  }


  /**
   * Creates/updates
   * @param \EmailMan $emailman
   */
  protected function updateRestricedDomainsAddresses(&$emailman) {
    $current_campaign_id = $emailman->campaign_id;

    //for the campaign process the suppression lists.
    if (!in_array($current_campaign_id, $this->processed_campaigns_for_supression)) {
      $this->processed_campaigns_for_supression[] = $current_campaign_id;

      if(!isset($emailman->restricted_domains)) {
        $emailman->restricted_domains = array();
      }

      if(!isset($emailman->restricted_addresses)) {
        $emailman->restricted_addresses = array();
      }

      /** @var \DBManager $db */
      $db = \DBManagerFactory::getInstance();

      //is this email address suppressed?
      $plc_query = " SELECT prospect_list_id, prospect_lists.list_type,prospect_lists.domain_name FROM prospect_list_campaigns ";
      $plc_query .= " LEFT JOIN prospect_lists on prospect_lists.id = prospect_list_campaigns.prospect_list_id";
      $plc_query .= " WHERE ";
      $plc_query .= " campaign_id='{$current_campaign_id}' ";
      $plc_query .= " AND prospect_lists.list_type in ('exempt_address','exempt_domain')";
      $plc_query .= " AND prospect_list_campaigns.deleted=0";
      $plc_query .= " AND prospect_lists.deleted=0";

      $result1 = $db->query($plc_query);
      while ($row1 = $db->fetchByAssoc($result1)) {
        if ($row1['list_type'] == 'exempt_domain') {
          $emailman->restricted_domains[strtolower($row1['domain_name'])] = 1;
        }
        else {
          //find email address of targets in this prospect list.
          $email_query = "SELECT email_address FROM email_addresses ea JOIN email_addr_bean_rel eabr ON ea.id = eabr.email_address_id JOIN prospect_lists_prospects plp ON eabr.bean_id = plp.related_id AND eabr.bean_module = plp.related_type AND plp.prospect_list_id = '{$row1['prospect_list_id']}' and plp.deleted = 0";
          $email_query_result = $db->query($email_query);

          while ($email_address = $db->fetchByAssoc($email_query_result)) {
            //ignore empty email addresses;
            if (!empty($email_address['email_address'])) {
              $emailman->restricted_addresses[strtolower($email_address['email_address'])] = 1;
            }
          }
        }
      }
    }
  }

  /**
   * @param string $tableName
   * @param int $max_emails_per_run
   *
   * @return resource
   */
  protected function getQueuedMailListResource($tableName, $max_emails_per_run) {
    /** @var \DBManager $db */
    $db = \DBManagerFactory::getInstance();
    $sql = "SELECT *"
           . " FROM $tableName"
           . " WHERE send_date_time <= " . $db->now()
           . " AND deleted = 0"
           . " ORDER BY in_queue_date ASC";//send_date_time ASC
    //$this->log("SQL: " . $sql);
    return $db->limitQuery($sql, 0, $max_emails_per_run);
  }

  /**
   * @param string $className
   * @param string $classFilePath
   * @param bool $once
   *
   */
  protected function requireSugarClass($className, $classFilePath, $once = TRUE) {
    $classExists = FALSE;
    if (!empty($className)) {
      $classExists = class_exists($className);
    }
    if (!$classExists) {
      $this->log("Loading class($className): $classFilePath");
      if ($once) {
        require_once $classFilePath;
      }
      else {
        require $classFilePath;
      }
    }
  }

  /**
   * @param string $msg
   * @param string $level - available: debug|info|warn|deprecated|error|fatal|security|off
   */
  public function log($msg, $level = 'warn')
  {
    $this->loggerManager->log($msg, $level);
  }
}
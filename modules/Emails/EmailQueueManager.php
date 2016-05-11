<?php

/**
 * Created by Adam Jakab.
 * Date: 31/03/16
 * Time: 8.56
 */
class EmailQueueManager {
    /** @var  \DBManager */
    protected $db;

    /** @var  \LoggerManager */
    protected $logger;

    /** @var  \EmailUi */
    protected $emailUI;

    /** @var bool  */
    protected $logToConsole = true;

    /**
     * Constructor
     */
    public function __construct() {
        require_once('modules/Emails/EmailUI.php');
        $this->db = \DBManagerFactory::getInstance();
        $this->emailUI = new EmailUI();
        $this->logger = $GLOBALS['log'];
    }

    /**
     * @param array $job
     */
    public function sendQueuedEMails($job) {
        $this->log('----->Scheduler fired job: sendQueuedEMails()...');

        $sql = "SELECT id FROM emails WHERE deleted = 0 AND type = 'out' AND status = 'queued'";
        $r = $this->db->query($sql);
        while($m = $this->db->fetchByAssoc($r)) {
            $email = new Email();
            $email->retrieve($m['id']);
            try {
                $this->sendQueuedEMail($email);
            } catch(\Exception $e) {
                $this->log('sendQueuedEMails: FAILED sending mail['.$email->id.']: ' . $e->getMessage());
                continue;
            }
        }
        $this->log('----->Scheduler finished job: sendQueuedEMails().');
    }

    /**
     * @param \Email $email
     * @throws \Exception
     */
    protected function sendQueuedEMail($email) {
        /** @var \TimeDate */
        global $timedate;

        /** @var \Localization */
        global $locale;
        $OBCharset = $locale->getPrecedentPreference('default_email_charset');

        $this->log('sendQueuedEMails: Sending mail['.$email->id.']...');


        /* PHPMAILER PREPARATION */
        $sugarPhpMailer = new SugarPHPMailer();
        $sugarPhpMailer = $email->setMailer($sugarPhpMailer, '', $email->mailbox_id);

        if (empty($sugarPhpMailer->Host)) {
            throw new \Exception("No Host is set for SugarPHPMailer!");
        }

        /* SUBJECT AND BODY */
        $sugarPhpMailer->Subject = from_html($email->name);
        $sugarPhpMailer = $email->handleBody($sugarPhpMailer);

        /* SENDER */
        $sugarPhpMailer->From = $email->from_addr;
        $sugarPhpMailer->FromName = $email->from_name;
        $sugarPhpMailer->Sender = $sugarPhpMailer->From;

        /* REPLY TO*/
        if (!empty($email->reply_to_addr)) {
            $sugarPhpMailer->AddReplyTo($email->reply_to_addr, $locale->translateCharsetMIME(trim($email->reply_to_name), 'UTF-8', $OBCharset));
        } else {
            $sugarPhpMailer->AddReplyTo($sugarPhpMailer->From, $locale->translateCharsetMIME(trim($sugarPhpMailer->FromName), 'UTF-8', $OBCharset));
        }

        /* TO */
        foreach($this->parseEmailAddressesString($email->to_addrs_names) as $mailAddressItem) {
            $sugarPhpMailer->AddAddress($mailAddressItem['email'], $mailAddressItem['name']);
        }
        /* CC */
        foreach($this->parseEmailAddressesString($email->cc_addrs_names) as $mailAddressItem) {
            $sugarPhpMailer->AddCC($mailAddressItem['email'], $mailAddressItem['name']);
        }
        /* BCC */
        foreach($this->parseEmailAddressesString($email->bcc_addrs_names) as $mailAddressItem) {
            $sugarPhpMailer->AddBCC($mailAddressItem['email'], $mailAddressItem['name']);
        }

        /* HANDLE NOTES(ATTACHMENTS) */
        $sql = "SELECT id FROM notes WHERE deleted = 0 AND parent_id = '".$email->id."' AND parent_type = 'Emails'";
        $r = $this->db->query($sql);
        while($n = $this->db->fetchByAssoc($r)) {
            $note = new Note();
            $note->retrieve($n["id"]);
            $files = $note->getFiles();
            foreach($files as $file) {
                $filePath = "upload/{$file}";
                if(is_file($filePath)) {
                    $this->log("ATTACHMENT NOTE: " . print_r($filePath, true));
                    $sugarPhpMailer->AddAttachment($filePath, $note->name, 'base64', $email->email2GetMime($filePath));
                }
            }
        }

        /* SEND */
        $sugarPhpMailer->prepForOutbound();
        $sugarPhpMailer->Body = $email->decodeDuringSend($sugarPhpMailer->Body);
        $sugarPhpMailer->AltBody = $email->decodeDuringSend($sugarPhpMailer->AltBody);
        if (!$sugarPhpMailer->Send()) {
            throw new \Exception("Error sending mail! " . $sugarPhpMailer->ErrorInfo);
        } else {
            $this->log("Mail was sent.");
        }

        /*
         * set replied-to = 1 on originating email @todo: find a way to do this - need to register originalId  in db when inserting into queue
        if ((!(empty($orignialId) || isset($request['saveDraft']) || ($this->type == 'draft' && $this->status == 'draft'))) &&
            (($_REQUEST['composeType'] == 'reply') || ($_REQUEST['composeType'] == 'replyAll') || ($_REQUEST['composeType'] == 'replyCase')) && ($orignialId != $this->id)) {
            $originalEmail = new Email();
            $originalEmail->retrieve($orignialId);
            $originalEmail->reply_to_status = 1;
            $originalEmail->save();
            $this->reply_to_status = 0;
        }*/

        /*
         * mark original mail answered on server - @todo: find a way to do this
        if ($_REQUEST['composeType'] == 'reply' || $_REQUEST['composeType'] == 'replyCase') {
            if (isset($_REQUEST['ieId']) && isset($_REQUEST['mbox'])) {
                $emailFromIe = new InboundEmail();
                $emailFromIe->retrieve($_REQUEST['ieId']);
                $emailFromIe->mailbox = $_REQUEST['mbox'];
                if (isset($emailFromIe->id) && $emailFromIe->is_personal) {
                    if ($emailFromIe->isPop3Protocol()) {
                        $emailFromIe->mark_answered($this->uid, 'pop3');
                    }
                    elseif ($emailFromIe->connectMailserver() == 'true') {
                        $emailFromIe->markEmails($this->uid, 'answered');
                        $emailFromIe->mark_answered($this->uid);
                    }
                }
            }
        }
        */


        /* CREATE COPY IN SENT FOLDER */
        if(!empty($email->mailbox_id)) {
            $inboundEmail = new InboundEmail();
            $inboundEmail->retrieve($email->mailbox_id);
            //@todo: missing && $inboundEmail->oe->mail_smtptype != 'gmail' in below condition - resolve!
            if (isset($inboundEmail->id) && !$inboundEmail->isPop3Protocol()) {
                $sentFolderName = $inboundEmail->get_stored_options('sentFolder', FALSE);
                if ($sentFolderName) {
                    $inboundEmail->mailbox = $sentFolderName;
                    if ($inboundEmail->connectMailserver() == 'true') {
                        $data = $sugarPhpMailer->CreateHeader() . "\r\n" . $sugarPhpMailer->CreateBody() . "\r\n";
                        $connectString = $inboundEmail->getConnectString($inboundEmail->getServiceString(), $inboundEmail->mailbox);
                        $returnData = imap_append($inboundEmail->conn, $connectString, $data, "\\Seen");
                        if (!$returnData) {
                            $this->log("could not copy email to {$inboundEmail->mailbox} for {$inboundEmail->name}");
                        } else {
                            $this->log("email was saved to to {$inboundEmail->mailbox} for {$inboundEmail->name}.");
                        }
                    }
                    else {
                        $this->log("could not connect to mail serve for folder {$inboundEmail->mailbox} for {$inboundEmail->name}");
                    }
                }
            }
        }

        /* UPDATE MAIL STATUS */
        $email->status = 'sent';
        $email->date_sent = $timedate->now();
        $email->message_id = $sugarPhpMailer->getLastMessageID();
        $email->save();
    }

    /**
     * @param \Email $email
     * @param array $request
     * @return bool
     */
    public function queueEMail($email, $request) {
        $answer = true;

        /** @var \User */
        global $current_user;

        /** @var array */
        global $beanList;

        /** @var array */
        global $beanFiles;

        $saveToSugar = $this->getDataFromArray($request, 'saveToSugar', false);

        /* ID */
        if(empty($email->id)) {
            $email->id = create_guid();
            $email->new_with_id = true;
        }

        /* NAME */
        $email->name = $this->getDataFromArray($request, 'sendSubject');

        /* DESCRIPTION */
        $email->description_html = str_replace('___BODY___',
                                               $this->getDataFromArray($request, 'sendDescription'),
                                               htmlentities('<html><body>___BODY___</body></html>')
        );

        /* DATE ENTERED */
        if ($email->isDraftEmail($request)) {
            if($email->type != 'draft' && $email->status != 'draft') {
                $email->date_entered = "";
            }
        }

        /* DELETE EMAIL ADDRESS REL */
        if ($email->isDraftEmail($request)) {
            $this->setDeletedEmailAddressRel($email->id);
        }

        $parent_type = $this->getDataFromArray($request, 'parent_type', false);
        $parent_id = $this->getDataFromArray($request, 'parent_id', false);

        if ($this->getDataFromArray($request, 'saveDraft', false)) {
            $email->type = 'draft';
            $email->status = 'draft';
        } else {
            if($email->type != 'draft' && $email->status != 'draft') {
                $email->date_entered = "";
                $email->type = 'out';
                $email->status = 'queued';
            }

            /* ADD RELATED PARENT BEAN */
            $object_arr = array();
            if($parent_type &&
               $parent_id &&
               in_array($parent_type, ['Accounts', 'Contacts', 'Leads', 'Users', 'Prospects']) &&
               array_key_exists($parent_type, $beanList) &&
               !empty($beanList[$parent_type])
            ) {
                $className = $beanList[$parent_type];
                if(isset($beanFiles[$className]) && !empty($beanFiles[$className])) {
                    if(!class_exists($className)) {
                        require_once($beanFiles[$className]);
                    }
                    /** @var \SugarBean $bean */
                    $bean = new $className();
                    $bean->retrieve($parent_id);
                    $object_arr[$bean->module_dir] = $bean->id;
                }
            }

            /* ADD RELATED BEANS BY EMAIL ADDRESS */
            $sea = new SugarEmailAddress();
            $toAddresses = $email->email2ParseAddresses($this->getDataFromArray($request, 'sendTo', []));
            if(is_array($toAddresses) && count($toAddresses)) {
                foreach($toAddresses as $addrMeta) {
                    $addr = isset($addrMeta['email']) ? $addrMeta['email'] : '';
                    $beans = $sea->getBeansByEmailAddress($addr);
                    if(is_array($beans) && count($beans)) {
                        foreach ($beans as $bean) {
                            if (!isset($object_arr[$bean->module_dir])) {
                                $object_arr[$bean->module_dir] = $bean->id;
                            }
                        }
                    }
                }
            }

            /* ALWAYS ADD CURRENT USER TO RELATED BEANS */
            $object_arr['Users'] = $current_user->id;

            /* TEMPLATE PARSING/SUBSTITUTIONS BY RELATED BEANS */
            $emailTemplateBean = new \EmailTemplate();
            $email->name = $emailTemplateBean->parse_template($email->name, $object_arr);
            $email->description_html = $emailTemplateBean->parse_template($email->description_html, $object_arr);
            $email->description = $emailTemplateBean->parse_template($email->description, $object_arr);

            /* FIX DESCRIPTION */
            $email->description = html_entity_decode($email->description, ENT_COMPAT, 'UTF-8');
        }

        /* UNSET PARENT TYPE AND ID */
        if(!($parent_type && $parent_id)) {
            $email->parent_id = "";
            $email->parent_type = "";
        }

        /* FIX? DESCRIPTION*/
        $email->description_html = from_html($email->description_html);
        $email->description_html = $email->decodeDuringSend($email->description_html);
        $email->description = $email->decodeDuringSend($email->description);

        /* FROM/REPLYTO ADDRESSES */
        $userMailDefaults = $current_user->getPreferredEmail();
        /** @var \EmailAddress $currentUserEmailAddress */
        $currentUserEmailAddress = $current_user->emailAddress;
        $fromName = $userMailDefaults['name'];
        $fromAddress = $userMailDefaults['email'];
        $replyToName = "";
        $replyToAddress = $currentUserEmailAddress->getReplyToAddress($current_user, true);

        if($this->getDataFromArray($request, 'fromAccount', false)) {
            // passed -> user -> system default
            $ie = new InboundEmail();
            $ie->retrieve($this->getDataFromArray($request, 'fromAccount'));
            $storedOptions = @unserialize(base64_decode($ie->stored_options));
            if (is_array($storedOptions)) {
                $fromAddress = $this->getDataFromArray($storedOptions, 'from_addr', '');
                $fromName = $this->getDataFromArray($storedOptions, 'from_name', '');
                $replyToAddress = $this->getDataFromArray($storedOptions, 'reply_to_addr', '');
                $replyToName = $this->getDataFromArray($storedOptions, 'reply_to_name', '');
            }
        }

        /* TO/CC/BCC ADDRESSES */
        $sendTo = $this->getDataFromArray($request, 'sendTo', '');
        $sendCC = $this->getDataFromArray($request, 'sendCc', '');
        $sendBCC = $this->getDataFromArray($request, 'sendBcc', '');
        $emailAddressCollection = array();
        foreach($email->email2ParseAddresses($sendTo) as $addressArray) {
            if(empty($addressArray['email'])) continue;
            $emailAddressCollection['to'][] = $addressArray['email'];
        }
        foreach($email->email2ParseAddresses($sendCC) as $addressArray) {
            if(empty($addressArray['email'])) continue;
            $emailAddressCollection['cc'][] = $addressArray['email'];
        }
        foreach($email->email2ParseAddresses($sendBCC) as $addressArray) {
            if(empty($addressArray['email'])) continue;
            $emailAddressCollection['bcc'][] = $addressArray['email'];
        }

        /* HANDLE ATTACHMENTS */
        $attachments = $this->getDataFromArray($request, 'attachments', '');
        if(!empty($attachments)) {
            $exAttachments = explode("::", $attachments);
            foreach($exAttachments as $file) {
                $file = trim(from_html($file));
                $file = str_replace("\\", "", $file);
                if(!empty($file)) {
                    $fileGUID = preg_replace('/[^a-z0-9\-]/', "", substr($file, 0, 36));
                    $fileLocation = $email->et->userCacheDir."/{$fileGUID}";
                    $filename = substr($file, 36, strlen($file));
                    if((($email->type == 'draft') && !empty($email->id)) || $saveToSugar) {
                        $note = new Note();
                        $note->id = create_guid();
                        $note->new_with_id = true;
                        $note->parent_id = $email->id;
                        $note->parent_type = $email->module_dir;
                        $note->name = $filename;
                        $note->filename = $filename;
                        $note->file_mime_type = $email->email2GetMime($fileLocation);
                        $fileDestination = "upload://{$note->id}";
                        if(!copy($fileLocation, $fileDestination)) {
                            $this->log(__CLASS__ . ": could not copy attachment file to $fileLocation => $fileDestination");
                        }
                        $note->save();
                    }
                }
            }
        }

        /* HANDLE SUGAR DOCUMENTS */
        $documents = $this->getDataFromArray($request, 'documents', '');
        if(!empty($documents)) {
            $exDocs = explode("::", $documents);

            foreach($exDocs as $docId) {
                $docId = trim($docId);
                if(!empty($docId)) {
                    $doc = new Document();
                    $docRev = new DocumentRevision();
                    $doc->retrieve($docId);
                    $docRev->retrieve($doc->document_revision_id);
                    $filename = $docRev->filename;
                    $docGUID = preg_replace('/[^a-z0-9\-]/', "", $docRev->id);
                    $fileLocation = "upload://{$docGUID}";
                    $mime_type = $docRev->file_mime_type;
                    if((($email->type == 'draft') && !empty($email->id)) || $saveToSugar) {
                        $note = new Note();
                        $note->id = create_guid();
                        $note->new_with_id = true; // duplicating the note with files
                        $note->parent_id = $email->id;
                        $note->parent_type = $email->module_dir;
                        $note->name = $filename;
                        $note->filename = $filename;
                        $note->file_mime_type = $mime_type;
                        $dest = "upload://{$note->id}";
                        if(!copy($fileLocation, $dest)) {
                            $this->log("EMAIL 2.0: could not copy SugarDocument revision file $fileLocation => $dest");
                        }
                        $note->save();
                    }
                }
            }
        }

        /* HANDLE TEMPLATE ATTACHMENTS */
        $templateAttachments = $this->getDataFromArray($request, 'templateAttachments', '');
        if(!empty($templateAttachments)) {
            $exNotes = explode("::", $templateAttachments);
            foreach($exNotes as $noteId) {
                $noteId = trim($noteId);
                if(!empty($noteId)) {
                    $note = new Note();
                    $note->retrieve($noteId);
                    if (!empty($note->id)) {
                        $filename = $note->filename;
                        $noteGUID = preg_replace('/[^a-z0-9\-]/', "", $note->id);
                        $fileLocation = "upload://{$noteGUID}";
                        $mime_type = $note->file_mime_type;
                        if (!$note->embed_flag) {
                            // only save attachments if we're archiving or drafting
                            if((($email->type == 'draft') && !empty($email->id)) || $saveToSugar) {
                                if ($note->parent_id != $saveToSugar->id)
                                    $email->saveTempNoteAttachments($filename, $fileLocation, $mime_type);
                            }
                        }
                    } else {
                        $fileGUID = preg_replace('/[^a-z0-9\-]/', "", substr($noteId, 0, 36));
                        $fileLocation = $email->et->userCacheDir."/{$fileGUID}";
                        $filename = substr($noteId, 36, strlen($noteId));
                        if( (($email->type == 'draft') && !empty($email->id)) || $saveToSugar) {
                            $mimeType = $email->email2GetMime($fileLocation);
                            $email->saveTempNoteAttachments($filename, $fileLocation, $mimeType);
                        }
                    }
                }
            }
        }

        /* SET FINAL TYPE AND STATUS */
        if($email->type == 'draft' && !$this->getDataFromArray($request, 'saveDraft', false)) {
            // sending a draft email
            $email->type = 'out';
            $email->status = 'sent';
        } elseif($this->getDataFromArray($request, 'saveDraft', false)) {
            $email->type = 'draft';
            $email->status = 'draft';
        }


        /* SET TO/CC/BCC ADDRESSES */
        $decodedFromName = mb_decode_mimeheader($fromName);
        $email->from_addr = "{$decodedFromName} <{$fromAddress}>";
        $email->from_addr_name = $email->from_addr;
        //@todo implement $emailAddressCollection
        $email->to_addrs = $sendTo;
        $email->to_addrs_names = $sendTo;
        $email->cc_addrs = $sendCC;
        $email->cc_addrs_names = $sendCC;
        $email->bcc_addrs = $sendBCC;
        $email->bcc_addrs_names = $sendBCC;

        $email->reply_to_addr = $replyToAddress;
        $email->reply_to_name = $replyToName;

        /* SET OTHER DATA */
        $email->assigned_user_id = $current_user->id;
        $email->date_sent = "";
        $email->mailbox_id = $this->getDataFromArray($request, 'fromAccount', null);

        /* LINK EMAIL TO PARENT BEAN */
        if($parent_type && $parent_id) {
            $email->parent_type = $parent_type;
            $email->parent_id = $parent_id;

            $q = "SELECT count(*) AS c FROM emails_beans
            WHERE email_id = '{$email->id}'
            AND bean_id = '".$email->parent_id."'
            AND bean_module = '".$email->parent_type."'";
            $r = $this->db->query($q);
            $a = $this->db->fetchByAssoc($r);
            if($a['c'] == 0) {
                if(isset($beanList[$parent_type]) && !empty($beanList[$parent_type])) {
                    $className = $beanList[$parent_type];
                    if(isset($beanFiles[$className]) && !empty($beanFiles[$className])) {
                        if(!class_exists($className)) {
                            require_once($beanFiles[$className]);
                        }
                        /** @var \SugarBean $bean */
                        $bean = new $className();
                        $bean->retrieve($parent_id);
                        if($bean->load_relationship('emails')) {
                            $bean->emails->add($email->id);
                        }
                    }
                }
            }
        } else {
            if(class_exists('aCase')) {
                $case = new aCase();
                $ie = new InboundEmail();
                if($caseId = $ie->getCaseIdFromCaseNumber($email->name, $case)) {
                    $case->retrieve($caseId);
                    $case->load_relationship('emails');
                    $case->emails->add($email->id);
                    $email->parent_type = "Cases";
                    $email->parent_id = $caseId;
                }
            }
        }


        /* SAVE THE BUGGER */
        $email->save();

        return $answer;
    }

    /**
     * parses email strings (format: Name <email>) and returns array with email/name keys
     * @param string $addresses
     * @return array
     */
    function parseEmailAddressesString($addresses) {
        $answer = array();
        $addresses = from_html($addresses);

        //SUBSTITUTE ';' with ','
        preg_match_all('/@.*;/U', $addresses, $m);
        if(!empty($m[0])) {
            $replaced = [];
            foreach($m[0] as $key => $value) {
                $replaced[] = str_replace(";", ",", $value);
            }
            $addresses = str_replace($m[0], $replaced, $addresses);
        }

        //SUBSTITUTE ',' with magic separator
        $magicSeparator = '|||';
        $pattern = '/@.*,/U';
        preg_match_all($pattern, $addresses, $m);
        if (!empty($m[0])){
            foreach ($m[0] as $match) {
                $convertedPattern = str_replace(',', $magicSeparator, $match);
                $addresses = str_replace($match, $convertedPattern, $addresses);
            }
        }
        $addressArray = explode($magicSeparator, $addresses);


        // SEPARATE mail and name
        $clean = array("<", ">");
        $dirty = array("&lt;", "&gt;");
        foreach($addressArray as $addressString) {
            $email = '';
            $name = '';
            $addressString = str_replace($dirty, $clean, $addressString);

            if((strpos($addressString, "<") === false) && (strpos($addressString, ">") === false)) {
                $email = $addressString;
            } else {
                $email = substr($addressString, strpos($addressString, "<") + 1, strpos($addressString, ">") - 1 - strpos($addressString, "<"));
                $name = substr($addressString, 0, strpos($addressString, "<"));
            }

            if($email) {
                $answer[] = [
                    'email' => trim($email),
                    'name' => trim($name)
                ];
            }
        }
        return $answer;
    }

    /**
     * @param string $emailId
     */
    protected function setDeletedEmailAddressRel($emailId) {
        $q1 = "update emails_email_addr_rel set deleted = 1 WHERE email_id = '{$emailId}'";
        $this->db->query($q1);
    }

    /**
     * @param array $request
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function getDataFromArray($request, $key, $default = '') {
        return isset($request[$key]) ? $request[$key] : $default;
    }

    /**
     * @param string $message
     * @param string $level - one of: 'debug','info','warn','deprecated','error','fatal','security''off'
     */
    protected function log($message, $level = 'debug') {
        $this->logger->__call($level, $message);
        if($this->logToConsole && php_sapi_name() == 'cli') {
            echo $message ."\n";
        }
    }
}
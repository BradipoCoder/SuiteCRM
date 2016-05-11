<?php
/**
 * Created by Adam Jakab.
 * Date: 18/03/16
 * Time: 10.04
 */

namespace Mekit\SugarCrm\Maintenance;


use Mekit\Console\Configuration;

class Maintenance {
    /** @var callable */
    protected $logger;

    /** @var  \PDO */
    protected $db;

    /** @var  \PDOStatement */
    protected $itemWalker;

    /**
     * @param callable $logger
     * @throws \Exception
     */
    public function __construct($logger) {
        $this->logger = $logger;
        $this->db = Configuration::getDatabaseConnection("local");
    }



    public function execute($options) {
        $cfg = Configuration::getConfiguration();
        $this->cleanUpMultipleMails();
    }

    /**
     * Clean up multiple references to emails causing sugar to die
     */
    protected function cleanUpMultipleMails() {
        $query = "SELECT eabr.bean_id, COUNT(eabr.id) AS CNT
            FROM email_addr_bean_rel AS eabr
            GROUP BY eabr.bean_id, eabr.email_address_id
            HAVING COUNT(eabr.id) > 1
            ";
        $itemWalker = $this->db->prepare($query);
        $itemWalker->execute();
        while($data = $itemWalker->fetch(\PDO::FETCH_ASSOC)) {
            $this->log("D: " . json_encode($data));
            $delSql = "DELETE FROM email_addr_bean_rel WHERE bean_id = '".$data["bean_id"]."' LIMIT " . ($data["CNT"] - 1) . ";";
            $this->log("SQL: " . $delSql);
            $delSt = $this->db->prepare($delSql);
            $delSt->execute();
        }
    }

    /**
     * @param string $msg
     */
    protected function log($msg) {
        call_user_func($this->logger, $msg);
    }
}
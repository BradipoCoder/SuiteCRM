<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/**
 * Created by Adam Jakab.
 * Date: 11/12/15
 * Time: 12.44
 */
class OpportunitiesAutonumber {
    /**
     * Triggered on hook: before_save
     *
     * @param Opportunity $opportunityBean
     * @param $event
     * @param $args
     */
    public function calculateAutoNumber(&$opportunityBean, $event, $args) {
        if(!isset($opportunityBean->identificativo_c) || empty($opportunityBean->identificativo_c)) {
            $newNumber = $this->getNextOpportunityNumber();
            if($newNumber) {
                $this->setIdentificativo($opportunityBean, $newNumber);
            }
        }
    }

    private function getNextOpportunityNumber() {
        $answer = false;
        /** @var \DBManager $db */
        global $db;
        $sql = 'SELECT MAX(identificativo_c) AS MAXID FROM opportunities_cstm';
        $result = $db->query($sql);
        $data= $db->fetchByAssoc($result);
        if(isset($data["MAXID"])) {
            $answer = (int)$data["MAXID"] + 1;
        }
        return $answer;
    }

    /**
     * @param Opportunity $opportunityBean
     * @param int $number
     */
    private function setIdentificativo(&$opportunityBean, $number) {
        $opportunityBean->identificativo_c = $number;
    }
}
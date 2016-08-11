<?php
/**
 * Created by Adam Jakab.
 * Date: 06/06/16
 * Time: 14.26
 */

namespace Mekit\Maintenance\Account;

use Mekit\Console\Configuration;

class AccountFixer
{
    /** @var bool */
    protected $dryRun = false;
    
    /** @var callable */
    protected $logger;
    
    /** @var  \PDO */
    protected $db;
    
    /** @var  \PDOStatement */
    protected $itemWalker;
    
    /** @var array */
    protected $impStates = [
        1    => 'Potenziale',
        2    => 'Cliente',
        3    => 'Dormiente',
        4    => 'Perso',
        5    => 'Negativo',
        6    => 'Lead',
        1000 => 'NC',
    ];
    
    /** @var array  (ONLY THE ONES USED IN CODE) */
    protected $impStatePhases = [
        "1_2" => 'Pt. Caldo',
        "2_1" => 'C. Fidelizzato',
        "2_2" => 'C. Attivo',
        "2_3" => 'C. Nuovo',
        "3_1" => 'D. Recente',
        "3_3" => 'D. Freddo',
        "4_7" => 'Prs. Da Definire',
    ];
    
    /** @var  \DateTime */
    protected $currentDate;
    
    /** @var  \DateTime */
    protected $currentDateMinus30D;
    
    /** @var  \DateTime */
    protected $lastMonthEndDate;
    
    /**
     * @param callable $logger
     *
     * @throws \Exception
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
        $this->db = Configuration::getDatabaseConnection("local");
        $this->currentDate = new \DateTime();
        $this->currentDateMinus30D = new \DateTime();
        $this->currentDateMinus30D->sub(new \DateInterval("P30D"));
        $this->lastMonthEndDate = new \DateTime("last day of previous month");
    }
    
    /**
     * @param array $options
     */
    public function execute($options)
    {
        //$this->log("Executing with options: " . json_encode($options));
        
        $this->setAlwaysStatePhaseClientActiveFromClientNew();
        
        //Converto to "Cliente"
        $this->setStatePhaseClientNewFromPotentialLead();
        $this->setStatePhaseClientActiveFromSleepingLost();
        
        //Convert to "Cliente Fidelizzato" <-> "Cliente Attivo"
        $this->setStatePhaseClientFidelizzatoFromClientActive();
        
        //Convert to "Dormiente"
        $this->setStatePhaseSleepingRecentFromClient();
        $this->setStatePhaseSleepingColdFromSleepingRecent();
        
        //Converto to "Perso"/"Da Definire"
        $this->setStatePhaseLostToBeDefinedFromSleeping();
        
        if ($this->dryRun)
        {
            $this->log(str_repeat("#", 120));
            $this->log("RUNNING IN DRY MODE! NO CHANGES HAVE BEEN MADE!");
            $this->log(str_repeat("#", 120));
        }
    }
    
    /**
     * Update state to "perso", phase to "perso da definire" when:
     * state: "dormiente"
     * phase: ANY
     * fatturato periodo mobile 12 mesi <= 0
     *
     */
    protected function setStatePhaseLostToBeDefinedFromSleeping()
    {
        $this->log(str_repeat("-", 60) . ": Dormiente -> Perso/Da def. (se non attivo in periodo mobile 12 mesi)");
        $sql = "SELECT a.id
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE c.imp_status_c = :status
            AND c.mesimobili12_c <= :mesimobili12
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status'       => $this->getImpStateKey("Dormiente"),
                ':mesimobili12' => 0,
            ]
        );
        $this->log("RECORDS: " . $itemWalker->rowCount());
        
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            //$this->log("D: " . json_encode($data));
            $updateSql = "UPDATE accounts_cstm 
          SET imp_status_c = :status, 
          imp_status_phase__c = :phase
          WHERE id_c = :id
          ";
            $updateParams = [
                ':id'     => $data["id"],
                ':status' => $this->getImpStateKey("Perso"),
                ':phase'  => $this->getImpStatePhaseKey("Prs. Da Definire"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Update state to "cliente", phase to "fidelizzato" when:
     * state: "cliente"
     * phase: "attivo"
     * almeno 9 su 12 mesi recenti ha acquistato
     */
    protected function setStatePhaseClientFidelizzatoFromClientActive()
    {
        $this->log(str_repeat("-", 60)
                   . ": Cliente/Attivo -> Cliente/Fidelizzato (se acquistato 9 su 12 mesi recenti)");
        
        $invoiceFields = $this->getInvoiceDataFieldNamesBackwards("imp", 12);
        //$this->log("INVOICE FIELDS: " . json_encode($invoiceFields));
        $i = 0;
        $sqlSelectPartial = '';
        foreach ($invoiceFields as $invoiceField)
        {
            $i++;
            $sqlSelectPartial .= ",\n\t $invoiceField AS f${i}";
        }
        
        $sql = "SELECT a.id
            $sqlSelectPartial
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE c.imp_status_c = :status
            AND c.imp_status_phase__c = :phase
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status' => $this->getImpStateKey("Cliente"),
                ':phase'  => $this->getImpStatePhaseKey("C. Attivo"),
            ]
        );
        
        //filter out those with min 9 month active
        $fidelizzati = [];
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            //$this->log("DATA: " . json_encode($data));
            $activeMonthCount = 0;
            for ($i = 1; $i <= 12; $i++)
            {
                $fieldName = "f${i}";
                if (isset($data[$fieldName]) && intval($data[$fieldName]) > 0)
                {
                    $activeMonthCount++;
                }
            }
            if ($activeMonthCount >= 9)
            {
                $fidelizzati[] = $data["id"];
            }
        }
        $this->log("RECORDS: " . count($fidelizzati));
        
        //update
        foreach ($fidelizzati as $id)
        {
            $updateSql = "UPDATE accounts_cstm 
          SET imp_status_c = :status, 
          imp_status_phase__c = :phase
          WHERE id_c = :id
          ";
            $updateParams = [
                ':id'     => $id,
                ':status' => $this->getImpStateKey("Cliente"),
                ':phase'  => $this->getImpStatePhaseKey("C. Fidelizzato"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Update state to "dormiente", phase to "freddo" when:
     * state: "dormiente"
     * phase: "recente"
     * data diventato dormiente > oggi + 30gg
     * fatturato periodo attuale <= 0
     *
     */
    protected function setStatePhaseSleepingColdFromSleepingRecent()
    {
        $this->log(str_repeat("-", 60) . ": Dormiente/Recente -> Dormiente/Freddo (se non attivo in periodo attuale)");
        $sql = "SELECT a.id
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE c.imp_status_c = :status
            AND c.imp_status_phase__c = :phase
            AND ( NULLIF(c.imp_acc_sleep_date_c, '') IS NULL OR c.imp_acc_sleep_date_c < :acc_sleep_date)
            AND c.ft_periodo_attuale_c <= :ft_periodo_attuale
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status'             => $this->getImpStateKey("Dormiente"),
                ':phase'              => $this->getImpStatePhaseKey("D. Recente"),
                ':acc_sleep_date'     => $this->currentDateMinus30D->format("Y-m-d"),
                ':ft_periodo_attuale' => 0,
            ]
        );
        $this->log("RECORDS: " . $itemWalker->rowCount());
        
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            //$this->log("D: " . json_encode($data));
            $updateSql = "UPDATE accounts_cstm 
          SET imp_status_c = :status, 
          imp_status_phase__c = :phase
          WHERE id_c = :id
          ";
            $updateParams = [
                ':id'     => $data["id"],
                ':status' => $this->getImpStateKey("Dormiente"),
                ':phase'  => $this->getImpStatePhaseKey("D. Freddo"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Update state to "dormiente", phase to "recente", "Data diventato dormiente" to end of last month when:
     * state: "cliente"
     * phase: ANY
     * fatturato periodo attuale <= 0
     *
     */
    protected function setStatePhaseSleepingRecentFromClient()
    {
        $this->log(str_repeat("-", 60) . ": Cliente -> Dormiente/Recente (se non attivo in periodo attuale)");
        $sql = "SELECT a.id
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE c.imp_status_c = :status
            AND c.ft_periodo_attuale_c <= :ft_periodo_attuale
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status'             => $this->getImpStateKey("Cliente"),
                ':ft_periodo_attuale' => 0,
            ]
        );
        $this->log("RECORDS: " . $itemWalker->rowCount());
        
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            //$this->log("D: " . json_encode($data));
            $updateSql = "UPDATE accounts_cstm 
          SET imp_status_c = :status, 
          imp_status_phase__c = :phase,
          imp_acc_sleep_date_c = :acc_sleep_date
          WHERE id_c = :id
          ";
            $updateParams = [
                ':id'             => $data["id"],
                ':status'         => $this->getImpStateKey("Dormiente"),
                ':phase'          => $this->getImpStatePhaseKey("D. Recente"),
                ':acc_sleep_date' => $this->lastMonthEndDate->format("Y-m-d"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Update state to "client", phase to "active" when:
     * state: "dormiente" o "perso"
     * phase: ANY
     * fatturato periodo attuale > 0
     *
     */
    protected function setStatePhaseClientActiveFromSleepingLost()
    {
        $this->log(str_repeat("-", 60) . ": Dormiente/Perso. -> Cliente Attivo (se attivo in periodo attuale)");
        $sql = "SELECT a.id
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE (c.imp_status_c = :status1 OR c.imp_status_c = :status2)
            AND c.ft_periodo_attuale_c > :ft_periodo_attuale
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status1'            => $this->getImpStateKey("Dormiente"),
                ':status2'            => $this->getImpStateKey("Perso"),
                ':ft_periodo_attuale' => 0,
            ]
        );
        $this->log("RECORDS: " . $itemWalker->rowCount());
        
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            //$this->log("D: " . json_encode($data));
            $updateSql = "UPDATE accounts_cstm 
              SET imp_status_c = :status, 
              imp_status_phase__c = :phase
              WHERE id_c = :id
              ";
            $updateParams = [
                ':id'     => $data["id"],
                ':status' => $this->getImpStateKey("Cliente"),
                ':phase'  => $this->getImpStatePhaseKey("C. Attivo"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Update state to "client", phase to "new" and Data inizio rapporto(imp_acc_start_date) when:
     * state: "potenziale" o "lead"
     * phase: ANY
     * fatturato periodo attuale > 0
     *
     */
    protected function setStatePhaseClientNewFromPotentialLead()
    {
        $this->log(str_repeat("-", 60) . ": Lead/Pot. -> Cliente Nuovo (se attivo in periodo attuale)");
        $sql = "SELECT a.id
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE (c.imp_status_c = :status1 OR c.imp_status_c = :status2)
            AND c.ft_periodo_attuale_c > :ft_periodo_attuale
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status1'            => $this->getImpStateKey("Lead"),
                ':status2'            => $this->getImpStateKey("Potenziale"),
                ':ft_periodo_attuale' => 0,
            ]
        );
        $this->log("RECORDS: " . $itemWalker->rowCount());
        
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            //$this->log("D: " . json_encode($data));
            $updateSql = "UPDATE accounts_cstm 
          SET imp_status_c = :status, 
          imp_status_phase__c = :phase,
          imp_acc_start_date_c = :acc_start_date
          WHERE id_c = :id
          ";
            $updateParams = [
                ':id'             => $data["id"],
                ':status'         => $this->getImpStateKey("Cliente"),
                ':phase'          => $this->getImpStatePhaseKey("C. Nuovo"),
                ':acc_start_date' => $this->lastMonthEndDate->format("Y-m-d"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Update phase to "active" when:
     * state: "client"
     * phase: "new"
     * Data inizio rapporto > oggi + 30gg
     *
     */
    protected function setAlwaysStatePhaseClientActiveFromClientNew()
    {
        $this->log(str_repeat("-", 60) . ": Fase Stato: Attivo (se data inizio rapporto più vecchio di 30gg)");
        $sql = "SELECT a.id
            FROM accounts AS a
            INNER JOIN accounts_cstm AS c ON c.id_c = a.id
            WHERE c.imp_status_c = :status
            AND c.imp_status_phase__c = :phase
            AND ( NULLIF(c.imp_acc_start_date_c, '') IS NULL OR c.imp_acc_start_date_c < :acc_start_date)
            AND c.imp_forced_status_c <> 1
            ";
        
        $itemWalker = $this->db->prepare($sql);
        $itemWalker->execute(
            [
                ':status'         => $this->getImpStateKey("Cliente"),
                ':phase'          => $this->getImpStatePhaseKey("C. Nuovo"),
                ':acc_start_date' => $this->currentDateMinus30D->format("Y-m-d"),
            ]
        );
        $this->log("RECORDS: " . $itemWalker->rowCount());
        
        while ($data = $itemWalker->fetch(\PDO::FETCH_ASSOC))
        {
            $updateSql = "UPDATE accounts_cstm 
          SET imp_status_phase__c = :phase
          WHERE id_c = :id
          ";
            $updateParams = [
                ':id'    => $data["id"],
                ':phase' => $this->getImpStatePhaseKey("C. Attivo"),
            ];
            $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            if (!$this->dryRun)
            {
                $st = $this->db->prepare($updateSql);
                $st->execute($updateParams);
            }
        }
    }
    
    /**
     * Returns field names for the specified length starting from (and excluding) current month backwards
     *
     * {
     * "fatturato_thisyear_1_c":"0.0000",..."fatturato_thisyear_12_c":"0.0000",
     * "fatturato_lastyear_1_c":"0.0000",..."fatturato_lastyear_12_c":"0.0000"
     * }
     *
     * @param string $database
     * @param int    $length
     * @param int    $offset
     *
     * @return array
     */
    protected function getInvoiceDataFieldNamesBackwards($database, $length, $offset = 0)
    {
        $answer = [];
        $now = new \DateTime();
        $currMonthNumber = (int) $now->format("n");
        $dbPrefix = strtolower($database) == "imp" ? "" : "mkt_";
        $fieldPrefix = $dbPrefix . "fatturato_";
        for ($m = 1; $m <= $length; $m++)
        {
            $currentYearIndicator = "thisyear";
            $monthNumber = $currMonthNumber - $offset - $m;
            if ($monthNumber < 1)
            {
                $monthNumber += 12;
                $currentYearIndicator = "lastyear";
            }
            $answer[] = $fieldPrefix . $currentYearIndicator . "_" . $monthNumber . "_c";
        }
        
        return $answer;
    }
    
    /*
    protected function quickfixBackToPotenziale()
    {
      $potenziali = [
        "138b0859-f1f6-002c-04f0-5746f6d0a98a",
        "18e968f5-ff9a-9489-0898-56f262661d58",
        "2b2ae510-bce6-828e-fcd4-56fe31b5d8e2",
        "2b38af7d-288c-c84b-74a6-5630b3c228d6",
        "2b81c132-9562-fec5-c86b-56153a55b40d",
        "2ba03829-6445-6b00-9cb0-560149c50d37",
        "2efda6af-1a36-1033-e10b-57387a261805",
        "2fc6c2e7-1d89-f74b-54ff-531b45540744",
        "3253b06f-d876-73e3-ba5f-56f408b96e0d",
        "353c25b3-c007-5a76-c5a6-560e4c51e04b",
        "3ecdf9d9-dbb5-871b-2b29-56d95a52e2d5",
        "3ed49b48-fa21-74e8-8309-56cd9ae2466f",
        "3ee7cd08-ae8d-37e0-2df9-56c45a51a459",
        "42703703-0c86-40a8-2587-537f1d7902c5",
        "43f35427-90a7-7282-1b17-5717872dec2e",
        "444976e7-cdb1-dcc9-df25-56d95a944b1c",
        "450116d3-bf54-2220-0649-561e1afce4a4",
        "45ed0151-6263-d49e-0c8c-531b450b43a6",
        "46ffd511-cf90-c444-188d-573edab584d2",
        "48ef565e-b263-8535-df2c-5630b34cc6a4",
        "4a2a095f-abfb-f043-8d08-5731ececce4c",
        "4cfb7559-9fa9-52d9-251a-56c45a00f71c",
        "5c20ecb8-7ebf-af45-61f7-56e93815a904",
        "64b27a71-acda-92e4-58b6-56fa4cfc05bc",
        "66471410-1d61-f63b-cbf6-56fa3eb29530",
        "681c6133-0555-9e49-19a8-570693f2b0a0",
        "70f8f84f-a2d7-e30d-d67e-570fabbe5a28",
        "796d6852-12d8-d893-d911-56ead772c9f1",
        "7addc1b7-a239-a2e3-73d5-5731ec51cd60",
        "7d0e9fe6-28de-94fa-517f-536a1af6ca12",
        "807d6750-eae3-aebd-0034-5731ee7a2baf",
        "83a20e8b-068a-02b4-82e1-56efe8868587",
        "84c5a2ef-4307-a11e-4bc2-567812d240db",
        "860d907f-0ca9-b712-51c7-56c4596a1362",
        "8620f420-f5b3-fe12-79e5-560122b5d4b6",
        "875ff1c4-08c9-7ca3-468d-537dcda7f5d8",
        "8cc33bff-e327-ba3c-6781-56f0eebcdd6b",
        "8fdc231f-3971-b5d8-7dfd-570f6116d190",
        "96626476-e569-5231-28e8-56d59dd03d48",
        "98e38ce5-f654-e57d-e477-57074f47df24",
        "a0267f15-e758-c8a5-65aa-5630b31992d0",
        "a0fd430d-36b1-0bad-fccf-56017260ee31",
        "a2debd3f-200f-9e01-6ae6-573ac992417a",
        "a4a69675-b0d8-b802-5983-56ead771c9a7",
        "b1fd0ac0-f57d-1d1b-48f1-568b7bd216cc",
        "b3ddc21e-29f3-7ff0-4679-5624940c2e07",
        "b5e1fa78-e97e-c0f7-5747-561e1a4c2b2b",
        "b78da8b2-88ab-945e-d0ee-56e06727fae0",
        "b85aee37-c51e-3c41-7263-537f4fd6eacf",
        "bb07e9ee-6a1d-98a5-26ed-56fe7b78e215",
        "bdaedc66-6c72-e68d-4511-56f12fb916c8",
        "bdec6aa1-1cbc-35b3-2dde-5731ec5fc52a",
        "be220525-77e1-fe75-3872-573af1eedcfb",
        "bf1b5f93-24eb-ef3f-d5c1-5603ff82bb0c",
        "bf7fd103-8d91-11e5-1987-56675a2c8a9b",
        "c71d9364-048a-d34b-ef93-5603ff4d74fe",
        "d33504c2-519e-0e5a-ca40-57163803c5e4",
        "d75c1242-74d2-c856-98b7-5603eec3fc13",
        "e1495a44-1fe1-e72f-3516-56fe7aa98fc6",
        "e7d4f463-cb72-4acb-503e-56f40084e1f3",
        "e978214b-1c03-841a-36e4-5608f9478c80",
        "ebae6601-3383-8f3b-57d1-56ced512b016",
        "ed1339e2-3b7a-cce8-6dc9-574d308e6129",
        "ed893d1d-6b15-a5e6-7e01-56deea72e2e8",
        "ef6d62f2-efa9-6a03-6c0a-537db7b91c61"
      ];
      foreach ($potenziali as $id)
      {
        //$this->log("D: " . json_encode($data));
        $updateSql = "UPDATE accounts_cstm
            SET imp_status_c = :status, imp_status_phase__c = :phase
            WHERE id_c = :id
            ";
        $updateParams = [
          ':id' => $id,
          ':status' => $this->getImpStateKey("Potenziale"),
          ':phase' => $this->getImpStatePhaseKey("Pt. Caldo"),
        ];
        $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
        $st = $this->db->prepare($updateSql);
        $st->execute($updateParams);
      }
    }
    */
    
    /**
     * @param string $stateName
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getImpStateKey($stateName)
    {
        $key = array_search($stateName, $this->impStates);
        if ($key === false)
        {
            throw new \Exception("Unknown Imp state name: $stateName!");
        }
    
        return $key;
    }
    
    /**
     * @param string $phaseName
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getImpStatePhaseKey($phaseName)
    {
        $key = array_search($phaseName, $this->impStatePhases);
        if ($key === false)
        {
            throw new \Exception("Unknown Imp state phase name: $phaseName!");
        }
    
        return $key;
    }
    
    /**
     * @param string $msg
     */
    protected function log($msg)
    {
        call_user_func($this->logger, $msg);
    }
}
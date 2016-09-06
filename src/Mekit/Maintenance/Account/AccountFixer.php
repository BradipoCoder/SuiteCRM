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
    protected $dryRun = true;
    
    /** @var bool */
    protected $verboseLogging = false;
    
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
        $this->verboseLogging = $options["verbose"];
        
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
        $sql = "SELECT a.id, a.name
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
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
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
        
        $sql = "SELECT a.id, a.name
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
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
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
        $sql = "SELECT a.id, a.name
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
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
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
        $sql = "SELECT a.id, a.name
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
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
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
        $this->log(str_repeat("-", 60) . ": Dormiente/Perso. -> C. Attivo (se attivo in periodo attuale)");
        $sql = "SELECT a.id, a.name
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
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
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
        $sql = "SELECT a.id, a.name
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
    
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
            
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
        $this->log(str_repeat("-", 60) . ": C. Nuovo -> C. Attivo (se data inizio rapporto più vecchio di 30gg)");
        $sql = "SELECT a.id, a.name
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
    
            $this->log($data["name"]);
            if ($this->verboseLogging)
            {
                $this->log("UPDATE: " . $updateSql . " with params: " . json_encode($updateParams));
            }
            
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
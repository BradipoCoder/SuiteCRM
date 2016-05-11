<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
@require_once('include/TimeDate.php');
/**
 * Created by Adam Jakab.
 * Date: 29/04/16
 * Time: 11.12
 */
class HookCallsCustomFixDates
{

    /** @var string  */
    private $ADAMJAKAB = '1eda4eda-43fb-df91-8975-56b1c1f35def';

    /**
     * @param \Call $call
     * @param string $event
     * @param array $arguments
     */
    public function fixEmptyScheduledDate($call, $event, $arguments)
    {
        /** @var \User $current_user */
//        global $current_user;
//        if ($current_user->id != $this->ADAMJAKAB) {
//            return;
//        }

        $TD = new TimeDate();

        //Chiudi e Crea Nuovo
        $isSaveAndNew = isset($_POST["isSaveAndNew"]) && ($_POST["isSaveAndNew"] === true || $_POST["isSaveAndNew"] == "true");

        $now = $TD->asDb($TD->getNow(true));
        $dateScheduled = isset($call->date_schedule_c) ? $call->date_schedule_c : null;
        $dateStart = $call->date_start;
        $dateEnd = $call->date_end;
        $durationHours = $call->duration_hours;
        $durationMinutes = $call->duration_minutes;
        $status = $call->status;
        $result = isset($call->result_c) ? $call->result_c : null;

        //FIX EMPTY SCHEDULED DATE ALWAYS
        if(isset($call->date_schedule_c)) {
            if(empty($call->date_schedule_c)) {
                $call->date_schedule_c = (!empty($dateStart) ? $dateStart : $now);
            }
        }

        /**
         * FORCE-FIX FOR STATUS = 'Planned':
         *      RESULT = EMPTY
         *      START_DATE = EMPTY
         *      END_DATE = EMPTY
         */
        if($status == 'Planned') {
            if(!empty($result)) {
                $call->result_c = null;
            }
            if(!empty($dateStart)) {
                $call->date_start = null;
            }
            if(!empty($dateEnd)) {
                $call->date_end = null;
            }
        }

        /**
         * FORCE-FIX FOR STATUS = 'Held':
         *      START_DATE = NOW
         *      END_DATE = NOW+DURATION
         */
        if($status == 'Held') {
            if(empty($dateStart)) {
                $call->date_start = $now;
            }
            if(empty($durationHours)) {
                $call->duration_hours = 0;
            }
            if(empty($durationMinutes)) {
                $call->duration_minutes = 5;
            }
            if(empty($dateEnd)) {
                $td = $TD->fromDb($call->date_start);
                if($td) {
                    $call->date_end = $td->modify("+{$call->duration_hours} hours {$call->duration_minutes} mins")->asDb();
                }
            }
        }


        //Chiudi e Crea Nuovo - close the old call(the one we are closing as 'Held') with:
        // current date
        if($isSaveAndNew && $status == 'Held') {
            //set result == 'Richiamare'
            $call->result_c = 'Held_Recall';
        }

        //die("<br />KO(SETTING DATE START[".($isSaveAndNew?"Y":"N")."])!");
//        echo ("<br />S&N: ".($isSaveAndNew?"Y":"N"));
//        echo ("<br />S&N: ".( $_POST["isSaveAndNew"]));
//        echo "<br />POST: " . print_r($_POST, true);
        //die("<br />KO!");
    }
}
<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
@require_once('include/TimeDate.php');

use Mekit\Helper\SugarUserHelper;
/**
 * Created by Adam Jakab.
 * Date: 29/04/16
 * Time: 11.12
 */
class HookCallsCustomFixDates
{
    /**
     * @param \Call $call
     * @param string $event
     * @param array $arguments
     */
    public function fixEmptyScheduledDate($call, $event, $arguments)
    {
        /*
        if(!SugarUserHelper::isCurrentUserAdamJakab()) {
            return;
        }
        */

        $TD = new TimeDate();

        //Chiudi e Crea Nuovo
        $isSaveAndNew = isset($_POST["isSaveAndNew"]) && ($_POST["isSaveAndNew"] === true || $_POST["isSaveAndNew"] == "true");


        $isNewCall = true;
        /** @var \Call $originalCall */
        $originalCall = new Call();
        $originalCall = $originalCall->retrieve($call->id);
        if($originalCall instanceof \Call) {
            $isNewCall = false;
        }
        //die("NEW CALL" . ($isNewCall ? "Y" : "N"));

        $now = $TD->asDb($TD->getNow(true));

        $dateScheduled = isset($call->date_schedule_c) ? $call->date_schedule_c : null;
        $dateStart = $call->date_start;

        $dateScheduledOriginal = isset($originalCall->date_schedule_c) ? $TD->to_db($originalCall->date_schedule_c) : null;
        $dateStartOriginal = $TD->to_db($originalCall->date_start);

        $dateEnd = $call->date_end;
        $durationHours = $call->duration_hours;
        $durationMinutes = $call->duration_minutes;
        $status = $call->status;
        $result = isset($call->result_c) ? $call->result_c : null;

        //FIX EMPTY SCHEDULED DATE ALWAYS
        if(empty($dateScheduled)) {
            $dateScheduled = (!empty($dateStart) ? $dateStart : $now);
            $call->date_schedule_c = $dateScheduled;
        }


        /**
         * FORCE-FIX FOR STATUS = 'Planned'
         */
        if($status == 'Planned') {
            if(!empty($result)) {
                $result = '';
                $call->result_c = $result;
            }

            //we always have to align date_start AND date_schedule_c when Planned
            if(empty($dateStart)) {
                $dateStart = $dateScheduled;
                $call->date_start = $dateStart;
            } else {
                //when moving in calendar it will set date_start to the new date
                if($dateStart != $dateScheduled) {
                    if(!$isNewCall) {
                        $dateStartChanged =  $dateStart != $dateStartOriginal;
                        $dateScheduledChanged =  $dateScheduled != $dateScheduledOriginal;

                        if($dateScheduledChanged) {
                            $dateStart = $dateScheduled;
                            $call->date_start = $dateStart;
                        } else if ($dateStartChanged) {
                            $dateScheduled = $dateStart;
                            $call->date_schedule_c = $dateScheduled;
                        }
                    }
                }
            }

            if(!empty($dateEnd)) {
                $dateEnd = '';
                $call->date_end = $dateEnd;
            }
        }

        /**
         * FORCE-FIX FOR STATUS = 'Held'
         */
        if($status == 'Held') {
            if($isSaveAndNew) {
                //force start date to be Now
                $dateStart = $now;
                $call->date_start = $dateStart;

                //set result == 'Richiamare'
                $result = 'Held_Recall';
                $call->result_c = $result;
            }

            if(empty($dateStart)) {
                $dateStart = $now;
                $call->date_start = $dateStart;
            }
            if(empty($durationHours)) {
                $durationHours = 0;
                $call->duration_hours = $durationHours;
            }
            if(empty($durationMinutes)) {
                $durationMinutes = 5;
                $call->duration_minutes = $durationMinutes;
            }
            if(empty($dateEnd)) {
                $td = $TD->fromDb($dateStart);
                if($td) {
                    $dateEnd = $td->modify("+{$call->duration_hours} hours {$call->duration_minutes} mins")->asDb();
                    $call->date_end = $dateEnd;
                }
            }
        }

        //die("<br />KO(SETTING DATE START[".($isSaveAndNew?"Y":"N")."])!");
//        echo ("<br />S&N: ".($isSaveAndNew?"Y":"N"));
//        echo ("<br />S&N: ".( $_POST["isSaveAndNew"]));
//        echo "<br />POST: " . print_r($_POST, true);
        //die("<br />KO!");
    }
}
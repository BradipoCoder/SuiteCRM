<?php
/**
 * Created by Adam Jakab.
 * Date: 12/05/16
 * Time: 10.19
 */

namespace Mekit\Helper;

/**
 * Class SugarUserHelper
 * @package Mekit\Helper
 */
class SugarUserHelper
{
    /** @var string  */
    private static $ADAMJAKAB = '1eda4eda-43fb-df91-8975-56b1c1f35def';

    /**
     * Returns true if current user id === 1 or Adam Jakab
     * @return bool
     */
    public static function isCurrentUserAdamJakab() {
        $answer = false;
        /** @var \User $current_user */
        global $current_user;
        if ($current_user->id == self::$ADAMJAKAB || $current_user->id == 1) {
            $answer = true;
        }
        return $answer;
    }

}
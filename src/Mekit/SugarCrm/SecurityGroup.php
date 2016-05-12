<?php
/**
 * Created by Adam Jakab.
 * Date: 09/02/16
 * Time: 16.48
 */

namespace Mekit\SugarCrm;

/**
 * Class SecurityGroup
 * @package Mekit\SugarCrm
 */
class SecurityGroup {
    /** @var array */
    private static $userGroups = false;

    /**
     * @param string $groupName
     * @return bool
     */
    public static function isCurrentUserInGroup($groupName) {
        self::setupCurrentUserGroups();
        $answer = false;
        foreach(self::$userGroups as $group) {
            if($group == strtolower($groupName)) {
                $answer = true;
                break;
            }
        }
        return $answer;
    }

    /**
     * populates the local variable userGroups
     */
    protected function setupCurrentUserGroups() {
        if(!self::$userGroups) {
            global $current_user;
            require_once(__DIR__ . '/../../../modules/SecurityGroups/SecurityGroup.php');
            $securityGroup = new \SecurityGroup();
            $userGroups = $securityGroup->getUserSecurityGroups($current_user->id);
            $userGroups = array_values($userGroups);
            foreach($userGroups as $group) {
                if(isset($group["name"])) {
                    self::$userGroups[] = strtolower($group["name"]);
                }
            }
        }
    }
}
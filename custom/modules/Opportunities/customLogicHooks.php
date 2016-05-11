<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class CheckOppDiscount
{
    function check_opp_discount($bean, $event, $arguments)
    {
        //check if discount percentage is >25%
        if ($bean->opp_discount_c > 25) {
            //get assigned user bean
            $assigned_user_bean = BeanFactory::getBean("Users", $bean->assigned_user_id);
            //fetch assigned user's manager
            $manager_id = $assigned_user_bean->reports_to_id;
            //create sugar notification
            $notification = BeanFactory::getBean("Notifications");
            $notification->name = 'Opportunity - {$bean->name} is in danger';
            $notification->description = 'Discount percentage is more than 25%.';
            $notification->parent_id = $bean->id;
            $notification->parent_type = 'Opportunities';
            $notification->assigned_user_id = $manager_id;
            $notification->severity = "warning";
            $notification->is_read = 0;
            $notification->save();
        }
    }
}
<?php

/**
 * Desc: Before save logic hook to create Sugar Notification if new post or comment in Activity Stream
 * Written by: Hatim Alam
 * Dated: 21st Feb 2016
 */

class SugarNotifyUser {
    function notify_user_on_post_comment($bean, $event, $arguments) {
        //if activity type is a post
        if($bean->activity_type=="post") {
            //get the parent bean
            $parent_bean = BeanFactory::getBean($bean->parent_type, $bean->parent_id);
            //initialize notification bean
            $notification_bean = BeanFactory::getBean("Notifications");
            //check if comment or a post
            $notification_bean->name = ($bean->activity_type=="post" && $bean->comment_count==0) ? "New post on {$bean->parent_type}" : "New comment on {$bean->parent_type}";
            $notification_bean->description = "New update has been posted on <a href='#{$bean->parent_type}/{$parent_bean->id}'>{$parent_bean->name}</a>";
            //assigned user should be record assigned user
            $notification_bean->assigned_user_id = $parent_bean->assigned_user_id;
            $notification_bean->parent_id = $bean->parent_id;
            $notification_bean->parent_type =  $bean->parent_type;
            $notification_bean->created_by = $bean->created_by;
            //set is_read to no
            $notification_bean->is_read = 0;
            //set the level of severity
            $notification_bean->severity = "information";
            $notification_bean->save();
        }
    }
}

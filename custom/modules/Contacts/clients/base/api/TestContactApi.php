<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class TestContactAPi extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            'testContactUpdate' => array(
                //request type
                'reqType' => 'POST',
                //endpoint path
                'path' => array('Contacts', 'testContactUpdate'),
                //endpoint variables
                'pathVars' => array(),
                //method to call
                'method' => 'testContactUpdate',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'This is test endpoint to update contact',
                //long help to be displayed in the help documentation
                'longHelp' => '',
            ),
        );
    }

    public function testContactUpdate($api, $args)
    {
        //logic to update your contact info based on arguments received goes here

        //if contact updated successfully, notify user
        $notification_bean = BeanFactory::getBean("Notifications");
        $notification_bean->name = "Contact updated successfully.";
        $notification_bean->message = "Details of the update can go here.";
        $notification_bean->parent_type = "Contacts";
        $notification_bean->parent_id = "{$contact_id}"; //where $contact_id will come as an argument to api
        $notification_bean->assigned_user_id = "{$contact_assigned_user_id}"; //where $contact_assigned_user_id is assigned user id of contact
        $notification_bean->is_read = 0;
        //set the level of severity
        $notification_bean->severity = "information";
        $notification_bean->save();
    }
}

<?php


/**
 *
 * UNSED! - i hope
 *
 */


if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


$layout_defs['History'] = [
    'default_subpanel_define' => [
        'subpanel_title' => 'LBL_DEFAULT_SUBPANEL_TITLE',
        'top_buttons' => [
            ['widget_class' => 'SubPanelTopCreateNoteButton'],
            ['widget_class' => 'SubPanelTopArchiveEmailButton'],
            ['widget_class' => 'SubPanelTopSummaryButton'],
        ],
        'list_fields' =>[
            'Meetings' => [
                'columns' => [
                    [
                        'name' =>               'nothing',
                        'widget_class' =>       'SubPanelIcon',
                        'module' =>             'Meetings',
                        'width' =>              '2%',
                    ],
                    [
                        'name' =>               'name',
                        'vname' =>              'LBL_LIST_SUBJECT',
                        'widget_class' =>       'SubPanelDetailViewLink',
                        'width' =>              '28%',
                    ],
                ],
                'where' => "(meetings.status='Held' OR meetings.status='Not Held')",
                'order_by' => 'meetings.date_modified'
            ],
            'Emails' => [
                'columns' => [
                    [
                        'name' =>               'nothing',
                        'widget_class' =>       'SubPanelIcon',
                        'module' =>             'Emails',
                        'width' =>              '2%',
                    ],
                    [
                        'name' =>               'name',
                        'vname' =>              'LBL_LIST_SUBJECT',
                        'widget_class' =>       'SubPanelDetailViewLink',
                        'width' =>              '28%',
                    ],
                ],
                'where' => "(emails.status='sent')",
                'order_by' => 'emails.date_modified'
            ],
            'Notes' => [
                'columns' => [
                    [
                        'name' =>               'nothing',
                        'widget_class' =>       'SubPanelIcon',
                        'module' =>             'Notes',
                        'width' =>              '2%',
                    ],
                    [
                        'name' =>               'name',
                        'vname' =>              'LBL_LIST_SUBJECT',
                        'widget_class' =>       'SubPanelDetailViewLink',
                        'width' =>              '28%',
                    ],
                ],
                'where' => '',
                'order_by' => 'notes.date_modified'
            ],
            'Tasks' => [
                'columns' => [
                    [
                        'name' =>               'nothing',
                        'widget_class' =>       'SubPanelIcon',
                        'module' =>             'Tasks',
                        'width' =>              '2%',
                    ],
                    [
                        'name' =>               'name',
                        'vname' =>              'LBL_LIST_SUBJECT',
                        'widget_class' =>       'SubPanelDetailViewLink',
                        'width' =>              '28%',
                    ],
                ],
                'where' => "(tasks.status='Completed' OR tasks.status='Deferred')",
                'order_by' => 'tasks.date_start'
            ],
            'Calls' => [
                'columns' => [
                    [
                        'name' =>               'nothing',
                        'widget_class' =>       'SubPanelIcon',
                        'module' =>             'Calls',
                        'width' =>              '2%',
                    ],
                    [
                        'name' =>               'name',
                        'vname' =>              'LBL_LIST_SUBJECT',
                        'widget_class' =>       'SubPanelDetailViewLink',
                        'width' =>              '28%',
                    ],
                ],
                'where' => "(calls.status='Held' OR calls.status='Not Held')",
                'order_by' => 'calls.date_modified'
            ],
        ]
    ],
];


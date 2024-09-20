<?php

return [
    'plans' => 'Plans',
    'title' => 'List Plans',
    'table' => [
        'no' => 'No.',
        'id' => 'ID',
        'title' => 'Title',
        'created_at' => 'Created At',
        'actions' => 'Actions',
    ],
    'check_title' =>[
        'title' => 'Title is duplicated in system',
    ],
    'filter' => [
        'status' => 'Status',
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
        'from_date' => 'From Date',
        'to_date' => 'To Date',
        'options' => [
            'all' => 'All',
            'yes' => 'Yes',
            'no' => 'No',
        ]
    ],
    'bulk_actions' => [
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
        'export' => 'Export',
    ],
    'create' => [
        'title' => 'Add Plans',
        'success' => 'Create Plans Successfully',
    ],
    'edit' => [
        'title'=> 'Edit Plans',
        'success' => 'Edit Plans Successfully',
        'not_found' => 'plans not found',
    ],
    'delete' => [
        'title'=> 'Delete Plans',
        'success' => 'Delete Plans Successfully',
        'not_found' => 'plans not found'
    ],
    'form' => [
        'label' => [
            'title' => 'Title',
        ],
        'placeholder' => [
            'title' => 'Title',
        ],
        'message' =>[
            'title' => 'Are you sure ?'
        ],
        'button' =>[
            'cancel' => 'Cancel',
            'accept' => 'Accept',
        ],
    ]
];

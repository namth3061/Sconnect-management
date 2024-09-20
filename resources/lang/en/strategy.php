<?php

return [
    'strategy' => 'Strategy',
    'title' => 'List Strategy',
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
        'tenant_status' => 'Tenant Status',
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
        'title' => 'Add Strategy',
        'success' => 'Create Strategy Successfully',
    ],
    'edit' => [
        'title'=> 'Edit Strategy',
        'success' => 'Edit Strategy Successfully',
        'not_found' => 'plans not found',
    ],
    'delete' => [
        'title'=> 'Delete Strategy',
        'success' => 'Delete Strategy Successfully',
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

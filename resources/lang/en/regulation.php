<?php

return [
    'title' => 'List Regulation',
    'table' => [
        'no' => 'No.',
        'id' => 'ID',
        'title' => 'Title',
        'description' => 'Description',
        'tenant_id' => 'Tenant ID',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'actions' => 'Actions',
    ],
    'filter' => [
        'status' => 'Status',
        'regulation_status' => 'Regulation Status',
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
        'title' => 'Add Regulation',
        'success' => 'Create Regulation Successfully',
        'failed' => 'Create Regulation Failed',
    ],
    'edit' => [
        'title' => 'Edit Regulation',
        'success' => 'Edit Regulation Successfully',
        'failed' => 'Edit Regulation Failed',
    ],
    'delete' => [
        'title' => 'Delete Regulation',
        'message' => 'Are you sure to delete regulation',
        'success' => 'Delete Regulation Successfully',
        'failed' => 'Delete Regulation Failed',
    ],
    'form' => [
        'submit' => [
            'success' => 'Form submitted successfully',
        ],
        'label' => [
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ],
        'placeholder' => [
            'title' => 'Title',
            'description' => 'Description',
        ],
        'button' => [
            'accept' => 'Accept',
            'cancel' => 'Cancel',
        ]
    ],
    'validation' => [
        'duplicate' => 'Title is duplicated in system',
        'error' => 'Error while processing, please check with Admin',
        'notfound' => 'This item has been deleted or don\'t exist',
    ],
    'sidebar' => [
        'crm' => 'CRM',
        'user' => [
            'user' => 'User',
            'list' => 'User List',
        ],
        'regulation' => [
            'regulation' => 'Regulation',
            'list' => 'Regulation List',
        ],
    ]
];

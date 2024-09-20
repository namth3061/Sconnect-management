<?php

return [
    'title' => 'List Tenant',
    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'domain' => 'Domain',
        'status' => 'Status',
        'created_at' => 'Created At',
        'actions' => 'Actions',
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
        'title' => 'Add Tenant',
        'warning' => 'Domain is duplicated in system',
        'success' => 'Create Tenant Successfully',
    ],
    'edit' => [
        'title' => 'Edit Tenant',
        'warning' => 'Domain is duplicated in system',
        'success' => 'Edit Tenant Successfully',
    ],
    'delete' => [
        'title' => 'Delete',
        'message' => 'Are you sure you want to delete this Tenant?',
        'warning' => 'An error occurred during the deletion process',
        'success' => 'Delte Tenant Successfully',
    ],
    'sidebar' => [
        'tenant' => 'Tenant',
    ],
    'form' => [
        'label' => [
            'name' => 'Name',
            'domain' => 'Domain',
            'status' => 'Status',
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ],
        'placeholder' => [
            'name' => 'Name',
            'domain' => 'domain.' . config('app.url'),
        ]
    ],
    'validation' => [
        'duplicate' => 'Title is duplicated in system',
        'error' => 'Error while processing, please check with Admin',
        'notfound' => 'This item has been deleted or doesn\'t exist',
    ],
];

<?php

return [
    'title' => 'List Process',
    'table' => [
        'no' => 'No.',
        'id' => 'ID',
        'title' => 'Title',
        'description' => 'Description',
        'tenant_id' => 'Tenant ID',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'actions' => 'Actions',
    ],
    'filter' => [
        'from_date' => 'From Date',
        'to_date' => 'To Date',
    ],
    'bulk_actions' => [
        'export' => 'Export',
        'file' => 'Processes-list.xlsx',
    ],
    'create' => [
        'title' => 'Add Process',
        'success' => 'Create Process Successfully',
    ],
    'edit' => [
        'title' => 'Edit Process',
        'success' => 'Process has been updated Successfully',
    ],
    'delete' => [
        'title' => 'Delete Process',
        'success' => 'Process has been deleted Successfully',
        'warning' => 'This action cannot be undone, do you want to delete ":title" ?',
        'error' => 'Can\'t delete this process',
    ],
    'form' => [
        'submit' => [
            'success' => 'Form submitted successfully',
        ],
        'label' => [
            'title' => 'Title',
            'description' => 'Description',
        ],
        'placeholder' => [
            'title' => 'Title',
            'description' => 'Description for this process',
        ],
        'button' => [
            'accept' => 'Accept',
            'cancel' => 'Cancel',
            'ok' => 'OK',
        ]
    ],
    'validation' => [
        'duplicate' => 'Title is duplicated in system',
        'error' => 'Error while processing, please check with Admin',
        'notfound' => 'This item has been deleted or doesn\'t exist',
    ],
    'sidebar' => [
        'crm' => 'CRM',
        'user' => [
            'user' => 'User',
            'list' => 'User List',
        ],
        'process' => [
            'process' => 'Process',
            'list' => 'Process List',
        ],
    ]
];

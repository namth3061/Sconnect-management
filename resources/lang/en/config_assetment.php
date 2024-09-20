<?php

return [
    'assets' => 'Assets',
    'title' => 'List Assetment',
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
        'config_assetment_status' => 'Assetment Status',
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
        'title' => 'Add Assetment',
        'success' => 'Create Assetment Successfully',
        'failed' => 'Create Assetment Failed',
    ],
    'edit' => [
        'title' => 'Edit Assetment',
        'success' => 'Edit Assetment Successfully',
        'failed' => 'Edit Assetment Failed',
    ],
    'delete' => [
        'title' => 'Delete Assetment',
        'message' => 'Are you sure to delete assetment',
        'success' => 'Delete Assetment Successfully',
        'failed' => 'Delete Assetment Failed',
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
        'asset' => 'Asset',
        'config_assetment' => [
            'title' => 'Assetment',
            'list' => 'Assetment List',
        ],
    ]
];

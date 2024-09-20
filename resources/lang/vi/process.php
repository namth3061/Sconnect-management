<?php

return [
    'title' => 'Danh sách quy trình',
    'table' => [
        'no' => 'STT.',
        'id' => 'ID',
        'title' => 'Tiêu đề',
        'description' => 'Mô tả',
        'tenant_id' => 'ID Khối',
        'created_at' => 'Thời gian tạo',
        'updated_at' => 'Thời gian sửa',
        'actions' => 'Công cụ',
    ],
    'filter' => [
        'from_date' => 'Từ ngày',
        'to_date' => 'Đến ngày',
    ],
    'bulk_actions' => [
        'export' => 'Tải xuống bản ghi',
        'file' => 'Danh-sách-quy-trình.xlsx',
    ],
    'create' => [
        'title' => 'Tạo quy trình',
        'success' => 'Tạo quy trình thành công',
    ],
    'edit' => [
        'title' => 'Chỉnh sửa quy trình',
        'success' => 'Chỉnh sửa quy trình thành công',
    ],
    'delete' => [
        'title' => 'Xoá quy trình',
        'success' => 'Xoá quy trình thành công',
        'warning' => 'Hành động không thể hoàn tác, bạn có muốn xoá ":title" ?',
        'error' => 'Không thể xoá quy trình này',
    ],
    'form' => [
        'submit' => [
            'success' => 'Bản ghi đã được ghi nhận',
        ],
        'label' => [
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
        ],
        'placeholder' => [
            'title' => 'Tiêu đề',
            'description' => 'Mô tả cho quy trình',
        ],
        'button' => [
            'accept' => 'Chấp nhận',
            'cancel' => 'Huỷ',
        ]
    ],
    'validation' => [
        'duplicate' => 'Tiêu đề bị trùng lặp',
        'error' => 'Có lỗi diễn ra trong quá trình thực hiện, liên hệ với Admin để kiểm tra',
        'notfound' => 'Quy trình đã bị xoá hoặc không tồn tại',
    ],
    'sidebar' => [
        'crm' => 'CRM',
        'user' => [
            'user' => 'Khách hàng',
            'list' => 'Danh sách khách hàng',
        ],
        'process' => [
            'process' => 'Quy trình',
            'list' => 'Danh sách quy trình',
        ],
    ]
];

<?php

return [
    'title' => 'Danh sách quy định',
    'table' => [
        'no' => 'STT.',
        'id' => 'ID',
        'title' => 'Tiêu đề',
        'description' => 'Mô tả',
        'tenant_id' => 'ID khối',
        'status' => 'Trạng thái',
        'created_at' => 'Thời gian tạo',
        'updated_at' => 'Thời gian sửa',
        'actions' => 'Hành động',
    ],
    'filter' => [
        'status' => 'Trạng thái',
        'regulation_status' => 'Trạng thái của quy định',
        'activate' => 'Kích hoạt',
        'deactivate' => 'Ngưng kích hoạt',
        'from_date' => 'Đến ngày',
        'to_date' => 'Từ ngày',
        'options' => [
            'all' => 'Tất cả',
            'yes' => 'Có',
            'no' => 'Không',
        ]
    ],
    'bulk_actions' => [
        'activate' => 'Kích hoạt',
        'deactivate' => 'Ngưng kích hoạt',
        'export' => 'Xuất tập tin',
    ],
    'create' => [
        'title' => 'Thêm quy định',
        'success' => 'Thêm quy định mới thành công',
        'failed' => 'Thêm quy định mới thất bại',
    ],
    'edit' => [
        'title' => 'Sửa quy định',
        'success' => 'Sửa quy định thành công',
        'failed' => 'Sửa quy định thất bại',
    ],
    'delete' => [
        'title' => 'Xoá quy định',
        'message' => 'Chắc chắn muốn xoá quy định',
        'success' => 'Xoá quy định thành công',
        'failed' => 'Xoá quy định thất bại',
    ],
    'form' => [
        'submit' => [
            'success' => 'Bản ghi đã được ghi nhận',
        ],
        'label' => [
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'activate' => 'Kích hoạt',
            'deactivate' => 'Ngưng kích hoạt',
        ],
        'placeholder' => [
            'title' => 'Tiêu đề',
            'description' => 'Mô tả',
        ],
        'button' => [
            'accept' => 'Chấp nhận',
            'cancel' => 'Huỷ',
        ]
    ],
    'validation' => [
        'duplicate' => 'Tiêu đề bị trùng lặp',
        'error' => 'Có lỗi diễn ra trong quá trình thực hiện, liên hệ với Admin để kiểm tra',
        'notfound' => 'Quy định đã bị xoá hoặc không tồn tại',
    ],
    'sidebar' => [
        'crm' => 'CRM',
        'user' => [
            'user' => 'Khách hàng',
            'list' => 'Danh sách khách hàng',
        ],
        'regulation' => [
            'regulation' => 'Quy định',
            'list' => 'Danh sách quy định',
        ],
    ]
];

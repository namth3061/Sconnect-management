<?php

return [
    'assets' => 'Tài sản trí tuệ',
    'title' => 'Danh sách tài sản trí tuệ',
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
        'config_assetment_status' => 'Trạng thái của tài sản trí tuệ',
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
        'title' => 'Thêm tài sản trí tuệ',
        'success' => 'Thêm tài sản trí tuệ mới thành công',
        'failed' => 'Thêm tài sản trí tuệ mới thất bại',
    ],
    'edit' => [
        'title' => 'Sửa tài sản trí tuệ',
        'success' => 'Sửa tài sản trí tuệ thành công',
        'failed' => 'Sửa tài sản trí tuệ thất bại',
    ],
    'delete' => [
        'title' => 'Xoá tài sản trí tuệ',
        'message' => 'Chắc chắn muốn xoá tài sản trí tuệ',
        'success' => 'Xoá tài sản trí tuệ thành công',
        'failed' => 'Xoá tài sản trí tuệ thất bại',
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
        'notfound' => 'tài sản trí tuệ đã bị xoá hoặc không tồn tại',
    ],
    'sidebar' => [
        'asset' => 'Asset',
        'config_assetment' => [
            'title' => 'tài sản trí tuệ',
            'list' => 'Danh sách tài sản trí tuệ',
        ],
    ]
];

<?php

return [
    'title' => 'Danh sách khối',
    'table' => [
        'id' => 'ID',
        'name' => 'Tên',
        'domain' => 'Tên miền',
        'status' => 'Trạng thái',
        'created_at' => 'Ngày tạo',
        'actions' => 'Hành động',
    ],
    'filter' => [
        'status' => 'Trạng thái',
        'tenant_status' => 'Trạng thái khối',
        'activate' => 'Kích hoạt',
        'deactivate' => 'Hủy kích hoạt',
        'from_date' => 'Từ ngày',
        'to_date' => 'Đến ngày',
        'options' => [
            'all' => 'Tất cả',
            'yes' => 'Có',
            'no' => 'Không',
        ]
    ],
    'bulk_actions' => [
        'activate' => 'Kích hoạt',
        'deactivate' => 'Hủy kích hoạt',
        'export' => 'Xuất',
    ],
    'sidebar' => [
        'tenant' => 'Khối',
    ],
    'create' => [
        'title' => 'Thêm Khối',
        'warning' => 'Tên miền bị trùng lặp trong hệ thống',
        'success' => 'Tạo khối thành công',
    ],
    'edit' => [
        'title' => 'Chỉnh sửa Tenant',
        'warning' => 'Tên miền đã tồn tại trong hệ thống',
        'success' => 'Chỉnh sửa Tenant thành công',
    ],
    'delete' => [
        'title' => 'Xóa',
        'message' => 'Bạn có chắc chắn muốn xóa khối này không??',
        'warning' => 'Có lỗi trong quá trình xóa',
        'success' => 'Xóa khối thành công',
    ],
    'form' => [
        'label' => [
            'name' => 'Tên',
            'domain' => 'Tên miền',
            'status' => 'Trạng thái',
            'activate' => 'Kích hoạt',
            'deactivate' => 'Hủy kích hoạt',
        ],
        'placeholder' => [
            'name' => 'Tên',
            'domain' => 'domain.' . config('app.url'),
        ]
    ],
    'validation' => [
        'duplicate' => 'Tên miền đã tồn tại trong hệ thống',
        'error' => 'Đã xảy ra lỗi trong quá trình xử lý, vui lòng liên hệ Quản trị viên',
        'notfound' => 'Mục này đã bị xóa hoặc không tồn tại',
    ],
];

<?php
return [
    'strategy' => 'Chiến lược',
    "title" => "Danh sách Chiến lược",
    "table" => [
        'no' => 'STT.',
        "id" => "ID",
        "title" => "Tiêu đề",
        "created_at" => "Ngày tạo",
        "actions" => "Hành động"
    ],
    "check_title" => [
        "title" => "Tiêu đề đã bị trùng trong hệ thống"
    ],
    "filter" => [
        "status" => "Trạng thái",
        "tenant_status" => "Trạng thái người thuê",
        "activate" => "Kích hoạt",
        "deactivate" => "Ngưng hoạt động",
        "from_date" => "Từ ngày",
        "to_date" => "Đến ngày",
        "options" => [
            "all" => "Tất cả",
            "yes" => "Có",
            "no" => "Không"
        ]
    ],
    "bulk_actions" => [
        "activate" => "Kích hoạt",
        "deactivate" => "Ngưng hoạt động",
        "export" => "Xuất dữ liệu"
    ],
    "create" => [
        "title" => "Thêm Chiến lược",
        "success" => "Tạo Chiến lược thành công"
    ],
    "edit" => [
        "title" => "Chỉnh sửa Chiến lược",
        "success" => "Chỉnh sửa Chiến lược thành công",
        "not_found" => "Không tìm thấy kế hoạch"
    ],
    "delete" => [
        "title" => "Xóa Chiến lược",
        "success" => "Xóa Chiến lược thành công",
        "not_found" => "Không tìm thấy kế hoạch"
    ],
    "form" => [
        "label" => [
            "title" => "Tiêu đề"
        ],
        "placeholder" => [
            "title" => "Tiêu đề"
        ],
        "message" => [
            "title" => "Bạn có chắc chắn không ?"
        ],
        "button" => [
            "cancel" => "Hủy",
            "accept" => "Chấp nhận"
        ]
    ]
];

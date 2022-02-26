<?php

/**
 * Routes
 */

if (!defined('HOME')) {
    define('HOME', 'home');
}

if (!defined('DOCUMENT_INDEX')) {
    define('DOCUMENT_INDEX', 'document.index');
}

if (!defined('DOCUMENT_CREATE')) {
    define('DOCUMENT_CREATE', 'document.create');
}

if (!defined('DOCUMENT_STORE')) {
    define('DOCUMENT_STORE', 'document.store');
}

if (!defined('DOCUMENT_SHOW')) {
    define('DOCUMENT_SHOW', 'document.show');
}

if (!defined('DOCUMENT_EDIT')) {
    define('DOCUMENT_EDIT', 'document.edit');
}

if (!defined('REFERENCES')) {
    define('REFERENCES', [
        'Giấy đăng ký kiểm tra chất lượng hàng hóa nhập khẩu',
        'Hợp đồng (bản sao)',
        'Danh mục hàng hóa (Packing list) kèm theo hợp đồng (bản sao)',
        'Giấy chứng nhận hợp quy',
        'Kết quả tự đánh giá',
        'Hóa đơn (Invoice)',
        'Vận đơn (Bill of Lading)',
        'Tờ khai hàng hóa nhập khẩu',
        'Ảnh hoặc bản mô tả hàng hóa',
        'Mẫu nhãn hàng nhập khẩu đã được gắn dấu hợp quy',
        'Nhãn phụ (nếu nhãn chính chưa đủ nội dung theo quy định)',
    ]);
}

if (!defined('DIGITAL_NAMESPACE')) {
    define('DIGITAL_NAMESPACE', '/CTV-TT2');
}

if (!defined('HTTP_SUCCESS')) {
    define('HTTP_SUCCESS', 200);
}

if (!defined('HTTP_BAD_REQUEST')) {
    define('HTTP_BAD_REQUEST', 400);
}

if (!defined('STR_ERROR_FLASH')) {
    define('STR_ERROR_FLASH', 'error-flash');
}

if (!defined('STR_SUCCESS_FLASH')) {
    define('STR_SUCCESS_FLASH', 'success-flash');
}

if (!defined('PAGINATE_DEFAULT')) {
    define('PAGINATE_DEFAULT', '10');
}

if (!defined('DEAD_LINE_STATUS')) {
    define('DEAD_LINE_STATUS', '0');
}

if (!defined('ACTIVE')) {
    define('ACTIVE', '1');
}
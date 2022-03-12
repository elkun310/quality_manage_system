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

if (!defined('DOCUMENT_CHANGE_PUBLISH')) {
    define('DOCUMENT_CHANGE_PUBLISH', 'document.change_publish');
}

if (!defined('DOCUMENT_COMPLETE')) {
    define('DOCUMENT_COMPLETE', 'document.complete');
}

if (!defined('DOCUMENT_EXPORT_PDF')) {
    define('DOCUMENT_EXPORT_PDF', 'document.export_pdf');
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

if (!defined('DOCUMENT_UPDATE')) {
    define('DOCUMENT_UPDATE', 'document.update');
}

if (!defined('DOCUMENT_DELETE')) {
    define('DOCUMENT_DELETE', 'document.destroy');
}

if (!defined('REFERENCES')) {
    define('REFERENCES', [
        'Hợp đồng (bản sao)',
        'Danh mục hàng hóa (Packing list) kèm theo hợp đồng (bản sao)',
        'Giấy chứng nhận hợp quy',
        'Kết quả tự đánh giá',
        'Hóa đơn (Invoice)',
        'Vận đơn (Bill of Lading)',
        'Tờ khai hàng hóa nhập khẩu',
        'Ảnh hoặc bản mô tả hàng hóa (tài liệu kỹ thuật)',
        'Mẫu nhãn hàng nhập khẩu đã được gắn dấu hợp quy',
        'Nhãn phụ (nếu nhãn chính chưa đủ nội dung theo quy định)',
    ]);
}

if (!defined('DIGITAL_NAMESPACE')) {
    define('DIGITAL_NAMESPACE', '/CVT-CNDV');
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

if (!defined('ALL')) {
    define('ALL', "null");
}

if (!defined('IS_PUBLISH')) {
    define('IS_PUBLISH', 1);
}

if (!defined('NOT_PUBLISH')) {
    define('NOT_PUBLISH', 0);
}

if (!defined('IS_COMPLETE')) {
    define('IS_COMPLETE', 1);
}

if (!defined('AREA_RECEIVE')) {
    define('AREA_RECEIVE', [
        'Miền Bắc', 'Miền Trung', 'Miền Nam'
    ]);
}

if (!defined('AREA_RECEIVE_MB')) {
    define('AREA_RECEIVE_MB', 0);
}

if (!defined('AREA_RECEIVE_MT')) {
    define('AREA_RECEIVE_MT', 1);
}

if (!defined('AREA_RECEIVE_MN')) {
    define('AREA_RECEIVE_MN', 2);
}

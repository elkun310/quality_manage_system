<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('references')->truncate();
        DB::table('references')->insert([
            [
                'name' => 'Giấy đăng ký kiểm tra chất lượng hàng hóa nhập khẩu',
            ],
            [
                'name' => 'Hợp đồng (bản sao)',
            ],
            [
                'name' => 'Danh mục hàng hóa (Packing list) kèm theo hợp đồng (bản sao)',
            ],
            [
                'name' => 'Giấy chứng nhận hợp quy',
            ],
            [
                'name' => 'Kết quả tự đánh giá',
            ],
            [
                'name' => 'Hóa đơn (Invoice)',
            ],
            [
                'name' => 'Vận đơn (Bill of Lading)',
            ],
            [
                'name' => 'Tờ khai hàng hóa nhập khẩu',
            ],
            [
                'name' => 'Ảnh hoặc bản mô tả hàng hóa',
            ],
            [
                'name' => 'Mẫu nhãn hàng nhập khẩu đã được gắn dấu hợp quy',
            ],
            [
                'name' => 'Nhãn phụ (nếu nhãn chính chưa đủ nội dung theo quy định)',
            ],
        ]);
    }
}

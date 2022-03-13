<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>export pdf</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        hr {
            width: 100px;
            border: 1px solid #000000;
        }

        table, th, td {
            border: 1px solid #212529;
        }

        th, td {
            padding: 1px 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .table-responsive > .table-bordered {
            border: 0;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .text-center {
            text-align: center;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .title-basic {
            width: 200px;
            display: inline-block;
        }

        .content-basic {
            display: inline-block;
            margin-left: 20px;
        }
        .float-right {
            float: right;
        }
        .clear-both {
            clear: both;
        }
        .ml-200 {
            margin-left: 200px;
        }
        .m-0 {
            margin: 0;
        }
        p {
            margin : 10px 0;
        }
    </style>
</head>
<body>
    <section class="document-pdf-wrapper">
        <div class="container">
            <div class="row">
                <div class="card-header col-md-12 text-center">
                    <h3 class="m-0">CỤC VIỄN THÔNG</h3>
                    <hr>
                    <h4 class="m-0">PHIẾU NHẬN HỒ SƠ ĐĂNG KÝ KIỂM TRA CHẤT LƯỢNG HÀNG HOÁ NHẬP KHẨU</h4>
                    <p>Số : {{ $document->number_receive_tech }} / KTCL-CNDV</p>
                </div>
            </div>
            <div class="card-body">
                <div class="basic-data">
                    <p>
                    <span class="title-basic">
                        Đơn vị nộp hồ sơ
                    </span>
                        :
                        <span class="content-basic">
                        {{ $document->name_company }}
                    </span>
                    </p>
                    <p>
                    <span class="title-basic">
                        Địa chỉ
                    </span>
                        :
                        <span class="content-basic">
                        {{ $document->address }}
                    </span>
                    <p>
                    <span class="title-basic">
                        Ngày của đăng ký
                    </span>
                        :
                        <span class="content-basic">
                        {{ $document->register_date }}
                    </span>
                    </p>
                    <p>
                    <span class="title-basic">
                        Ký hiệu thiết bị
                    </span>
                        :
                        <span class="content-basic">
                        @for($i = 0; $i < $document->products->count(); $i ++)
                                {{ $document->products[$i]->symbol. ($i < $document->products->count()- 1 ? " , " : " ") }}
                            @endfor
                    </span>
                    </p>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Hạng mục kiểm tra</th>
                        <th colspan="2"> Có / Không</th>
                        <th rowspan="2">Ghi chú</th>
                    </tr>
                    <tr>
                        <th>Có</th>
                        <th>Không</th>
                    </tr>
                    <tr>
                        <td class="text-center">
                            1
                        <td>
                            Giấy đăng ký kiểm tra chất lượng hàng hóa nhập khẩu
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            2
                        <td>
                            Hợp đồng (bản sao)
                        <td class="text-center">
                            <label for="customCheckbox1">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                            </label>
                        <td class="text-center">
                            <label for="customCheckbox1">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                            </label>
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            3
                        <td>
                            Danh mục hàng hóa (Packing list) kèm theo hợp đồng (bản sao)
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            4
                        <td>
                            Bản sao chứng chỉ chất lượng
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center" rowspan="2">

                        <td>
                            Giấy chứng nhận hợp quy
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            Kết quả tự đánh giá
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            5
                        <td>
                            Hóa đơn (Invoice)
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            6
                        <td>
                            Vận đơn (Bill of Lading)
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            7
                        <td>
                            Tờ khai hàng hóa nhập khẩu
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            8
                        <td>
                            Ảnh hoặc bản mô tả hàng hóa (tài liệu kỹ thuật)
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">

                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            9
                        <td>
                            Mẫu nhãn hàng nhập khẩu đã được gắn dấu hợp quy
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            10
                        <td>
                            Nhãn phụ (nếu nhãn chính chưa đủ nội dung theo quy định)
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td class="text-center">
                            <input class="custom-control-input" type="checkbox">
                        <td>

                        </td>
                    </tr>

                </table>
                <p class="font-weight-bold">Ghi chú : </p>
                <p class="float-right">...................., ngày tháng năm 202...</p>
                <p class="font-weight-bold clear-both text-center">
                    Người nộp hồ sơ
                    <span class="font-weight-bold ml-200">Người tiếp nhận</span>
                </p>
                <br>
                <p class="font-weight-bold">Điện thoại liên hệ : </p>
            </div>
        </div>
    </section>
</body>
</html>

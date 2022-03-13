<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;0,700;1,100;1,400;1,500&display=swap"
          rel="stylesheet">
    <title>template transfer</title>
    <style>
        @page { size: auto;  margin: 0; }
        body {
            font-family: 'Roboto', sans-serif;
        }

        .template-transfer-wrapper {
            padding: 20px 10px;
        }

        .text-center {
            text-align: center;
        }

        h3 {
            font-size: 18px;
        }

        .font-bold {
            font-weight: bold;
        }

        .title-uppercase {
            text-transform: uppercase;
        }

        hr {
            width: 150px;
            border: 1px solid #000000;
        }

        .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td, .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        table {
            border-collapse: collapse;
        }

        .float-right {
            float: right;
        }

        .clear-both {
            clear: both;
        }

        .mr-50 {
            margin-right: 50px;
        }

        .mr-120 {
            margin-right: 120px;
        }

        .mr-100 {
            margin-right: 100px;
        }

        .w-400 {
            width: 400px;
        }

        .font-italic {
            font-style: italic;
        }
        .error {
            color : #dd4b39;
        }
    </style>
</head>
<body>
<section class="template-transfer-wrapper">
    <div class="container">
        <div class="row">
            <div class="card-header col-md-12 text-center">
                <h3 class="title-uppercase">phòng công nghệ và dịch vụ</h3>
                <hr>
                <h3 class="title-uppercase">phiếu chuyển giấy đăng ký kiểm tra chất lượng hàng hoá nhập khẩu</h3>
            </div>
        </div>
        <br><br>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="font-bold">STT</th>
                    <th class="font-bold">Tên tổ chức, cá nhân nhập khẩu</th>
                    <th class="font-bold">Vào sổ đăng ký số</th>
                    <th class="font-bold w-400">Ghi chú</th>
                </tr>
                </thead>

                <tbody>
                    @forelse($files as $key => $file)
                        <tr>
                            <td class="text-center">{{ $key +1 }}</td>
                            <td>{{ $file->name_company }}</td>
                            <td>{{ $file->digital_code }}</td>
                            <td></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="error text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
            <br><br>
            <p class="float-right mr-50">...................., ngày tháng năm 202...</p>
            <p class="font-bold clear-both text-center float-right mr-120">
                Chuyên viên
            </p>
            <br>
            <p class="font-italic clear-both text-center float-right mr-100">
                (Ký và ghi rõ họ tên)
            </p>
        </div>
    </div>
</section>
</body>
</html>
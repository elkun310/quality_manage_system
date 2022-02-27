@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Hồ sơ {{ $document->digital_code }}</h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route(DOCUMENT_INDEX) }}">Danh sách hồ sơ</a></li>
                        <li class="breadcrumb-item active">Chi tiết hồ sơ</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid invoice">
            <div class="row">
                <div class="card-header col-md-12 text-center">
                    <h5>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</h5>
                    <h6>Độc lập - Tự do - Hạnh phúc</h6>
                    <br>
                    <h5>ĐĂNG KÝ KIỂM TRA</h5>
                    <h5>NHÀ NƯỚC VỀ CHẤT LƯỢNG QUẢN LÝ SẢN PHẨM</h5>
                    <h6 class="text-bold">Kính gửi: Cục viễn thông</h6>
                </div>
            </div>

            <div class="card-body">
                <div class="row invoice-info">
                    <div class="col-sm-12">
                        <p>Người nhập khẩu : <span class="text-bold">{{ $document->name_company }}</span></p>
                        <p>Địa chỉ : {{ $document->address }}</p>
                        <p>Điện thoại : {{ $document->phone }}</p>
                        <p>Email : {{ $document->email }}</p>
                        <p>Ngày hết hạn : {{ \Carbon\Carbon::parse($document->dead_line)->format('d-m-Y') }}</p>
                        @if($document->url)
                        <p>File đính kèm:
                            <a target="_blank" href="{{Illuminate\Support\Facades\Storage::disk('public')->url('attach_files/'. $document->url)}}">Xem</a>
                        </p>
                        @endif
                        <h5>Đăng ký kiểm chất lượng hàng hoá sau : </h5>

                        <div class="p-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">STT</th>
                                    <th>Tên hàng , nhãn hiệu, kiểu loại</th>
                                    <th>Đặc tính kỹ thuật</th>
                                    <th>Xuất xứ, nhà sản xuất</th>
                                    <th>Khối lượng số lượng</th>
                                    <th>Cửa khẩu nhập</th>
                                    <th>Thời gian nhập khẩu</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($document->products as $key => $product)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product->name. ". Model: ". $product->symbol}}</td>
                                        <td>{{ $product->specification }}</td>
                                        <td>{{ $product->origin }}</td>
                                        <td>{{ $product->amount }}</td>
                                        <td>{{ $document->import_gate }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($document->import_date)->format('d-m-Y') }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center border-0 text-danger" colspan="7">Không có sản phẩm nào</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <p>Địa chỉ tập kết hàng hoá : Sân bay Tây Sơn Nhất</p>
                        <h5>Hồ sơ nhập khẩu gồm : </h5>
                        <ul>
                            @forelse($document->references as $reference)
                                <li>
                                    {{ $reference->name. "." }}
                                    @if(isset($reference->code))
                                        Số : {{ $reference->code }},
                                    @endif

                                    @if(isset($reference->publish_date))
                                        cấp ngày : {{ $reference->publish_date }}
                                    @endif
                                </li>
                            @empty
                                <p class="text-center border-0 text-danger">Không có tài liệu nào</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
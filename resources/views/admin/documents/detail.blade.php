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
                    <h5>NHÀ NƯỚC VỀ CHẤT LƯỢNG HÀNG HÓA NHẬP KHẨU</h5>
                    <h6 class="text-bold">Kính gửi: Cục viễn thông</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row invoice-info">
                    <div class="col-sm-12">
                        <p>Người nhập khẩu : <span class="text-bold">{{ $document->name_company }}</span></p>
                        <p>Ngày đăng ký : {{ $document->register_date }}</p>
                        <p>Địa chỉ : {{ $document->address }}</p>
                        <p>Điện thoại : {{ $document->phone }}</p>
                        <p>Email : {{ $document->email }}</p>
                        <p>Ngày hết hạn : {{ \Carbon\Carbon::parse($document->dead_line)->format('d-m-Y') }}</p>
                        @if($document->url)
                        <p>File giấy đăng ký được xác nhận (đính kèm) : 
                            <a target="_blank" href="{{asset('storage/attach_files/' . $document->url)}}">Xem</a>
                        </p>
                        @endif

                        @if($document->complete_file)
                            <p>File hoàn thiện hồ sơ :
                                <a target="_blank" href="{{asset('storage/complete_files/' . $document->complete_file)}}">Xem</a>
                            </p>
                        @endif

                        <p>Khu vực tiếp nhận : {{ AREA_RECEIVE[$document->area_receive] }}</p>

                        <h5>Đăng ký kiểm chất lượng hàng hoá sau : </h5>

                        <div class="p-0 table-responsive">
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

                                <tr>
                                    <td>{{ 1 }}</td>
                                    <td>{{ $document->products[0]->name. ". Model: ". $document->products[0]->symbol}}</td>
                                    <td>{{ $document->products[0]->specification }} <br> {{ $document->products[0]->standard }}</td>
                                    <td>{{ $document->products[0]->origin }}</td>
                                    <td>{{ $document->products[0]->amount }}</td>
                                    <td rowspan="{{ $document->products->count() }}" class="td-center">{{ $document->import_gate }}</td>
                                    <td rowspan="{{ $document->products->count() }}" class="td-center">{{ $document->import_date }}</td>
                                </tr>

                                @php($document->products->shift())
                                @if(count($document->products) > 0)

                                @forelse($document->products as $key => $product)
                                    <tr>
                                        <td>{{ $key+2 }}</td>
                                        <td>{{ $product->name. ". Model: ". $product->symbol}}</td>
                                        <td>{{ $product->specification }} <br> {{ $product->standard }}</td>
                                        <td>{{ $product->origin }}</td>
                                        <td>{{ $product->amount }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center border-0 text-danger" colspan="7">Không có sản phẩm nào</td>
                                    </tr>
                                @endforelse
                                    @endif
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

                                    @if($reference->publish_date)
                                        cấp ngày : {{ $reference->publish_date }}
                                    @endif
                                </li>
                            @empty
                                <p class="text-center border-0 text-danger">Không có tài liệu nào</p>
                            @endforelse
                        </ul>
                        <hr>
                        <p>Số phiếu tiếp nhận của phòng CNDV : {{ $document->number_receive_tech }} / KTCL-CNDV</p>
                        <p class="font-weight-bold">
                            Vào sổ đăng ký số : {{ $document->digital_code }}<br/>
                            Ngày : {{ \Carbon\Carbon::parse($document->created_at)->format('d-m-Y') }}
                        </p>
                        <a class="btn btn-default" href="{{ route(DOCUMENT_EXPORT_PDF, $document->id) }}">Xuất PDF</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
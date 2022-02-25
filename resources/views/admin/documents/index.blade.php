@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Danh sách hồ sơ</h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách hồ sơ</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">Tìm kiếm</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="get" action="{{ route(DOCUMENT_INDEX) }}">
                        <div class="input-group">
                            <input name="search" type="search" class="form-control form-control-lg" value="{{ $param['search'] ?? "" }}" placeholder="Mời nhập tên công ty, mã ký số">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>

            <div class="col-md-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">STT</th>
                                <th>Tên công ty</th>
                                <th>Mã ký số</th>
                                <th>Địa chỉ</th>
                                <th>Ngày quá hạn</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($documents as $key => $document)
                                <tr class="@if($document->dead_line < now()->format('Y-m-d'))dead-line-bg @endif">
                                    <td>{{ $documents->currentPage() * $documents->perPage() - $documents->perPage() + $key +1 }}</td>
                                    <td>{{ $document->name_company }}</td>
                                    <td>{{ $document->digital_code }}</td>
                                    <td>{{ $document->address }}</td>
                                    <td>{{ \Carbon\Carbon::parse($document->dead_line)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route(DOCUMENT_SHOW, $document->id) }}" class="mr-2"><button class="btn btn-info btn-action">Xem</button></a>
                                        <a href="{{ route(DOCUMENT_EDIT, $document->id) }}" class="mr-2"><button class="btn btn-warning btn-action">Sửa</button></a>
                                        <a href="#" class="mr-2"><button class="btn btn-danger btn-action">Xoá</button></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center border-0 text-danger" colspan="6">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        {{ $documents->appends($param)->links() }}
                        @if($documents->total() > PAGINATE_DEFAULT)
                            <p>Tổng số hoá đơn : {{ $documents->total() }}</p>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
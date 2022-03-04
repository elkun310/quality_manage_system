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
            <form class="filter-document-form" method="get" action="{{ route(DOCUMENT_INDEX) }}">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="input-group">
                            <input name="search" type="search" class="form-control form-control-lg f-18"
                                   value="{{ $param['search'] ?? "" }}" placeholder="Mời nhập tên công ty, mã ký số">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <select class="form-control slt-status" name="dead_line">
                                <option value="{{ ALL }}" @if(isset($param['dead_line']) && $param['dead_line'] === ALL) selected @endif>Tất cả</option>
                                <option value="{{ ACTIVE }}" @if(isset($param['dead_line']) && $param['dead_line'] === ACTIVE) selected @endif>Còn hạn</option>
                                <option value="{{ DEAD_LINE_STATUS }}" @if(isset($param['dead_line']) && $param['dead_line'] === DEAD_LINE_STATUS) selected @endif>Quá hạn</option>
                            </select>
                        </div>
                    </div>
                </div>

            </form>

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
                                <th>Tình trạng</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($documents as $key => $document)
                                <tr>
                                    <td>{{ $documents->currentPage() * $documents->perPage() - $documents->perPage() + $key +1 }}</td>
                                    <td>{{ $document->name_company }}</td>
                                    <td>{{ $document->digital_code }}</td>
                                    <td>{{ $document->address }}</td>
                                    <td>{{ \Carbon\Carbon::parse($document->dead_line)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($document->dead_line < now()->format('Y-m-d'))
                                            <span class="badge badge-danger">Quá hạn</span>
                                        @else
                                            <span class="badge badge-success">Còn hạn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route(DOCUMENT_SHOW, $document->id) }}"
                                           class="btn btn-primary btn-sm mb-2">
                                            <i class="fas fa-eye">
                                            </i>
                                            Xem
                                        </a>
                                        <a class="btn btn-info btn-sm mb-2"
                                           href="{{ route(DOCUMENT_EDIT, $document->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sửa
                                        </a>

{{--                                        <form action="{{ route(DOCUMENT_DELETE, $document->id) }}" method="POST" >--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit"  class="btn btn-danger btn-sm mb-2" onclick="return confirm('Bạn có chắc chắn muốn xoá hồ sơ này không ? ')">--}}
{{--                                                <i class="fas fa-trash">--}}
{{--                                                </i>--}}
{{--                                                Xoá--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center border-0 text-danger" colspan="7">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        @if($documents->total() > PAGINATE_DEFAULT)
                            {{ $documents->appends($param)->links() }}
                        @endif
                            <p>Tổng số giấy đăng ký : {{ $documents->total() }}</p>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('js')
    <script src="{{ asset('js/custom/document-manage.js') }}"></script>
@endsection
@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Phiếu chuyển giấy đăng ký</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Khu vực tiếp nhận</h3>
                        </div>
                        <!-- /.card-header -->
                        <p class="required-icon m-2">* Lưu ý : ngày tạo phiếu là ngày hiện tại</p>

                        <form method="get" action="{{ route(GENERATE_FILE) }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="input-group col-sm-9">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="area_receive"
                                                               id="area_receive_1" value="{{ AREA_RECEIVE_MT }}">
                                                        <label class="form-check-label" for="area_receive_1">Miền
                                                            Trung</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="area_receive"
                                                               id="area_receive_2" value="{{ AREA_RECEIVE_MN }}">
                                                        <label class="form-check-label" for="area_receive_2">Miền
                                                            Nam</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('area_receive')
                                        <div class="has-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tạo phiếu</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
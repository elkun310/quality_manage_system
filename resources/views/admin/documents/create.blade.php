@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/custom/product.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Thêm hồ sơ</h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thêm hồ sơ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form class="document-create" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Thông tin hồ sơ -->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Hồ sơ đăng ký, kiểm tra chất lượng hàng hoá</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name_company" class="col-sm-3 col-form-label">Tên công ty</label>
                                    <input required type="text" class="form-control col-sm-9" id="name_company"
                                           placeholder="Nhập tên công ty" name="name_company" autocomplete="off">
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <input required type="text" class="form-control col-sm-9" id="address"
                                           placeholder="Nhập địa chỉ" name="address">
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input id="phone" required class="form-control" type="text"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Địa chỉ email</label>
                                    <input type="email" class="form-control col-sm-9" id="email"
                                           placeholder="Nhập email" name="email">
                                </div>

                                <div class="form-group row">
                                    <label for="import_gate" class="col-sm-3 col-form-label">Cửa khẩu nhập</label>
                                    <input required type="text" class="form-control col-sm-9" id="import_gate"
                                           placeholder="Nhập cửa khẩu" name="import_gate">
                                </div>

                                <div class="form-group row">
                                    <label for="import_date" class="col-sm-3 col-form-label">Thời gian nhập</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="import_date" type="text" class="form-control"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                               data-mask="" inputmode="numeric" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="attach_file" class="col-sm-3 col-form-label">File đính kèm (nếu có)</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="attach_file">
                                            <label class="custom-file-label" for="attach_file">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <!--Tài liệu đính kèm-->
                                <div class="form-group row">
                                    <label for="references" class="col-sm-3 col-form-label">Tài liệu kèm theo</label>
                                    <div class="col-sm-9 no-padding wrapper-reference">
                                        <div class="form-check reference-item">
                                            <input class="form-check-input chb-reference" type="checkbox" id="reference1">
                                            <label class="form-check-label" for="reference1">Giấy đăng ký kiểm tra chất lượng hàng hóa nhập khẩu</label>
                                            <div class="form-group mt-2 reference-detail">
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Ngày cấp</label>
                                                    <div class="input-group col-sm-5 no-padding">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                               data-mask="" inputmode="numeric" placeholder="dd/mm/yyyy">
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <label class="col-sm-2 col-form-label">Mã số cấp</label>
                                                    <div class="input-group col-sm-5 no-padding">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input required type="text" class="form-control" placeholder="Nhập mã số cấp">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check reference-item">
                                            <input class="form-check-input chb-reference" type="checkbox" id="reference2">
                                            <label class="form-check-label" for="reference2">Giấy đăng ký kiểm tra chất lượng hàng hóa nhập khẩu</label>
                                            <div class="form-group mt-2 reference-detail">
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Ngày cấp</label>
                                                    <div class="input-group col-sm-5 no-padding">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                               data-mask="" inputmode="numeric" placeholder="dd/mm/yyyy">
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <label class="col-sm-2 col-form-label">Mã số cấp</label>
                                                    <div class="input-group col-sm-5 no-padding">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input required type="text" class="form-control" placeholder="Nhập mã số cấp">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin hàng hoá -->
                    <div class="col-md-12 wrapper-product mt-3">
                        <div class="d-flex mb-2">
                            <h5>Thông tin hàng hoá</h5>
                            <button type="button" class="btn bg-gradient-primary btn-add-product"> <i class="fas fa-plus mr-1"></i>Thêm</button>
                        </div>

                        <div class="card card-default product-item">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Tên hàng hoá</label>
                                    <textarea id="name" class="form-control col-sm-9" rows="2" placeholder="Nhập tên hàng hoá"></textarea>
                                </div>

                                <div class="form-group row">
                                    <label for="specification" class="col-sm-3 col-form-label">Đặc tính kỹ thuật</label>
                                    <input required type="text" class="form-control col-sm-9" id="specification"
                                           placeholder="Nhập đặc tính kỹ thuật" name="specification" autocomplete="off">
                                </div>

                                <div class="form-group row">
                                    <label for="symbol" class="col-sm-3 col-form-label">Ký hiệu</label>
                                    <input required type="text" class="form-control col-sm-9" id="symbol"
                                           placeholder="Nhập ký hiệu" name="symbol" autocomplete="off">
                                </div>

                                <div class="form-group row">
                                    <label for="origin" class="col-sm-3 col-form-label">Xuất xứ, nhà sản xuất</label>
                                    <input required type="text" class="form-control col-sm-9" id="origin"
                                           placeholder="Nhập xuất xứ, nhà sản xuất" name="origin" autocomplete="off">
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-3 col-form-label">Số lượng (Bộ)</label>
                                    <input required type="text"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control col-sm-9" id="amount"
                                           placeholder="Nhập số lượng" name="amount" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('js/custom/document-manage.js') }}"></script>
@endsection
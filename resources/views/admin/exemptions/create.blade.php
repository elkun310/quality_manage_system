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
                    <h4 class="m-0">Thêm miễn giảm</h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route(EXEMPTION_INDEX) }}">Danh sách miễn giảm</a></li>
                        <li class="breadcrumb-item active">Thêm miễn giảm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form class="exemption-create" method="post" enctype="multipart/form-data" novalidate>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Thông tin miễn giảm -->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Miễn giảm chất lượng sản phẩm</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name_company" class="col-sm-3 col-form-label">Tên công ty</label>
                                    <input required type="text" class="form-control col-sm-9" id="name_company"
                                           placeholder="Nhập tên công ty" name="name_company" autocomplete="off" data-name="name_company">
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="name_company"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="expired" class="col-sm-3 col-form-label">Thời hạn</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="expired" type="text" class="form-control"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                               data-mask="" inputmode="numeric" name="expired" placeholder="dd/mm/yyyy" data-error="expired">
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error" data-error="expired"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="dispatch_number" class="col-sm-3 col-form-label">Số công văn</label>
                                    <input required type="text" class="form-control col-sm-9" id="dispatch_number"
                                           placeholder="Nhập địa chỉ" name="dispatch_number" data-name="dispatch_number">
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="dispatch_number"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="dispatch_date" class="col-sm-3 col-form-label">Ngày công văn</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="dispatch_date" type="text" class="form-control"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                               data-mask="" inputmode="numeric" name="dispatch_date" placeholder="dd/mm/yyyy" data-error="dispatch_date">
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="dispatch_date"></p>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dispatch_file" class="col-sm-3 col-form-label">File công văn</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="dispatch_file" name="dispatch_file" data-error="attach_file">
                                            <label class="custom-file-label" for="dispatch_file">Choose file</label>
                                        </div>
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error" data-error="dispatch_file"></p>
                                </div>

                        <!-- Thông tin hàng hoá -->
                        <div class="col-md-12 wrapper-product mt-3">
                            <div class="d-flex mb-2">
                                <h5>Thông tin hàng hoá</h5>
                                <button type="button" class="btn bg-gradient-primary btn-add-product"> <i class="fas fa-plus mr-1"></i>Thêm</button>
                            </div>
                            <p class="col-sm-9 text-danger no-padding error" data-error="product"></p>
                            <div class="card card-default product-item">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Tên hàng hoá</label>
                                        <textarea id="name" class="form-control col-sm-9 name-product" rows="2" placeholder="Nhập tên hàng hoá"></textarea>
                                    </div>

                                    <div class="form-group row">
                                        <label for="specification" class="col-sm-3 col-form-label">Đặc tính kỹ thuật</label>
                                        <input required type="text" class="form-control col-sm-9 specification" id="specification"
                                            placeholder="Nhập đặc tính kỹ thuật" autocomplete="off">
                                    </div>

                                    <div class="form-group row">
                                        <label for="symbol" class="col-sm-3 col-form-label">Ký hiệu</label>
                                        <input required type="text" class="form-control col-sm-9 symbol" id="symbol"
                                            placeholder="Nhập ký hiệu" autocomplete="off">
                                    </div>

                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-3 col-form-label">Số lượng</label>
                                        <input required type="text"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control col-sm-9 amount" id="amount"
                                            placeholder="Nhập số lượng" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-submit">Lưu</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('js/custom/exemption-manage.js') }}"></script>
@endsection
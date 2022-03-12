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
                    <h4 class="m-0">Sửa hồ sơ {{ $document->digital_code }}</h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route(DOCUMENT_INDEX) }}">Danh sách hồ sơ</a></li>
                        <li class="breadcrumb-item active">Sửa hồ sơ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form class="document-update" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="" value="{{ $document->id }}" class="document-id">
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
                                           placeholder="Nhập tên công ty" name="name_company" autocomplete="off"
                                           data-name="name_company" value="{{old('name_company', $document->name_company)}}">
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="name_company"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <input required type="text" class="form-control col-sm-9" id="address"
                                           placeholder="Nhập địa chỉ" name="address" data-name="address"
                                           value="{{ $document->address }}">
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="address"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input id="phone" name="phone" data-name="phone" required class="form-control"
                                               type="text"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               value="{{ $document->phone }}">
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error" data-error="phone"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Địa chỉ email</label>
                                    <input type="email" class="form-control col-sm-9" id="email"
                                           placeholder="Nhập email" name="email" data-error="email"
                                           value="{{ $document->email }}">
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error" data-error="email"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="import_gate" class="col-sm-3 col-form-label">Cửa khẩu nhập</label>
                                    <input required type="text" class="form-control col-sm-9" id="import_gate"
                                           placeholder="Nhập cửa khẩu" name="import_gate" data-error="import_gate"
                                           value="{{ $document->import_gate }}">
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error"
                                       data-error="import_gate"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="import_date" class="col-sm-3 col-form-label">Thời gian nhập</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="import_date" type="text" class="form-control"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                               data-mask="" inputmode="numeric" name="import_date"
                                               placeholder="dd/mm/yyyy" data-error="import_date"
                                               value="{{old('import_date', $document->import_date)}}">
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error"
                                       data-error="import_date"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="attach_file" class="col-sm-3 col-form-label">File đính kèm (nếu
                                        có)</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="attach_file"
                                                   name="attach_file" data-error="attach_file" value="{{ Illuminate\Support\Facades\Storage::disk('public')->url('attach_files/'. $document->url) }}">
                                            <label class="custom-file-label"
                                                   for="attach_file">{{ $document->url ?? "Choose file" }} </label>
                                        </div>
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error"
                                       data-error="attach_file"></p>
                                </div>

                                <!--Tài liệu đính kèm-->
                                <div class="form-group row">
                                    <label for="references" class="col-sm-3 col-form-label">Giấy đăng ký đã xác nhận</label>
                                    <div class="col-sm-9 no-padding wrapper-reference">
                                        @foreach($references as $key => $value)
                                            <div class="form-check reference-item @if($document->references->where('name', $value)->isNotEmpty()) checked @endif">
                                                <input class="form-check-input chb-reference" type="checkbox"
                                                       id="reference-{{$key}}"
                                                       @if($document->references->where('name', $value)->isNotEmpty())
                                                        checked @endif
                                                >
                                                <label class="form-check-label reference-name"
                                                       for="reference-{{$key}}">{{ $value }}</label>
                                                <div class="form-group mt-2 reference-detail @if($document->references->where('name', $value)->isNotEmpty()) d-block @endif">
                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Ngày cấp</label>
                                                        <div class="input-group col-sm-5 no-padding">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control publish-date"
                                                                   data-inputmask-alias="datetime"
                                                                   data-inputmask-inputformat="dd/mm/yyyy"
                                                                   data-mask="" inputmode="numeric"
                                                                   placeholder="dd/mm/yyyy"
                                                                   value="{{ $document->references->where('name', $value)->first()->publish_date ?? ""}}"
                                                            >
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <label class="col-sm-2 col-form-label">Mã số cấp</label>
                                                        <div class="input-group col-sm-5 no-padding">
                                                            <input required type="text" class="form-control code"
                                                                   placeholder="Nhập mã số cấp"
                                                                   value="{{ $document->references->where('name', $value)->first()->code ?? ""}}"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error"
                                       data-error="reference"></p>
                                </div>

                                <!--Thông tin thêm-->
                                <div class="form-group row">
                                    <label for="register_date" class="col-sm-3 col-form-label">Ngày đăng ký của doanh nghiệp</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="register_date" type="text" class="form-control"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                               data-mask="" inputmode="numeric" name="register_date" placeholder="dd/mm/yyyy" data-error="register_date"
                                               value="{{ $document->register_date }}"
                                        >
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="register_date"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="number_receive_tech" class="col-sm-3 col-form-label">Số phiếu tiếp nhận của phòng CNDV</label>
                                    <input required type="text" class="form-control col-sm-9" id="number_receive_tech"
                                           placeholder="Nhập số phiếu tiếp nhận của phòng CNDV" name="number_receive_tech"
                                           autocomplete="off" data-name="number_receive_tech"
                                           value="{{ $document->number_receive_tech }}"
                                    >
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="number_receive_tech"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="date_receive_tech" class="col-sm-3 col-form-label">Ngày tiếp nhận của phòng CNDV</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="date_receive_tech" type="text" class="form-control"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                               data-mask="" inputmode="numeric" name="date_receive_tech" placeholder="dd/mm/yyyy"
                                               data-error="date_receive_tech"
                                               value="{{ $document->date_receive_tech }}"
                                        >
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 error" data-error="date_receive_tech"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="area_receive" class="col-sm-3 col-form-label">Khu vực tiếp nhận</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="area_receive" id="area_receive_1" value="{{ AREA_RECEIVE_MT }}" @if($document->area_receive == AREA_RECEIVE_MT) checked @endif>
                                                <label class="form-check-label" for="area_receive_1">Miền Trung</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="area_receive" id="area_receive_2" value="{{ AREA_RECEIVE_MN }}" @if($document->area_receive == AREA_RECEIVE_MN) checked @endif>
                                                <label class="form-check-label" for="area_receive_2">Miền Nam</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gian hạn thêm -->
                                <div class="form-group row">
                                    <label for="date_extend" class="col-sm-3 col-form-label">Gia hạn ( ngày )</label>
                                    <div class="input-group col-sm-9 no-padding">
                                        <input id="date_extend" type="number" class="form-control"
                                               placeholder="Nhập số ngày" data-error="date_extend" name="date_extend">
                                    </div>
                                    <p class="col-sm-9 text-danger offset-sm-3 no-padding error"
                                       data-error="date_extend"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin hàng hoá -->
                    <div class="col-md-12 wrapper-product mt-3">
                        <div class="d-flex mb-2">
                            <h5>Thông tin hàng hoá</h5>
                            <button type="button" class="btn bg-gradient-primary btn-add-product"><i
                                        class="fas fa-plus mr-1"></i>Thêm
                            </button>
                        </div>
                        <p class="col-sm-9 text-danger no-padding error" data-error="product"></p>
                        <!-- origin product -->
                        <div class="card card-default product-item">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Tên hàng hoá</label>
                                    <textarea id="name" class="form-control col-sm-9 name-product" rows="2"
                                              placeholder="Nhập tên hàng hoá">{{ count($document->products) > 0 ? $document->products[0]->name : "" }}</textarea>
                                </div>

                                <div class="form-group row">
                                    <label for="standard" class="col-sm-3 col-form-label">Quy chuẩn</label>
                                    <input required type="text" class="form-control col-sm-9 standard" id="standard"
                                           placeholder="Nhập quy chuẩn" name="standard" autocomplete="off" data-name="standard"
                                           value="{{ count($document->products) > 0 ? $document->products[0]->standard : "" }}"
                                    >
                                </div>

                                <div class="form-group row">
                                    <label for="specification" class="col-sm-3 col-form-label">Đặc tính kỹ thuật</label>
                                    <input required type="text" class="form-control col-sm-9 specification"
                                           id="specification"
                                           placeholder="Nhập đặc tính kỹ thuật" autocomplete="off"
                                           value="{{ count($document->products) > 0 ? $document->products[0]->specification : "" }}">
                                </div>

                                <div class="form-group row">
                                    <label for="symbol" class="col-sm-3 col-form-label">Ký hiệu</label>
                                    <input required type="text" class="form-control col-sm-9 symbol" id="symbol"
                                           placeholder="Nhập ký hiệu" autocomplete="off"
                                           value="{{ count($document->products) > 0 ? $document->products[0]->symbol : ""}}">
                                </div>

                                <div class="form-group row">
                                    <label for="origin" class="col-sm-3 col-form-label">Xuất xứ, nhà sản xuất</label>
                                    <input required type="text" class="form-control col-sm-9 origin" id="origin"
                                           placeholder="Nhập xuất xứ, nhà sản xuất" autocomplete="off"
                                           value="{{ count($document->products) > 0 ? $document->products[0]->origin : "" }}">
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-3 col-form-label">Số lượng (Bộ)</label>
                                    <input required type="text"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                           class="form-control col-sm-9 amount" id="amount"
                                           placeholder="Nhập số lượng" autocomplete="off"
                                           value="{{ count($document->products) > 0 ? $document->products[0]->amount : "" }}">
                                </div>
                            </div>
                        </div>
                        @php($document->products->shift())
                        @if(count($document->products) > 0)
                            @foreach($document->products as $product)
                                <div class="card card-default product-item">
                                    <button type="button" class="btn bg-gradient-danger btn-remove-product"><i
                                                class="fas fa-minus mr-1"></i>Bỏ
                                    </button>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Tên hàng hoá</label>
                                            <textarea id="name" class="form-control col-sm-9 name-product" rows="2"
                                                      placeholder="Nhập tên hàng hoá">{{ $product->name }}</textarea>
                                        </div>

                                        <div class="form-group row">
                                            <label for="standard" class="col-sm-3 col-form-label">Quy chuẩn</label>
                                            <input required type="text" class="form-control col-sm-9 standard" id="standard"
                                                   placeholder="Nhập quy chuẩn" name="standard" autocomplete="off" data-name="standard"
                                                   value="{{ $product->standard }}"
                                            >
                                        </div>

                                        <div class="form-group row">
                                            <label for="specification" class="col-sm-3 col-form-label">Đặc tính kỹ
                                                thuật</label>
                                            <input required type="text" class="form-control col-sm-9 specification"
                                                   id="specification"
                                                   placeholder="Nhập đặc tính kỹ thuật" autocomplete="off"
                                                   value="{{ $product->specification }}">
                                        </div>

                                        <div class="form-group row">
                                            <label for="symbol" class="col-sm-3 col-form-label">Ký hiệu</label>
                                            <input required type="text" class="form-control col-sm-9 symbol" id="symbol"
                                                   placeholder="Nhập ký hiệu" autocomplete="off"
                                                   value="{{ $product->symbol }}">
                                        </div>

                                        <div class="form-group row">
                                            <label for="origin" class="col-sm-3 col-form-label">Xuất xứ, nhà sản
                                                xuất</label>
                                            <input required type="text" class="form-control col-sm-9 origin" id="origin"
                                                   placeholder="Nhập xuất xứ, nhà sản xuất" autocomplete="off"
                                                   value="{{ $product->origin }}">
                                        </div>

                                        <div class="form-group row">
                                            <label for="amount" class="col-sm-3 col-form-label">Số lượng (Bộ)</label>
                                            <input required type="text"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                   class="form-control col-sm-9 amount" id="amount"
                                                   placeholder="Nhập số lượng" autocomplete="off"
                                                   value="{{ $product->amount }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
    <script src="{{ asset('js/custom/document-manage.js') }}"></script>
@endsection
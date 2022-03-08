let documentManage = (function () {
   let getDataReference = function (element) {
       let references = [];
       $(document).find(element).each(function(){
           let itemReference = {};
           itemReference.name = $(this).find('.reference-name').text();
           itemReference.publish_date = $(this).find('.publish-date').val();
           itemReference.code = $(this).find('.code').val();
           references.push(itemReference);
       })
       return references;
   }

    let getDataProduct = function (element) {
        let products = [];
        $(document).find(element).each(function(){
            let itemProduct = {};
            itemProduct.name = $(this).find('.name-product').val().trim();
            itemProduct.specification = $(this).find('.specification').val();
            itemProduct.standard = $(this).find('.standard').val();
            itemProduct.symbol = $(this).find('.symbol').val();
            itemProduct.origin = $(this).find('.origin').val();
            itemProduct.amount = $(this).find('.amount').val();
            products.push(itemProduct);
        })
        return products;
    }

    let clearData = function (selector) {
        $(selector).find('input').removeClass('error-border');
        $(`${selector} .error`).text('');
    }

    let showMessage = function (selector, errors) {
        $(selector).find('.btn-submit').prop('disabled', false);
        $(`${selector} .error`).text('');
        $.each(errors, function (key, value) {
            $(selector).find(`[data-error='${key}']`).text(value);
            $(selector).find(`[data-name='${key}']`).addClass('error-border');
        })
    }

    return {
        getDataReference : getDataReference,
        getDataProduct : getDataProduct,
        showMessage: showMessage,
        clearData: clearData,
    }
})()

$(document).ready(function () {
    $(document).on('change', '.chb-reference', function () {
        if ($(this).is(':checked')) {
            $(this).parent('.reference-item').addClass('checked');
            $(this).parent('.reference-item').find('.reference-detail').addClass('d-block')
        } else {
            $(this).parent('.reference-item').removeClass('checked');
            $(this).parent('.reference-item').find('.reference-detail').removeClass('d-block')
        }
    })

    //add product
    $(document).on('click', '.btn-add-product', function () {
        $(document).find('.wrapper-product').append(
            `
                <div class="card card-default product-item">
                            <button type="button" class="btn bg-gradient-danger btn-remove-product"> <i class="fas fa-minus mr-1"></i>Bỏ</button>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Tên hàng hoá</label>
                                    <textarea id="name" class="form-control col-sm-9 name-product" rows="2" placeholder="Nhập tên hàng hoá"></textarea>
                                </div>

                                <div class="form-group row">
                                    <label for="standard" class="col-sm-3 col-form-label">Quy chuẩn</label>
                                    <input required type="text" class="form-control col-sm-9 standard" id="standard"
                                       placeholder="Nhập quy chuẩn" name="standard" autocomplete="off" data-name="standard">
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
                                    <label for="origin" class="col-sm-3 col-form-label">Xuất xứ, nhà sản xuất</label>
                                    <input required type="text" class="form-control col-sm-9 origin" id="origin"
                                           placeholder="Nhập xuất xứ, nhà sản xuất" autocomplete="off">
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-3 col-form-label">Số lượng (Bộ)</label>
                                    <input required type="text"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*?)\\..*/g, '$1');" class="form-control col-sm-9 amount" id="amount"
                                           placeholder="Nhập số lượng" autocomplete="off">
                                </div>
                            </div>
                        </div>
            `
        );
    })

    //remove product
    $(document).on('click', '.btn-remove-product', function (){
        $(this).parent('.product-item').remove();
    })

    //save document
    $('.document-create').submit(function(e) {
        documentManage.clearData('.document-create');
        $('.document-create .btn-submit').prop('disabled', true);
        let references = documentManage.getDataReference('.wrapper-reference .reference-item.checked')
        let products = documentManage.getDataProduct('.wrapper-product .product-item')
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('reference', JSON.stringify(references))
        formData.append('product', JSON.stringify(products))
        $.ajax({
            type:'POST',
            url: '/document/store',
            data: formData,
            contentType: false,
            dataType: 'JSON',
            processData: false,
            success: (data) => {
                $('.document-create .btn-submit').prop('disabled', false);
                if(data.status === 200) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = '/document';
                    }, 1000)
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    toastr.options.preventDuplicates = true;
                    toastr.error('Đã có lỗi xảy ra');
                }
            },
            error: function(data){
                $('.document-create .btn-submit').prop('disabled', false);
                if (data.status === 422) {
                    documentManage.showMessage('.document-create', data.responseJSON.errors)
                    $('html, body').animate({
                        scrollTop: $(`[data-error=${Object.keys(data.responseJSON.errors)[0]}]`).offset().top - 200
                    }, 1000);
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
                toastr.options.preventDuplicates = true;
                toastr.error('Đã có lỗi xảy ra');
            }
        });
    });

    //filter document
    $(document).on('change', '.slt-status', function () {
        $('.filter-document-form').submit();
    })

    //update document
    $('.document-update').submit(function(e) {
        documentManage.clearData('.document-update');
        $('.document-update .btn-submit').prop('disabled', true);
        let references = documentManage.getDataReference('.wrapper-reference .reference-item.checked')
        let products = documentManage.getDataProduct('.wrapper-product .product-item')
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('reference', JSON.stringify(references))
        formData.append('product', JSON.stringify(products))
        $.ajax({
            type:'POST',
            url: '/document/update/'+ $('.document-id').val(),
            data: formData,
            contentType: false,
            dataType: 'JSON',
            processData: false,
            success: (data) => {
                $('.document-update .btn-submit').prop('disabled', false);
                if(data.status === 200) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = '/document';
                    }, 1000)
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    toastr.options.preventDuplicates = true;
                    toastr.error('Đã có lỗi xảy ra');
                }
            },
            error: function(data){
                $('.document-update .btn-submit').prop('disabled', false);
                if (data.status === 422) {
                    documentManage.showMessage('.document-update', data.responseJSON.errors)
                    $('html, body').animate({
                        scrollTop: $(`[data-error=${Object.keys(data.responseJSON.errors)[0]}]`).offset().top - 200
                    }, 1000);
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
                toastr.options.preventDuplicates = true;
                toastr.error('Đã có lỗi xảy ra');
            }
        });
    });

    //change publish
    $(document).on('change', '.change-publish', function () {
        let idDocument = $(this).val();
        $.ajax({
            type:'GET',
            url: '/document/change-publish/' + idDocument,
            success: (data) => {
                if(data.status === 200) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = '/document';
                    }, 700)
                } else {
                    toastr.error('Đã có lỗi xảy ra');
                }
            },
            error: function(data){
                toastr.error('Đã có lỗi xảy ra');
            }
        })
    })

    //complete document
    $(document).on('click', '.btn-complete', function () {
        $(document).find('.form-complete-document').trigger('reset');
        let idDocument = $(this).data('id');
        $(document).find('#modal-complete').attr('data-id', idDocument);
    })

    $('#complete_file').on('change', function () {
        let $error = $('.error');
        let $btnSubmit = $('.form-complete-document .btn-submit');
        $error.text('');
        let file = $(this).prop('files')[0];
        if (file.size > 5 * 1024 * 1000) {
            $error.text('Dung lượng tối đa là 5MB');
            toastr.options.preventDuplicates = true;
            toastr.error('Dung lượng quá lớn');
            $btnSubmit.prop('disabled', true);
            $btnSubmit.addClass('btn-disabled');
        } else {
            $btnSubmit.prop('disabled', false);
            $btnSubmit.removeClass('btn-disabled');
        }
    });

    $(document).on('submit', '.form-complete-document', function (e) {
        e.preventDefault();
        let idDocument = $(document).find('#modal-complete').attr('data-id');
        let formData = new FormData(this);
        if ($('.form-complete-document .error').text().length === 0) {
            $.ajax({
                type:'POST',
                url: `/document/complete/${idDocument}`,
                data: formData,
                contentType: false,
                dataType: 'JSON',
                processData: false,
                success: (data) => {
                    $('.form-complete-document .btn-submit').prop('disabled', false);
                    if(data.status === 200) {
                        toastr.success(data.message);
                        setTimeout(() => {
                            window.location.href = '/document';
                        }, 500)
                    } else {
                        toastr.options.preventDuplicates = true;
                        toastr.error('Đã có lỗi xảy ra');
                    }
                },
                error: function(data){
                    $('.form-complete-document  .btn-submit').prop('disabled', false);
                    if (data.status === 422) {
                        toastr.options.preventDuplicates = true;
                        toastr.error('Đã có lỗi xảy ra');
                    }
                }
            });
        }

    })
})
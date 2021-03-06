let exemptionManage = (function() {
    let getDataProduct = function(element) {
        let products = [];
        $(document).find(element).each(function() {
            let itemProduct = {};
            itemProduct.name = $(this).find('.name-product').val().trim();
            itemProduct.specification = $(this).find('.specification').val();
            itemProduct.symbol = $(this).find('.symbol').val();
            itemProduct.amount = $(this).find('.amount').val();
            products.push(itemProduct);
        })
        return products;
    }

    let clearData = function(selector) {
        $(selector).find('input').removeClass('error-border');
        $(`${selector} .error`).text('');
    }

    let showMessage = function(selector, errors) {
        $(selector).find('.btn-submit').prop('disabled', false);
        $(`${selector} .error`).text('');
        $.each(errors, function(key, value) {
            $(selector).find(`[data-error='${key}']`).text(value);
            $(selector).find(`[data-name='${key}']`).addClass('error-border');
        })
    }

    return {
        getDataProduct: getDataProduct,
        showMessage: showMessage,
        clearData: clearData,
    }
})()

$(function() {
    //add product
    $(document).on('click', '.btn-add-product', function() {
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
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*?)\\..*/g, '$1');" class="form-control col-sm-9 amount" id="amount"
                                placeholder="Nhập số lượng" autocomplete="off">
                    </div>
                </div>
            </div>
            `
        );
    })

    //remove product
    $(document).on('click', '.btn-remove-product', function() {
        $(this).parent('.product-item').remove();
    })

    //save exemption
    $('.exemption-create').submit(function(e) {
        exemptionManage.clearData('.exemption-create');
        $('.exemption-create .btn-submit').prop('disabled', true);
        let products = exemptionManage.getDataProduct('.wrapper-product .product-item')
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('product', JSON.stringify(products))
        $.ajax({
            type: 'POST',
            url: '/exemption/store',
            data: formData,
            contentType: false,
            dataType: 'JSON',
            processData: false,
            success: (data) => {
                $('.exemption-create .btn-submit').prop('disabled', false);
                if (data.status === 200) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = '/exemption';
                    }, 1000)
                } else {
                    toastr.options.fadeOut = 1000;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    toastr.options.preventDuplicates = true;
                    toastr.error(data.discount_product ? data.message : 'Đã có lỗi xảy ra');
                }
            },
            error: function(data) {
                $('.exemption-create .btn-submit').prop('disabled', false);
                if (data.status === 422) {
                    exemptionManage.showMessage('.exemption-create', data.responseJSON.errors)
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
})
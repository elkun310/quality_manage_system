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
            itemProduct.name = $(this).find('.name-product').val();
            itemProduct.specification = $(this).find('.specification').val();
            itemProduct.symbol = $(this).find('.symbol').val();
            itemProduct.origin = $(this).find('.origin').val();
            itemProduct.amount = $(this).find('.amount').val();
            products.push(itemProduct);
        })
        return products;
    }

    return {
        getDataReference : getDataReference,
        getDataProduct : getDataProduct,
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

    $('.document-create').submit(function(e) {
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
                    toastr.error('Đã có lỗi xảy ra');
                }
            },
            error: function(data){
                $('.document-create .btn-submit').prop('disabled', false);
                toastr.error('Đã có lỗi xảy ra');
            }
        });
    });
})
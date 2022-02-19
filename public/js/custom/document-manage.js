$(document).ready(function () {
    $(document).on('change', '.chb-reference', function () {
        if ($(this).is(':checked')) {
            $(this).parent('.reference-item').find('.reference-detail').addClass('d-block')
        } else {
            $(this).parent('.reference-item').find('.reference-detail').removeClass('d-block')
        }
    })

    $(document).on('click', '.btn-add-product', function () {
        $(document).find('.wrapper-product').append(
            `
                <div class="card card-default product-item">
                            <button type="button" class="btn bg-gradient-danger btn-remove-product"> <i class="fas fa-minus mr-1"></i>Bỏ</button>
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
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*?)\\..*/g, '$1');" class="form-control col-sm-9" id="amount"
                                           placeholder="Nhập số lượng" name="amount" autocomplete="off">
                                </div>
                            </div>
                        </div>
            `
        );
    })

    $(document).on('click', '.btn-remove-product', function (){
        $(this).parent('.product-item').remove();
    })
})
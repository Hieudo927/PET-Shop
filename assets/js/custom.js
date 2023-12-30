
    $(document).ready(function () {
    $('.btn-tang').click(function (){
        var qty = $(this).closest('.product_data').find('.qty').val();

        var value = parseInt(qty,10);
        value = isNaN(value) ?0:value;
        if(value<10){
            value ++;
            $(this).closest('.product_data').find('.qty').val(value);
        }
    })

    $('.btn-giam').click(function (){
    var qty = $(this).closest('.product_data').find('.qty').val();

    var value = parseInt(qty,10);
    value = isNaN(value) ?0:value;
    if(value > 1){
    value --;
    $(this).closest('.product_data').find('.qty').val(value);
}
})

    $('.addToCartBtn').click(function () {
    var qty = $(this).closest('.product_data').find('.qty').val();
    var id = $(this).val();

    $.ajax({
    method: "POST",
    url: "function/handlecart.php",
    data: {id:id,qty:qty,scope:"add"},
    success: function (response) {
    console.log(response);
    if (response == 201){
    alertify.success("Đã thêm vào giỏ hàng");
}
    else if (response == "ok"){
    alertify.success("Sản phẩm đã tồn tại trong giỏ hàng");
}
    else if (response == 401){
    alertify.success("Đăng nhập để tiếp tục");
}
    else if (response == 500){
    alertify.success("Có lỗi xảy ra");
}
}
})
})

        $(document).on('click','.updateQty', function (){
            var qty = $(this).closest('.product_data').find('.qty').val();
            var id = $(this).closest('.product_data').find('.id').val();

            $.ajax({
                method: "POST",
                url: "function/handlecart.php",
                data: {id:id,qty:qty,scope:"update"},
                success: function (response){
                    //alert(response);
                }
            })
        })

        $(document).on('click','.deleteItem', function (){
            var cart_id = $(this).val();

            $.ajax({
                method: "POST",
                url: "function/handlecart.php",
                data: {cart_id:cart_id,scope:"delete"},
                success: function (response){
                    if (response == 200){
                        alertify.success("Đã xóa sản phẩm khỏi giỏ hàng");
                        $('#myCart').load(location.href + " #myCart");
                    }
                    else {
                        alertify.success(response);
                    }
                }
            })
        })
})



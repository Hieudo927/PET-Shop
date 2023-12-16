$(document).ready(function (){
    $('.btn_delete_category').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        swal({
            title: "Bạn có chắc chắn muốn xóa?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "code.php",
                        data:{
                            id:id,
                            btn_delete_category: true
                        },
                        success: function (response) {
                            if(response == 200){
                                swal("Xóa thành công", {
                                    icon: "success",
                                });
                                location.reload();
                                //$('#container').load(location.href + " #container");

                            }else if(response == 500){
                                swal("Có lỗi xảy ra", {
                                    icon: "error",
                                });
                            }
                        }
                    });
                }
            });

    });

    $('.btn_delete_product').click(function () {
            var id = $(this).val();

            swal({
                title: "Bạn có chắc chắn muốn xóa?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "code.php",
                            data:{
                                id:id,
                                btn_delete_product: true
                            },
                            success: function (response) {
                                console.log(response);
                                if(response == 200){
                                    swal("Xóa thành công", {
                                        icon: "success",
                                    });
                                    location.reload();
                                    //$('#myTable').load(location.href + " #myTable");

                                }else if(response == 500){
                                    swal("Có lỗi xảy ra", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                    }
                });
        });


});
$('.cancelled__order__item').click(function(e) {
        e.preventDefault();
        let href = $(this).parent().attr('href');
        console.log(href);
        Swal.fire({
            title: 'Bạn có muốn hủy đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            window.location.href = href;
        })
    }

);
$('.buy__again').click(function() {
        Swal.fire({
            title: 'Bạn có muốn mua lại đơn hàng này?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Thành công', 'Bạn đã mua lại đơn hàng thành công', 'success')
                Window.location.href = 'D:/Code%20Private/Html/BaiTap1/html/Client/order.html'
            }
        })
    }

);
$('.btnSubLogin').click(function() {
    $('#formLogin').submit();
});
//review product
var urlReview = '';
$('.review__product').click(function(e) {
    e.preventDefault();
    let url = $(this).parent().attr('href');
    urlReview = $(this).parent().attr('urlReview');
    console.log(url)
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            // keySearch : keySearch,
        },
        dataType: false,
        success: function(result) {
            console.log("result", result)
            $('#reviewModal').modal('show');
            $('#responReview').html(result);

            var starRatingSvg = document.createElement('script');
            starRatingSvg.type = 'text/javascript';
            starRatingSvg.async = true;
            starRatingSvg.src = 'Site/public/js/star-rating-svg.min.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(starRatingSvg);

            var newscript = document.createElement('script');
            newscript.type = 'text/javascript';
            newscript.async = true;
            newscript.src = 'Site/public/js/star-rating-code.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(newscript);




        },
        error: function(error) {
            $('.show__data__search_header').removeClass('d_block');
        }
    });
});
$('#btnrating').click(function(e) {
    e.preventDefault();
    let star = $('#star_rating').val();
    let content = $('#content_rating').val();
    if ($('#content_rating').val().length == 0) {

        if ($('#content_rating').val().length == 0) {
            $('#content_rating').css('border', '1px solid red ');
            $('.info-error').text('Bạn chưa nhập nội dung đánh giá');
            $('.info-error').show();
        }

    } else {

        let product_id = $('#productReviewId').val();
        console.log(product_id);
        $.ajax({
            type: 'GET',
            url: "controller/addReview.php",
            data: {
                action: 'review',
                product_id: product_id,
                star: star,
                content: content,
            },
            dataType: false,
            success: function(result) {
                console.log("result", result)
                if (result == 200) {
                    Swal.fire({
                        title: 'Thàng công!',
                        text: "Bạn vừa đánh giá sản phẩm thành công",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#007bff',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        window.location.reload();
                    })
                }
            },
            error: function(error) {
                if (result == 500) {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: "Bạn vừa đánh giá sản phẩm thất bại",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#007bff',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        window.location.reload();
                    })
                }
            }
        });
        // Swal.fire('Thành công', 'Bạn đã gửi đánh giá thành công', 'success').then((result) => {
        //     if (result.isConfirmed) {
        //         window.location.reload();
        //     }
        // })
    }
});
$('.avgStar').starRating({
    totalStars: 5,
    starShape: 'rounded',
    starSize: 20,
    readOnly: true,
    emptyColor: 'lightgray',
    hoverColor: 'orange',
    activeColor: 'orange',
    useGradient: false
});
$(".user-detail-rating").starRating({
    starSize: 20,
    initialRating: 4,
    readOnly: true,
    starShape: 'rounded'
});
$(".review-rating-8").starRating({
    starSize: 30,
    totalStars: 5,
    useFullStars: true,
    disableAfterRate: false,
    starShape: 'rounded',
    activeColor: 'orange',
    ratedColor: 'orange',
    hoverColor: 'orange',

    onHover: function(currentIndex, currentRating, $el) {
        var showText = '';
        if (currentIndex == 1) {
            showText = 'Tệ';
        }
        if (currentIndex == 2) {
            showText = 'Trung bình';
        }
        if (currentIndex == 3) {
            showText = 'Khá';
        }
        if (currentIndex == 4) {
            showText = 'Tốt';
        }
        if (currentIndex == 5) {
            showText = 'Xuất sắc';
        }
        $('.live-rating').removeClass('hide');
        $('.live-rating').text(showText);

    },
    onLeave: function(currentIndex, currentRating, $el) {
        $('.live-rating').addClass('hide');
    },
    callback: function(currentIndex, $el) {
        var showText = '';
        if (currentIndex == 1) {
            showText = 'Tệ';
        }
        if (currentIndex == 2) {
            showText = 'Trung bình';
        }
        if (currentIndex == 3) {
            showText = 'Khá';
        }
        if (currentIndex == 4) {
            showText = 'Tốt';
        }
        if (currentIndex == 5) {
            showText = 'Xuất sắc';
        }
        activeRate = showText;

        $('.live-rating').removeClass('hide');
        $('.live-rating').text(showText);
        $('.form-rating').addClass('show');
        $('.live-rating').addClass('show');
        $('.form-rating').removeClass('hide');
        console.log(currentIndex);
        $('#star_rating').val(currentIndex);
    }
});
$(document).ready(function() {
    $('#content_rating').val('');
    $('#user_name').val('');
    $('#phone_assess').val('');
    $('#email').val('');
});
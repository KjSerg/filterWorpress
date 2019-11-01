$(document).ready(function () {
    changeNumbers();

    $('.form-consent a').fancybox();

    if ($('#instafeed').length > 0) {

        var $insta = $('#instafeed');
        var id = $insta.attr('data-id');
        var access = $insta.attr('data-p');
        var limit = $insta.attr('data-limit');

        var feed = new Instafeed({
            get: 'user',
            userId: id,
            accessToken: access,
            resolution: 'standard_resolution',
            // template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /></a>',
            limit: limit,
            links: true,
            after: function() {
                $("#instafeed a").attr("target", "_blank");

                $('.js-insta-slider').slick({
                    infinite: true,
                    slidesToShow: 3,
                    dots: true,
                    // slidesToScroll: 4,
                    appendDots: $('.js-insta-slider').closest('.slider-group').find(".slider-dots"),
                    prevArrow: $('.js-insta-slider').closest('.slider-group').find(".prev-slide"),
                    nextArrow: $('.js-insta-slider').closest('.slider-group').find(".next-slide"),
                    responsive: [{
                        breakpoint: 860,
                        settings: {
                            slidesToShow: 2,
                        }
                    }, {
                        breakpoint: 420,
                        settings: {
                            slidesToShow: 1,
                        }
                    }

                    ]
                });
            }
        });
        feed.run();
    }
    
    
    $('.sort-group__item a.sort-js').on('click', function (e) {
       
        e.preventDefault();
        
        var ths = $(this);
        var val = ths.attr('data-result');

        var $input = $('.sort-input-js');

        if(ths.hasClass('sort-by-price-js')) {
            $input.attr('name', 'sort-price');
            $('.sort-group__item a.sort-by-square-js').removeClass('low').removeClass('high');
        }else {
            $input.attr('name', 'sort-square');
            $('.sort-group__item a.sort-by-price-js').removeClass('low').removeClass('high');
        }

        $input.val(val);

        if(val == "ASC") {
            ths.attr('data-result', 'DESC');
            ths.removeClass('low');
            ths.addClass('high');
        }else {
            ths.attr('data-result', 'ASC');
            ths.removeClass('high');
            ths.addClass('low');
        }


        getFormData();
    });

    $('#filter-js').on('submit', function (e) {
       e.preventDefault();

       var ths = $(this);

        var form_data = ths.serialize();

        try {
            $.ajax({
                url: ths.attr('action'),
                type: ths.attr('method'),
                data: form_data,
                success: function(r) {
                    renderResult(r);
                },
                error:  function(xhr, str){
                    console.log('Возникла ошибка: ' + xhr.responseCode);

                    window.location.href = home_url + '/projects/';
                }
            });
        }catch (e) {
            console.log(e);
        }


    });

    $(document).on('change', '#filter-js', getFormData);


    rangeInit();

    window.addEventListener("popstate",function(e){

        window.location.href = document.location;

    });

    $('.select-filter-js').on('change', function () {

        var val = $(this).val();

        if(val) window.location.href = val;

    });

    $('.work-item').on('click', function (e) {
        e.preventDefault();

        var $ths = $(this);

        var href = $ths.attr('href');

        var $modal = $(href);

        var str = $ths.attr('data-gallery');

        var arr = str.split(', ');

        for (var i = 0; i < arr.length; i++) {
            $modal.find('.modal-slider').append('<div><div class="modal-slider__item"><img src="'+arr[i]+'"></div></div>');
        }

        $.fancybox.open({
            src  : href,
            opts : {
                touch: false,
                beforeShow : function( instance, current ) {

                    var prev = $modal.find('.prev-slide');
                    var next = $modal.find('.next-slide');

                    $modal.find('.modal-slider').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        fade: true,
                        speed: 500,
                        autoplaySpeed: 5000,
                        adaptiveHeight: true,
                        prevArrow: prev,
                        nextArrow: next,
                    });
                    setTimeout(function () {
                        $modal.find('.modal-slider').slick('setPosition');
                    }, 10);
                },
                afterClose: function () {
                    if($modal.find('.modal-slider').hasClass('slick-initialized')) {
                        $modal.find('.modal-slider').slick('unslick');
                    }
                    $modal.find('.modal-slider').html(' ');
                }
            }
        });

    })

    console.clear();

});

function rangeInit() {

    var range = $(".range");

    if(range.length > 0) {
        var values = range.attr('data-values').split(', ');

        var min = Number(range.attr('data-min'));
        var max = Number(range.attr('data-max'));

        range.ionRangeSlider({
            // min: Number(values[0]),
            // max:  Number(values[values.length - 1]),
            // from: min,
            // to: max,
            type: "double",
            postfix: " руб.",
            onStart: setValuePrice,
            // onFinish: setValuePrice
            onFinish: setValuePriceAndSendReq
        });
    }


}

function setValuePrice(data) {
    var from = data.from_value;
    var to = data.to_value;

    $('.price-min-js').val(from);
    $('.price-max-js').val(to);
}

function setValuePriceAndSendReq(data) {

    setValuePrice(data);

    sendRequest();
}

function separator(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

$.fn.divideNumber = function() {
    var element = $(this);
    var number = Number(element.text());
    var newValue = separator(number);
    element.text(newValue);
};

function changeNumbers() {
    var $selector =  $('.separator');
    $selector.each(function () {
       var $ths = $(this);
        $ths.divideNumber();
    });
}

function sendRequest() {

    var $form = $('.filter-js');

    $form.trigger('submit');
}

function renderResult(request) {

    var $wrapper = $(document).find('.project-group');
    var $pagenavi = $(document).find('.pagination');
    var $title = $(document).find('.work-filter__title');

    if(request) {

        var parser = new DOMParser();

        var $html = $(parser.parseFromString(request, "text/html"));

        var $req_wrapper = $html.find('.project-group').html();
        var $req_pagenavi = $html.find('.pagination').html();
        var $req_title = $html.find('.work-filter__title').html();

        var url = $html.find('.project-group').attr('data-url');

        window.history.pushState({}, '', url);

        $wrapper.html($req_wrapper);
        $pagenavi.html($req_pagenavi);
        $title.html($req_title);

        changeNumbers();
    }
}

function getFormData(e) {

    var $form = $('#filter-js');
    var $inputs = $form.find('input');

    var house_types = [];
    var storeys_arr = [];

    $inputs.each(function () {

        var $this = $(this);

        var $this_slug = $this.attr('data-slug');

        var is_checked = $this.prop('checked');

        var is_house_type = $this.attr('data-taxonomy') == 'house_type';

        var is_storeys = $this.attr('data-taxonomy') == 'storeys';

        if( is_checked && is_house_type ) {

            house_types.push($this_slug);
        }

        if( is_checked && is_storeys ) {
            storeys_arr.push($this_slug);
        }
    });

    $('.house_type-js').val(house_types.join(','));

    $('.storeys-js').val(storeys_arr.join(','));

    sendRequest();
}
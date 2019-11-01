(function($) {
    $.fn.toSVG = function(options) {
        var params = $.extend({
            svgClass: "replaced-svg",
            onComplete: function() {},
        }, options)
        this.each(function() {
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');
            if (!(/\.(svg)$/i.test(imgURL))) {
                console.warn("image src='" + imgURL + "' is not a SVG, item remained tag <img/> ");
                return;
            }
            $.get(imgURL, function(data) {
                var $svg = jQuery(data).find('svg');
                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + params.svgClass);
                }
                $svg = $svg.removeAttr('xmlns:a');
                if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }
                $img.replaceWith($svg);
                typeof params.onComplete == "function" ? params.onComplete.call(this, $svg) : '';
            })
        });
    }
})(jQuery);

$(document).ready(function() {
    var clickHandler = ('ontouchstart' in document.documentElement ? "touchstart" : "click");
    $("a").bind(clickHandler, function(e) {});
    $('img.svg').toSVG({
        svgClass: "SVG",
        onComplete: function(data) {}
    });



    $('input[type="tel"]').mask("+7 (999) 999-99-99");

    $('.consent_input').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).closest('form').find('.btn_st').removeClass('not_active');
        } else {
            $(this).closest('form').find('.btn_st').addClass('not_active');
        }
    })


    $('.js-reviews-slider').each(function() {
        var _this = $(this);
        var prev = _this.closest('.slider-group').find('.prev-slide');
        var next = _this.closest('.slider-group').find('.next-slide');
        var dots = _this.closest('.slider-group').find(".slider-dots");
        _this.slick({
            slidesToShow: 3,
            dots: true,
            arrows: true,
            appendDots: dots,
            prevArrow: prev,
            nextArrow: next,
            responsive: [{
                breakpoint: 860,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 660,
                settings: {
                    slidesToShow: 1,
                    adaptiveHeight: true
                }
            }]
        })
    });

    $('.project-slider').each(function() {
        var _this = $(this);
        var prev = _this.closest('.slider-group').find('.prev-slide');
        var next = _this.closest('.slider-group').find('.next-slide');
        var dots = _this.closest('.slider-group').find(".slider-dots");
        _this.slick({
            slidesToShow: 3,
            dots: true,
            arrows: true,
            appendDots: dots,
            prevArrow: prev,
            nextArrow: next,
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
        })
    })

    // $('').fancybox({
    //     selector: '.ri_fancy',
    //     loop: false,
    //     hash: false,
    //     backFocus: false,

    //     buttons: ['close']

    // });


    $('.open_sidebar').click(function() {
        $(this).toggleClass('open');
        $('.sidebar').toggleClass('open');
    })


    // $('').fancybox({
    //     selector: '.slick-slide:not(.slick-cloned) .reviews-item__media',
    //     loop: false,
    //     hash: false,
    //     backFocus: false,
    //     toolbar: false,
    //     touch: false,
    //     prevEffect: 'none',
    //     nextEffect: 'none',
    //     buttons: []
    // });
    $('.reviews-item__media').fancybox({
        touch: false,
        hash: false,
    })
    $('.ri_fancy').fancybox({
        loop: false,
        hash: false,
        backFocus: false,

        buttons: ['close']
    })
    $('.project-slider__item').fancybox({
        touch: false,
        hash: false,
        loop: true,
    })



    if ($(window).width() < 768) {
        $('.work-group__in-sm').unwrap();
        $('.work-group__in-sm .work-item').unwrap();
    }





    $('.select_st').selectric({
        disableOnMobile: false,
        nativeOnMobile: false
    });


    $("form").not('#filter-js').each(function() {
        var it = $(this);
        var this_form = this.id;
        // each form shoul have own id
        it.validate({
            rules: {
                phone: {
                    required: true
                }
            },
            messages: {},
            errorPlacement: function(error, element) {},
            submitHandler: function(form) {
                submitForm = true;
                var thisForm = document.getElementById(this_form); //$(it); //form
                var formData = new FormData(thisForm);

                $.ajax({
                    type: "POST",
                    url: it.attr('action'),
                    processData: false,
                    contentType: false,
                    data: formData,
                }).done(function() {
                    $.fancybox.close();
                    $.fancybox.open([{
                        src: '#thanks',
                    }]);
                    setTimeout(function() {
                        //submitForm = false
                        $.fancybox.close();
                    }, 3000);
                    it.trigger("reset");
                    it.find('.btn_st').addClass('not_active');
                    $('.upfile_hide').val('');
                    $('.upload_file').empty();
                    // $('.up_file').text('Прикрепить файл');
                    // $(this).closest('form').find('input[name="admin_email"]').val(val_main)
                });
                return false;
            },
            success: function() {},
            highlight: function(element, errorClass) {
                $(element).addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('error');
            }
        });
    });







    // fix 25.12
    // upload file
    $('.upfile_hide').change(function(e) {
        var val_ = $(this).val()
        if (val_ == '') {
            $('.upload_file').empty();
        }
        var fileName = e.target.files[0].name;
        $(this).closest('form').find('.upload_file').html('<span class="reset_file" ></span><img src="img/file.svg" alt=""/>' + fileName)
        // alert('The file "' + fileName +  '" has been selected.');
    });

    // fix 08.01
    $('form').on('click', '.reset_file', function(e) {
        $(this).closest('form').find('.upfile_hide').val('');
        $('.upload_file').empty();
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        speed: 500,
        autoplay: true,
        autoplaySpeed: 5000,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        // centerMode: true,
        focusOnSelect: true,
        responsive: [{
                breakpoint: 520,
                settings: {
                    slidesToShow: 3,
                }
            }, {
                breakpoint: 380,
                settings: {
                    slidesToShow: 2,
                }
            }

        ]
    });


    $('.js-tab-link').on('click', function(event) {
        event.preventDefault();
        var data_hreff = $(this).data('target');
        $(this).closest('.js-tab').find('.js-tab-link').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.js-tab').find('.js-tab-item').hide().removeClass('active');
        $(this).closest('.js-tab').find('.js-tab-item[data-target="' + data_hreff + '"]').fadeIn().addClass('active');

    });





    $(".open_modal").fancybox({
        closeBtn: false,
        smallBtn: false,
        buttons: [],
        touch: false,
        hideScrollbar: false,
        swipe: false,
        afterShow: function(instance, current) {
            $('.slick-slider').slick('setPosition');
        }
    });
    $(document).on('click touchstart', '.close_modal', function(event) {
        $.fancybox.close();
    });


    // var custom_values = [22500, 54750, 651000, 751250, 861500, 971750, 2222000];

    // be careful! FROM and TO should be index of values array
    // var my_from = custom_values.indexOf(22500);
    // var my_to = custom_values.indexOf(2222000);



    // scrollNav();
    // $(window).scroll(function() {
    //     scrollNav();
    // });
});

// function scrollNav() {

//     if ($(this).scrollTop() > 1) {
//         $('.top-nav-sm').addClass('fix_nav');

//     } else {
//         $('.top-nav-sm').removeClass('fix_nav');
//     }
// }

$(window).on("load", function() {
    $('.section-head').addClass('done');
    $(".scroll").mCustomScrollbar({
        scrollbarPosition: 'outside'
    });
});
jQuery(function($) {
    $(document).ready(function(){

        new WOW().init();
        //-------------------------------------------------
        // Sticky navbar
        //-------------------------------------------------
        // Custom function which toggles between sticky class (is-sticky)
        var stickyToggle = function (sticky, stickyWrapper, scrollElement,stickyHeight) {
            var stickyTop = stickyWrapper.offset().top;

            if (scrollElement.scrollTop() >= stickyTop + stickyHeight) {
                stickyWrapper.height(stickyHeight);
                sticky.addClass("is-sticky");
            }


            if (scrollElement.scrollTop() <= stickyTop) {
                sticky.removeClass("is-sticky");
                stickyWrapper.height('auto');
            }
        };
        $('[data-toggle="sticky-onscroll"]').each(function () {
            var sticky = $(this);
            var stickyWrapper = $('<div>').addClass('sticky-wrapper'); 
            sticky.before(stickyWrapper);
            sticky.addClass('sticky');
            var stickyHeight = sticky.outerHeight();

            var t
            clearTimeout(t);
            $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function () {
                t = setTimeout(function() { t = undefined;
                stickyToggle(sticky, stickyWrapper, $(this),stickyHeight);
                }, 100) //3
            });
            // On page load
            stickyToggle(sticky, stickyWrapper, $(window),stickyHeight);
        });

        //-------------------------------------------------
        // Menu
        //-------------------------------------------------
        var header_sticky = $('.header--sticky')
        if(header_sticky.offset().top > 1){
            header_sticky.addClass("active")
        }
        $(window).scroll(function(){
            $(this).scrollTop()>1?header_sticky.addClass("active"):header_sticky.removeClass("active")
        })

        $('.menu-mb__btn').click(function(e){
            e.preventDefault()
            if($('.menu-mb__btn').hasClass('active')){

                $('body').removeClass('modal-open')
                $(this).removeClass('active')
                $('.nav__mobile').removeClass('active')

            } else {
                $('body').addClass('modal-open')
                $(this).addClass('active')
                $('.nav__mobile').addClass('active')
            }
        });

        var e=$(".nav__mobile .nav__mobile--ul");
        e.find(".menu-item-has-children>a").after('<button class="nav__mobile__btn"><i></i></button>'),

        e.find(".nav__mobile__btn").on("click",function(e){
            e.stopPropagation(),
            $(this).parent().find('.sub-menu').first().is(":visible")?$(this).parent().removeClass("sub-active"):
            $(this).parent().addClass("sub-active"),
            $(this).parent().find('.sub-menu').first().slideToggle()
        })
    });
    //-------------------------------------------------
});
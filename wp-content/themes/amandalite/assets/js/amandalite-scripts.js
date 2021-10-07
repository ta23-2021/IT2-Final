(function($){
	"use strict";	
    $(document).ready(function() {

        if ($('body').length ) { $('body').fitVids(); }
        $('select').chosen();

        // Function AmandaLite
        init_carousel();
        amandalite_main_menu();
        Amandalite_Modal();

        //Submenu 
        var _subMenu = $('.main-menu-horizontal .amandalite-main-menu > li > .sub-menu');
        _subMenu.each(function(){
            var _widthSub = $(this).outerWidth(),
                _widthContainer = $('.main-wrapper-boxed').outerWidth(),
                offsetContent = ($(window).width() - _widthContainer)/2;
            
            var offsetLeft = $(this).offset().left,
                offsetRight = $(window).width() - offsetLeft;

            var _rightPos =  offsetRight - offsetContent;

            if(_rightPos < _widthSub){
                var _left = (_widthSub - _rightPos) + 50;
                console.log(_left);
                $(this).css({
                    "left": '-'+_left+'px'
                });
                $(this).find('.sub-menu').css({
                    "left": "auto",
                    "right": "100%"
                });
            }

        })
    });

    function Amandalite_Modal(){
        $('.cover-modal').each(function(){
            var id_modal = $(this).attr('id'),
                _position, _widthModal;
            if ( $(this).hasClass('amandalite-menu-touch') ){
                _position = "left top",
                _widthModal = 300
            }else{
                _position = "center"
                _widthModal = 600
            }
            $(this).dialog({
                classes: {
                    "ui-dialog": id_modal
                },
                width: _widthModal,
                position: { 
                    my: _position, 
                    at: _position, 
                    of: window 
                },
                autoOpen: false,
                modal: true,
                show: 'fade',
                hide: 'fade',
                close: function() {
                    $( this ).dialog( "close" );
                }
            });
        })
        
              
        $('.toggle-modal').on('click', function() { 
            var _modalClass = $(this).attr('data-toggle-target');
            $(_modalClass).dialog( "open" );
        });

    }

    /* ---------------------------------------------
     Owl carousel
    --------------------------------------------- */
    function init_carousel()
    {
        $('.owl-carousel').each(function(){
            var config = $(this).data();
            config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
            var animateOut = $(this).data('animateout');
            var animateIn = $(this).data('animatein');
            if(typeof animateOut != 'undefined' ){
              config.animateOut = animateOut;
            }
            if(typeof animateIn != 'undefined' ){
              config.animateIn = animateIn;
            }
            
            config.smartSpeed = 1000;

            var owl = $(this);
            owl.owlCarousel(config);

        });
    }

    // Menu
    function amandalite_main_menu()
    {
        //Add caret 
        $('.amandalite-main-menu li.menu-item-has-children > a,.amandalite-main-menu li.page_item_has_children > a').append( '<div class="icon-dropdown"><i class="fas fa-angle-down"></i></div>' );
        //Hover
        $('.amandalite-main-menu li.menu-item-has-children,.amandalite-main-menu li.page_item_has_children').hover(function(){
             $(this).addClass('is-hover');
        },function(){
             $(this).removeClass('is-hover');
        });

        //Click
        $('.amandalite-main-menu li.menu-item-has-children > a > .icon-dropdown,.amandalite-main-menu li.page_item_has_children > a > .icon-dropdown').on('click',function(e){
            if( $(this).closest('li').hasClass('show-submenu') ){
                $(this).closest('li').removeClass('show-submenu');
                $(this).parent().removeClass('active');
            } else {
                $(this).closest('ul').children('li').removeClass('show-submenu');
                $(this).closest('ul').children('li').children('.active').removeClass('active');
                $(this).closest('li').toggleClass('show-submenu');
                $(this).parent().addClass('active');
            }
            return false;
        });

    }
    
})(jQuery);

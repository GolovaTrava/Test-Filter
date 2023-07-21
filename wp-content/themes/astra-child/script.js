jQuery(document).ready(function(){
    jQuery('.header__menu-button').click(function(){
        jQuery(this).toggleClass('open');
        jQuery('.header__mobile-menu').toggleClass('menu-open');
    });

    jQuery(".menu-item").click(function() {
        jQuery(".header__mobile-menu").removeClass("menu-open");
        jQuery(".header__menu-button").removeClass("open");
    });
});


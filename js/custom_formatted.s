jQuery(document).ready(function() {
    
    // cv-widget
    //jQuery('li.csb a[rel]').overlay();
    
    // smooth scrolling
    /*
     jQuery('a[href*=#]:not([href=#])').click(function() {
     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
     var target = jQuery(this.hash);
     target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
     if (target.length) {
     jQuery('html,body').animate({
     scrollTop: target.offset().top
     }, 1000);
     return false;
     }
     }
     });
     */
    
    var document = jQuery(document),
    element = jQuery('#some-element'),
    className = 'hasScrolled';
    
    jQuery(document).scroll(function() {
        if (jQuery(document).scrollTop() >= 1000) {
            // user scrolled 50 pixels or more;
            // do stuff
            jQuery('.link-top').fadeIn(1000);
            $element.addClass(className);
        } else {
            jQuery('.link-top').fadeOut(1000);
            $element.removeClass(className);
        }
    });
    
    jQuery('.toggle-button').click(function(){
        jQuery('.cnet-join-text').toggle();
    });
    
    jQuery('li.csb a[rel]').click(function(){
        jQuery('.apple_overlay').fadeIn(1000);
    });
    
    jQuery('a.widget-close-link').click(function(){
        jQuery('.apple_overlay').fadeOut(1000);
    });
    
});

jQuery(document).ready(function() {

	// smooth scrolling
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
	
	var $document = jQuery(document),
    $element = jQuery('#some-element'),
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
	
	jQuery('.cnet-join-toggle').click(function(){
		jQuery('.cnet-join-text').toggle();
	});
	
});
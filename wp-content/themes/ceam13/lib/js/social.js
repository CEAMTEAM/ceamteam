jQuery(function($){
	//alert('Seriously its ready!');
	$('.social-buttons').one('mouseenter', function() {
        Socialite.load($(this)[0]);
    });

/*
	$('.twitter').share({
	    share: { twitter: true },
	    enableHover: false,
	    enableTracking: true,
	    buttons: { twitter: { via: 'solvmist' } },
	    click: function(api, options) {
	        api.simulateClick();
	        api.openPopup('twitter');
	    }
	});
	 
	$('.facebook').share({
	    share: { facebook: true },
	    enableHover: false,
	    enableTracking: true,
	    click: function(api, options) { api.simulateClick(); api.openPopup('facebook'); }
	});
	 
	$('.googleplus').share({
	    share: { googlePlus: true },
	    enableHover: false,
	    enableTracking: true,
	    click: function(api, options) {
	        api.simulateClick();
	        api.openPopup('googlePlus');
	    }
	});
*/

});
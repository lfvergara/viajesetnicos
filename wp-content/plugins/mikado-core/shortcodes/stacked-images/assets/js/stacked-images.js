(function($) {
	'use strict';
	
	var stackedImages = {};
	mkdf.modules.stackedImages = stackedImages;

	stackedImages.mkdfInitItemShowcase = mkdfInitStackedImages;


	stackedImages.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitStackedImages();
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function mkdfInitStackedImages() {
		var stackedImages = $('.mkdf-stacked-images-holder');

		if (stackedImages.length) {
			stackedImages.each(function(){
				var thisStackedImages = $(this),
					itemImage = thisStackedImages.find('.mkdf-si-images');

				//logic
				thisStackedImages.animate({opacity:1},200);

				setTimeout(function(){
					thisStackedImages.appear(function(){
						itemImage.addClass('mkdf-appeared');
					},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
				},100);
			});
		}
	}
	
})(jQuery);
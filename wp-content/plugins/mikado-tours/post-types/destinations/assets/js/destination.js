(function($) {
    'use strict';

    var destinations = {};
    if(typeof mkdf !== 'undefined'){
        mkdf.modules.destinations = destinations;
    }
    
    destinations.mkdfOnDocumentReady = mkdfOnDocumentReady;
    destinations.mkdfOnWindowLoad = mkdfOnWindowLoad;
    destinations.mkdfOnWindowResize = mkdfOnWindowResize;
    destinations.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
	    destinationShortcodeSearchFilters().fieldsHelper.init();
	    initDestinationMasonryCarousel();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
    }

    function themeInstalled() {
        return typeof mkdf !== 'undefined';
    }
    
    function destinationShortcodeSearchFilters() {
        var $searchForms = $('.mkdf-tours-filter-holder.mkdf-tours-filter-horizontal form');
        
        var fieldsHelper = function() {
            
            var initDestinationSearch = function() {
                var destinations = typeof mkdfToursSearchData !== 'undefined' ? mkdfToursSearchData.destinations : [];
                
                var destinations = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: destinations
                });
                
                $searchForms.find('.mkdf-tours-destination-search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'destinations',
                        source: destinations
                    });
            };
            
            return {
                init: function() {
                    initDestinationSearch();
                }
            }
        }();
        
        return {
            fieldsHelper: fieldsHelper
        }
    }

    function initDestinationMasonryCarousel(){
    	var destinationCarousels = $('.mkdf-tours-destination-masonry-carousel');

    	if (destinationCarousels.length){
    		destinationCarousels.each(function(){
    			var thisCarousel = $(this),
    				carouselMain = thisCarousel.find('.mkdf-tdm-carousel'),
	                slideItemsNumber = carouselMain.find('> div').length,
    				carouselWidth = thisCarousel.find('.mkdf-tours-row-inner-holder').width(),
    				items = thisCarousel.find('.mkdf-tdm-item-holder'),
    				numberOfParts = carouselMain.data('number-of-items'),
    				numberOfItems = numberOfParts,
    				autoplay = true,
    				loop = true,
    				navigation = true,
    				pagination = false,
    				mouseDrag = true,
    				touchDrag = true,
    				pullDrag = true;
    				
    			if (items.length) {
    				items.each(function(e){
    					var thisItem = $(this),
    						thisItemWidth = 0;

    					if (numberOfParts == 4){    						

							if (mkdf.windowWidth <= 1280) {
								if ((e + 1)%4 == 0){
									thisItemWidth = carouselWidth/4;
								} else if ((e + 1)%2 == 0){
									thisItemWidth = carouselWidth/2;
								} else {
									thisItemWidth = carouselWidth/4;
								}
							} else {
								if ((e + 1)%4 == 0){
									thisItemWidth = carouselWidth/5;
								} else if ((e + 1)%2 == 0){
									thisItemWidth = carouselWidth/5 * 2;
								} else {
									thisItemWidth = carouselWidth/5;
								}
							}
    					} else {
    						if ((e + 1)%2 == 0){
								thisItemWidth = carouselWidth/2;
							} else {
								thisItemWidth = carouselWidth/4;
							}
						}

						if (mkdf.windowWidth <= 768) {
							thisItemWidth = carouselWidth;
						}

						thisItem.css('width', Math.round(thisItemWidth));
    				});
    			}

	            if (carouselMain.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }
	            

	            //static layout
                if (slideItemsNumber <= numberOfItems) {
    	            loop       = false;
    	            autoplay   = false;
    	            navigation = false;
    	            pagination = false;
    	            mouseDrag = false;
    	            touchDrag = false;
    	            pullDrag = false;
                }

	            var sliderWidth = function(slider){
	            	var items = slider.find('.owl-item'),
	            		sliderWidth = 0;

	            	items.each(function(){
	            		var thisItem = $(this);

	            		sliderWidth += Math.ceil(thisItem.width());
	            	});

	            	if (sliderWidth != 0) {
		            	slider.find('.owl-stage').css('width', sliderWidth); //because of the chrome partial pixels
	            	}
	            }

	            carouselMain.owlCarousel({
		            items: numberOfItems,
		            loop: loop,
		            autoplay: autoplay,
		            autoplayHoverPause: true,
		            autoplayTimeout: 5000,
		            smartSpeed: 600,
		            margin: 0,
		            stagePadding: 0,
		            center: false,
		            autoWidth: true,
		            mouseDrag: mouseDrag,
		            touchDrag: touchDrag,
		            pullDrag: pullDrag,
		            dots: pagination,
		            nav: true,
		            navText: [
			            '<span class="mkdf-prev-icon lnr lnr-chevron-left"></span>',
			            '<span class="mkdf-next-icon lnr lnr-chevron-right"></span>'
		            ],
		            onInitialize: function () {
			            carouselMain.css('visibility', 'visible');
		            },
		            onInitialized: function () {
			            sliderWidth(carouselMain);
		            },
		            onDrag: function (e) {
			            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
				            var sliderIsMoving = e.isTrigger > 0;
				
				            if (sliderIsMoving) {
					            carouselMain.addClass('mkdf-slider-is-moving');
				            }
			            }
		            },
		            onDragged: function () {
			            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && carouselMain.hasClass('mkdf-slider-is-moving')) {
				
				            setTimeout(function () {
					            carouselMain.removeClass('mkdf-slider-is-moving');
				            }, 500);
			            }
		            }
                });

    		});
    	}
    }
    
    return destinations;
})(jQuery);

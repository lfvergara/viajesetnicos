(function($) {
    'use strict';

    var tours = {};

    if(typeof mkdf !== 'undefined'){
        mkdf.modules.tours = tours;
    }
    
    tours.mkdfOnDocumentReady = mkdfOnDocumentReady;
    tours.mkdfOnWindowLoad = mkdfOnWindowLoad;
    tours.mkdfOnWindowResize = mkdfOnWindowResize;
    tours.mkdfOnWindowScroll = mkdfOnWindowScroll;

    tours.mkdfInitTourItemTabs = mkdfInitTourItemTabs;
    tours.mkdfTourTabsMapTrigger = mkdfTourTabsMapTrigger;
    tours.mkdfTourReviewsInit = mkdfTourReviewsInit;
    tours.mkdfToursScrollDown = mkdfToursScrollDown;

    tours.mkdfToursRevealAnimation = mkdfToursRevealAnimation;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
       mkdfInitTourItemTabs();
        
        if(typeof mkdf !== 'undefined' ){
            //if theme is installed, trigger google map loading on location tab on single pages
            mkdfTourTabsMapTrigger();
        }
    
        mkdfTourGalleryMasonry();
	    mkdfTrigerTourGalleryMasonry();
	    
        mkdfTourReviewsInit();

        searchTours().fieldsHelper.init();
        searchTours().handleSearch.init();

        mkdfToursRevealAnimation();

        mkdfToursTitleFullHeight();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfToursScrollDown();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
	    mkdfTourGalleryMasonry();
        mkdfToursTitleFullHeight();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }

    function themeInstalled() {
        return typeof mkdf !== 'undefined';
    }
	
    /**
     * Init Resize Tours Gallery Items
     */
    function mkdfResizeToursGalleryItems(size,container){
        if(container.hasClass('mkdf-tours-gallery-images-fixed')) {
            var padding = parseInt(container.find('.mkdf-tour-gallery-item').css('padding-left')),
                defaultMasonryItem = container.find('.mkdf-tgi-masonry-default'),
                largeWidthMasonryItem = container.find('.mkdf-tgi-masonry-large-width'),
                largeHeightMasonryItem = container.find('.mkdf-tgi-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.mkdf-tgi-masonry-large-width-height');
                
            if (mkdf.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size * 2);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

	function mkdfTourGalleryMasonry(){
		var masonryList = $('.mkdf-tour-masonry-gallery-holder .mkdf-tour-masonry-gallery');
		
		if(masonryList.length){
			masonryList.each(function(){
				var thisMasonry = $(this),
					thisMasonrySize = thisMasonry.find('.mkdf-tour-grid-sizer').width();
				
                mkdfResizeToursGalleryItems(thisMasonrySize, thisMasonry);

				thisMasonry.waitForImages(function() {
					thisMasonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkdf-tour-gallery-item',
						percentPosition: true,
						packery: {
							gutter: '.mkdf-tour-grid-gutter',
							columnWidth: '.mkdf-tour-grid-sizer'
						}
					});
					
					thisMasonry.css('opacity', '1');
				});
			});
		}
	}
	
	function mkdfTrigerTourGalleryMasonry(){
		var holder = $('.mkdf-tour-item-single-holder');
		var tourNavItems = holder.find('.mkdf-single-tour-nav-holder ul li a');
		tourNavItems.on('click', function(){
			var thisNavItem  = $(this);
			var thisNavItemId = thisNavItem.attr('href');
			
			if(thisNavItemId === 'tour-item-gallery-id'){
				mkdfTourGalleryMasonry();
			}
		});
	}

    function mkdfInitTourItemTabs(){
        var holder = $('.mkdf-tour-item-single-holder');
        var tourNavItems = holder.find('.mkdf-tour-tabs-nav li a');
        var tourSectionsItems  = holder.find('.mkdf-tour-item-section');
        tourNavItems.first().parent().addClass('mkdf-active-item');

        tourNavItems.on('click', function(e){
        	e.preventDefault();
            tourNavItems.parent().removeClass('mkdf-active-item');

            var thisNavItem  = $(this);
            var thisNavItemId = thisNavItem.attr('href');
            thisNavItem.parent().addClass('mkdf-active-item');

            if( tourSectionsItems.length ){
                tourSectionsItems.each(function(){

                    var thisSectionItem = $(this);
                    if(thisSectionItem.attr('id') === thisNavItemId){
                        thisSectionItem.show();
                        if(thisNavItemId === 'tour-item-location-id'){
                              mkdfToursReInitGoogleMap();
                        }
                    }else{
                        thisSectionItem.hide();
                    }
                });
            }
        });
    }
    
    function mkdfTourTabsMapTrigger(){
        var holder = $('.mkdf-tour-item-single-holder');
        var tourNavItems = holder.find('.mkdf-single-tour-nav-holder ul li a');
        tourNavItems.on('click', function(){
            var thisNavItem  = $(this);
            var thisNavItemId = thisNavItem.attr('href');

            if(thisNavItemId === 'tour-item-location-id'){
                mkdfToursReInitGoogleMap();
            }
        });
    }
    
    function mkdfToursReInitGoogleMap(){

        if(typeof mkdf !== 'undefined' && typeof mkdf !== '' ){
            mkdf.modules.googleMap.mkdfShowGoogleMap();
        }
    }

    function mkdfTourReviewsInit() {
        var reviewWrappers = $('.mkdf-tour-reviews-input-wrapper');
        if (reviewWrappers.length) {

            var emptyStarClass = 'icon_star_alt',
                fullStarClass = 'icon_star';
            
            var setCriteriaCommands = function(criteriaHolder) {
                criteriaHolder.find('.mkdf-tour-reviews-star-holder')
                .mouseenter(function () {
                    $(this).add($(this).prevAll()).find('.mkdf-tour-reviews-star').removeClass(emptyStarClass).addClass(fullStarClass);
                    $(this).nextAll().find('.mkdf-tour-reviews-star').removeClass(fullStarClass).addClass(emptyStarClass);
                })
                .click(function() {
                    criteriaHolder.find('.mkdf-tour-reviews-hidden-input').val($(this).index()+1);
                });

                criteriaHolder.find('.mkdf-tour-reviews-rating-holder')
                .mouseleave(function() {
                    var inputValue = criteriaHolder.find('.mkdf-tour-reviews-hidden-input').val();
                    inputValue = inputValue === "" ? 0 : parseInt(inputValue,10);
                    $(this).find('.mkdf-tour-reviews-star-holder').each(function(i) {
                        $(this).find('.mkdf-tour-reviews-star').removeClass((i < inputValue) ? emptyStarClass : fullStarClass).addClass((i < inputValue) ? fullStarClass : emptyStarClass);
                    });
                }).trigger('mouseleave');
            };
            
            reviewWrappers.each(function() {

                var reviewWrapper = $(this);
                var criteriaHolders = reviewWrapper.find('.mkdf-tour-reviews-criteria-holder');

                criteriaHolders.each(function() {
                    setCriteriaCommands($(this));
                });
            });
        }
    }

    function searchTours() {
        var $searchForms = $('.mkdf-tours-search-main-filters-holder form');
        
        var fieldsHelper = function() {
            var initRangeSlider = function() {
                var $rangeSliders = $searchForms.find('.mkdf-tours-range-input');
                var $priceRange = $searchForms.find('.mkdf-tours-price-range-field');
                var $minPrice = $searchForms.find('[name="min_price"]');
                var $maxPrice = $searchForms.find('[name="max_price"]');
                var minValue = $priceRange.data('min-price');
                var maxValue = $priceRange.data('max-price');
                var chosenMinValue = $priceRange.data('chosen-min-price');
                var chosenMaxValue = $priceRange.data('chosen-max-price');
                
                if($rangeSliders.length) {
                    $rangeSliders.each(function() {
                        var thisSlider = this;
                        
                        var slider = noUiSlider.create(thisSlider, {
                            start: [chosenMinValue, chosenMaxValue],
                            connect: true,
                            step: 1,
                            range: {
                                'min': [ minValue ],
                                'max': [ maxValue ]
                            },
                            format: {
                                to: function(value) {
                                    return Math.floor(value);
                                },
                                from: function(value) {
                                    return value;
                                }
                            }
                        });
                        
                        slider.on('update', function(values) {
                            var firstValue = values[0];
                            var secondValue = values[1];
                            var currencySymbol = $priceRange.data('currency-symbol');
                            var currencySymbolPosition = $priceRange.data('currency-symbol-position');
                            
                            var firstPrice = currencySymbolPosition === 'left' ? currencySymbol + firstValue : firstValue + currencySymbol;
                            var secondPrice = currencySymbolPosition === 'left' ? currencySymbol + secondValue : firstValue + secondValue;
                            
                            $priceRange.val(firstPrice + ' - ' + secondPrice);
                            
                            $minPrice.val(firstValue);
                            $maxPrice.val(secondValue);
                        });
                    });
                }
            };
            
            var initKeywordSearch = function() {
                var tours = typeof mkdfToursSearchData !== 'undefined' ? mkdfToursSearchData.tours : [];
                
                var tours = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: tours
                });
                
                $searchForms.find('.mkdf-tours-keyword-search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'tours',
                        source: tours
                    });
            };
            
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
            
            var initSelectPlaceholder = function() {
                var $selects = $('.mkdf-tours-select-placeholder');
                
                var changeState = function($select) {
                    var selectVal = $select.val();
                    
                    if(selectVal === '') {
                        $select.addClass('mkdf-tours-select-default-option');
                    } else {
                        $select.removeClass('mkdf-tours-select-default-option');
                    }
                };
                
                if($selects.length) {
                    $selects.each(function() {
                        var $select = $(this);
                        
                        changeState($(this));
                        
                        $select.on('change', function() {
                            changeState($(this));
                        });
                    })
                }
            };
            
            return {
                init: function() {
                    initRangeSlider();
                    initKeywordSearch();
                    initDestinationSearch();
                    initSelectPlaceholder();
                }
            }
        }();
        
        var handleSearch = function() {
            var rewriteURL = function(queryString) {
                //init variables
                var currentPage = '';
                
                //does current url has query string
                if (location.href.match(/\?.*/) && document.referrer) {
                    //get clean current url
                    currentPage = location.href.replace(/\?.*/, '');
                }
                
                //rewrite url with current page and new url string
                window.history.replaceState({page: currentPage + '?' + queryString}, '', currentPage + '?' + queryString);
            };
            
            var sendRequest = function($form, changeLabel, resetPagination, animate) {
                var $submitButton = $form.find('input[type="submit"]');
                var $searchContent = $('.mkdf-tours-search-content');
                var $searchPageContent = $('.mkdf-tours-search-page-holder');
                var searchInProgress = false;
                
                changeLabel = typeof changeLabel !== 'undefined' ? changeLabel : true;
                resetPagination = typeof resetPagination !== 'undefined' ? resetPagination : true;
                animate = typeof animate !== 'undefined' ? animate : false;
                
                var searchingLabel = $submitButton.data('searching-label');
                var originalLabel = $submitButton.val();
                
                if(!searchInProgress) {
                    if(changeLabel) {
                        $submitButton.val(searchingLabel);
                    }
                    
                    if(resetPagination) {
                        $form.find('[name="page"]').val(1);
                    }
                    
                    searchInProgress = true;
                    $searchContent.addClass('mkdf-tours-searching');
                    
                    var data = {
                        action: 'tours_search_handle_form_submission'
                    };
                    
                    data.fields = $form.serialize();
                    
                    $.ajax({
                        type: 'GET',
                        url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                        dataType: 'json',
                        data: data,
                        success: function(response) {
                            if(changeLabel) {
                                $submitButton.val(originalLabel);
                            }
                            
                            $searchContent.removeClass('mkdf-tours-searching');
                            searchInProgress = false;
                            
                            $searchContent.find('.mkdf-tours-row .mkdf-tours-row-inner-holder').html(response.html);
                            rewriteURL(response.url);
                            
                            $('.mkdf-tours-search-pagination').remove();
                            
                            $searchContent.append(response.paginationHTML);
                            
                            if(animate) {
                                $('html, body').animate({scrollTop: $searchPageContent.offset().top - 80}, 700);
                            }
                            mkdfToursRevealAnimation();
                        }
                    });
                }
            };
            
            var formHandler = function($form) {
                
                if($('body').hasClass('post-type-archive-tour-item')) {
                    $form.on('submit', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        sendRequest($form);
                    });
                }
            };
            
            var handleOrderBy = function($searchForms) {
                var $orderingItems = $('.mkdf-search-ordering-item');
                var $orderByField = $searchForms.find('[name="order_by"]');
                var $orderTypeField = $searchForms.find('[name="order_type"]');
                
                if($orderingItems.length) {
                    $orderingItems.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        var $thisItem = $(this);
                        
                        $orderingItems.removeClass('mkdf-search-ordering-item-active');
                        $thisItem.addClass('mkdf-search-ordering-item-active');
                        
                        var orderBy = $thisItem.data('order-by');
                        var orderType = $thisItem.data('order-type');
                        
                        if(typeof orderBy !== 'undefined' && typeof orderType !== 'undefined') {
                            $orderByField.val(orderBy);
                            $orderTypeField.val(orderType);
                        }
                        
                        sendRequest($searchForms, false, false);
                    });
                }
            };
            
            var handleViewType = function($searchForms) {
                var $viewTypeItems = $('.mkdf-tours-search-view-item');
                var $typeField = $searchForms.find('[name="view_type"]');
                
                if($viewTypeItems.length) {
                    $viewTypeItems.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        var $thisView = $(this);
                        
                        $viewTypeItems.removeClass('mkdf-tours-search-view-item-active');
                        $thisView.addClass('mkdf-tours-search-view-item-active');
                        
                        var viewType = $thisView.data('type');
                        
                        if(typeof viewType !== 'undefined') {
                            $typeField.val(viewType);
                        }
                        
                        sendRequest($searchForms, false, false);
                    });
                }
            };
            
            var handlePagination = function($searchForms) {
                var $paginationHolder = $('.mkdf-tours-search-pagination');
                var $pageField = $searchForms.find('[name="page"]');
                
                if($paginationHolder.length) {
                    $(document).on('click', '.mkdf-tours-search-pagination li', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        var $thisItem = $(this);
                        
                        var page = $thisItem.data('page');
                        
                        if(typeof page !== 'undefined') {
                            $pageField.val(page);
                        }
                        
                        sendRequest($searchForms, true, false, true);
                    });
                }
            }
            
            return {
                init: function() {
                    formHandler($searchForms);
                    handleOrderBy($searchForms);
                    handleViewType($searchForms);
                    handlePagination($searchForms);
                }
            }
        }();
        
        return {
            fieldsHelper: fieldsHelper,
            handleSearch: handleSearch
        }
    }

    /*
    * Tours Reveal animation
    */
    function mkdfToursRevealAnimation() {
        var toursRevealItems = $('.mkdf-tours-revealing-item');

        if (toursRevealItems.length) {
            toursRevealItems.each(function(){
                var toursRevealItem = $(this),
                    contentHolder = toursRevealItem.find('.mkdf-tours-revealing-item-content-holder'),
                    excerpt = contentHolder.find('.mkdf-tours-revealing-item-excerpt'),
                    deltaY = Math.ceil(excerpt.height());

                contentHolder.css('transform','translate3d(0,'+deltaY+'px,0)');

                toursRevealItem.mouseenter(function(){
                    contentHolder.css('transform','translate3d(0,0,0)');
                });

                toursRevealItem.mouseleave(function(){
                    deltaY = Math.ceil(excerpt.height());
                    contentHolder.css('transform','translate3d(0,'+deltaY+'px,0)');
                });
            });
        }
    }

    function mkdfToursTitleFullHeight() {
    	var titleArea = $('.mkdf-tours-single-title'),
    		content = $('.mkdf-wrapper-inner > .mkdf-content'),
    		titleAreaHeight;

    	if (titleArea.length) {
    		titleAreaHeight = mkdf.windowHeight;

    		titleAreaHeight -= content.offset().top;

    		titleArea.css('height',titleAreaHeight);
    	}
    }

    function mkdfToursScrollDown() {
        var scrollDown = $('.mkdf-tours-single-scroll-down');

        if (scrollDown.length) {
            var toursSingle = $('.mkdf-tour-item-single-holder'),
                auxCoeff = 0,
                fixedHeader = $('.mkdf-fixed-wrapper'),
                stickyHeader = $('.mkdf-sticky-header');

            if (!mkdf.htmlEl.hasClass('touch')) {
                if (fixedHeader.length) {
                    auxCoeff = fixedHeader.height();
                } else if (stickyHeader.length) {
                    auxCoeff = stickyHeader.height();
                }
            }

            scrollDown.on('click', function() {
                $('html, body').animate({
                    scrollTop: toursSingle.offset().top - auxCoeff
                }, 1000, 'easeInOutExpo');
            });
        }
    }
    
    return tours;
})(jQuery);

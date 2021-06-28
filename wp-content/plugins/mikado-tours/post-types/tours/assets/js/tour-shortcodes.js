(function($) {
    'use strict';

    var tourShortcodes = {};
    if(typeof mkdf !== 'undefined'){
        mkdf.modules.tourShortcodes = tourShortcodes;
    }
    
    tourShortcodes.mkdfOnDocumentReady = mkdfOnDocumentReady;
    tourShortcodes.mkdfOnWindowLoad = mkdfOnWindowLoad;
    tourShortcodes.mkdfOnWindowResize = mkdfOnWindowResize;
    tourShortcodes.mkdfOnWindowScroll = mkdfOnWindowScroll;

    tourShortcodes.toursList = toursList;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        toursList().init();
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

    function toursList() {
        var listItem = $('.mkdf-tours-list-holder'),
            listObject;

        var initList = function(listHolder) {
            listHolder.animate({opacity: 1});

            listObject = listHolder.isotope({
                percentPosition: true,
                itemSelector: '.mkdf-tours-row-item',
                transitionDuration: '0.4s',
                isInitLayout: true,
                hiddenStyle: {
                    opacity: 0
                },
                visibleStyle: {
                    opacity: 1
                },
                masonry: {
                    columnWidth: '.mkdf-tours-list-grid-sizer'
                }
            });

            if(themeInstalled()) {
                mkdf.modules.common.mkdfInitParallax();
            }
        };

        var initFilter = function(listFeed) {
            var filters = listFeed.find('.mkdf-tour-list-filter-item');

            filters.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var currentFilter = $(this);
                var type = currentFilter.data('type');

                filters.removeClass('mkdf-tour-list-current-filter');
                currentFilter.addClass('mkdf-tour-list-current-filter');

                type = typeof type === 'undefined' ? '*' : '.' + type;

                listFeed.find('.mkdf-tours-list-holder-inner').isotope({
                    filter: type
                });
            });
        };

        var resetFilter = function(listFeed) {
            var filters = listFeed.find('.mkdf-tour-list-filter-item');

            filters.removeClass('mkdf-tour-list-current-filter');
            filters.eq(0).addClass('mkdf-tour-list-current-filter');

            listFeed.find('.mkdf-tours-list-holder-inner').isotope({
                filter: '*'
            });
        };

        var initPagination = function(listObject) {
            var paginationDataHolder = listObject.find('.mkdf-tours-list-pagination-data');
            var itemsHolder = listObject.find('.mkdf-tours-list-holder-inner');

            var fetchData = function(callback) {
                var data = {
                    action: 'mkdf_tours_list_ajax_pagination',
                    fields: paginationDataHolder.find('input').serialize()
                };

                $.ajax({
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    data: data,
                    dataType: 'json',
                    type: 'POST',
                    success: function(response) {
                        if(response.havePosts) {
                            paginationDataHolder.find('[name="next_page"]').val(response.nextPage);
                        }

                        if(themeInstalled()) {
                            mkdf.modules.common.mkdfInitParallax();
                        }

                        callback.call(this, response);
                    }
                });
            };
            
            var loadMorePagination = function() {
                var loadMoreButton = listObject.find('.mkdf-tours-load-more-button');
                var paginationHolder = listObject.find('.mkdf-tours-pagination-holder');
                var loadingInProgress = false;

                if(loadMoreButton.length) {
                    loadMoreButton.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        var loadingLabel = loadMoreButton.data('loading-label');
                        var originalText = loadMoreButton.text();
                        
                        loadMoreButton.text(loadingLabel);
                        resetFilter(listObject);

                        if(!loadingInProgress) {
                            loadingInProgress = true;

                            fetchData(function(response) {
                                if(response.havePosts === true) {
                                    loadMoreButton.text(originalText);

                                    var responseHTML = $(response.html);

                                    itemsHolder.append(responseHTML);

                                    itemsHolder.waitForImages(function() {
                                        itemsHolder.isotope('appended', responseHTML).isotope('reloadItems');
                                        mkdf.modules.tours.mkdfToursRevealAnimation();
                                    });

                                    if (response.maxPage < response.nextPage) {
	                                    loadMoreButton.remove();
                                    }
                                } else {
                                    loadMoreButton.remove();

                                    paginationHolder.html(response.message);
                                }

                                loadingInProgress = false;
                            });
                        }

                    });
                }
            };

            loadMorePagination();
        };

        return {
            init: function() {
                if(listItem.length && typeof $.fn.isotope !== 'undefined') {
                    listItem.each(function() {
                        initList($(this).find('.mkdf-tours-list-holder-inner'));
                        initFilter($(this));
                        initPagination($(this));
                    });
                }
            }
        }
    }
    
    return tourShortcodes;
})(jQuery);

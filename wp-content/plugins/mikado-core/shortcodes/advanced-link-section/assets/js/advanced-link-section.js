(function($) {
    'use strict';

    var advancedLinkSection = {};
    mkdf.modules.advancedLinkSection = advancedLinkSection;

    advancedLinkSection.mkdfInitAdvancedLinkSection =mkdfInitAdvancedLinkSection;


    advancedLinkSection.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitAdvancedLinkSection();
    }

function mkdfInitAdvancedLinkSection(){
    var linkSections = $('.mkdf-advanced-link-section');

    if (linkSections.length){
        linkSections.each(function(){
            var linkSection = $(this),
                linkSectionItem = linkSection.find('.mkdf-als-item'),
                linkSectionOffset = linkSection.offset(),
                linkSectionHeight = mkdf.windowHeight - mkdfGlobalVars.vars.mkdfAddForAdminBar,
                fixedHeader = $('.mkdf-fixed-wrapper'),
                headerOffset = $('.mkdf-page-header').offset(),
                headerMobileOffset = $('.mkdf-mobile-header').offset(),
                headerOffsetBottom;

            if (mkdf.windowWidth > 1024) {
                headerOffsetBottom = headerOffset.top + mkdfGlobalVars.vars.mkdfMenuAreaHeight;
            } else {
                headerOffsetBottom = headerMobileOffset.top + mkdfGlobalVars.vars.mkdfMobileHeaderHeight;
            }

            if (linkSectionOffset.top == headerOffsetBottom){
                linkSectionHeight -= headerOffsetBottom - mkdfGlobalVars.vars.mkdfAddForAdminBar;
            }
            else if (fixedHeader.length){
                linkSectionHeight -= mkdfGlobalVars.vars.mkdfMenuAreaHeight;
            }

            linkSection.css('height', linkSectionHeight);

            if (mkdf.windowWidth <= 768){
                linkSectionItem.css('height', linkSectionHeight/linkSectionItem.length); //set item height when turned to one below another
            }

            if (linkSection.hasClass('mkdf-als-uncovering')) {
                var alsShortcode = linkSection,
                    uncoveringElements = alsShortcode.find('.mkdf-als-uncovering-element');

                //uncover fx
                $(window).load(function(){
                    alsShortcode.appear(function(){
                        setTimeout(function(){
                            uncoveringElements.each(function(i){
                                var uncoveringElement = $(this);

                                setTimeout(function(){
                                    uncoveringElement.addClass('mkdf-uncovered');
                                    if (i == uncoveringElements.length - 1) {
                                        alsShortcode.addClass('mkdf-shortcode-uncovered');
                                    }
                                }, i*200);
                            });
                        },700); //initial delay
                    },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                });
            }
        });
    }
}
})(jQuery);
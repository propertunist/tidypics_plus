/*
 * isotope initialisation for elgg with hypeList
 * @package: ureka_theme
 * author: ura soul
 */

define(function(require)
{
    var isotope = require('isotope');
    var imagesLoaded = require('imagesLoaded');
    var hypeList = require('hypeList');
    $(document).ready(function()
    {
        imagesLoaded.makeJQueryPlugin( $ );

        require(['bridget'], function() {
            document.addEventListener('lazybeforeunveil', function(e){
            $('.tidypics-album-list').isotope('layout');
            });
            // make Isotope a jQuery plugin
            $.bridget('isotope', isotope, $);

            // now you can use $().isotope()
            $grid = $(".tidypics-album-list").isotope({
                itemSelector: '.elgg-item',
                layoutMode: 'masonry',
                percentPosition: true,
                resize: true,
                // options for masonry layout mode
                masonry: {
                    columnWidth: '.elgg-item',
                //    gutter: '.elgg-item'
                }
            });

            // layout Isotope after each image loads
            $grid.imagesLoaded().progress( function() {
                $('.tidypics-album-list').isotope('layout');
            });

            $('.tidypics-album-list').hypeList();

            // add only the items that were shown in the last page load to isotope.
            var instance = $('.tidypics-album-list').data('hypeList');
            $(instance).on('pageShown', function(options) {
                var listOptions = options.target.options,
                    limit = listOptions.limit,
                    count = listOptions.count,
                    totalPages = count/limit,
                    // % = mod
                    itemsOnLastPage = count % limit,
                    activePage = listOptions.activePage,
                    itemsAlreadyLoaded,
                    itemsJustAdded;

                if (activePage < totalPages)
                {
                    itemsAlreadyLoaded = activePage * limit;
                    itemsJustAdded = limit;
                }
                else {
                    itemsAlreadyLoaded = count;
                    itemsJustAdded = itemsOnLastPage;
                }

                // get elements to add
                var elements = $('.tidypics-album-list').find('.elgg-item').slice(itemsAlreadyLoaded - itemsJustAdded,itemsAlreadyLoaded);

                // initially hide new elements, and use imagesLoaded
                var $elements = $( elements ).hide().imagesLoaded( function() {
                  // show when ready to reveal
                  $elements.show();
                  // append items to grid
                  $grid.append($elements)
                  // add and lay out newly appended items
                  .isotope( 'appended', $elements );
                });
                $('.tidypics-album-list').isotope('layout');
            });
        });
    });
});

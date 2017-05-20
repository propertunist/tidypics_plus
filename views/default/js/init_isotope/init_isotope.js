/*
 * isotope initialisation for elgg
 * @package: ureka_theme
 * author: ura soul
 */

define(function(require)
{
    var isotope = require('isotope');
    var imagesLoaded = require('imagesLoaded');

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
        });
    });
});

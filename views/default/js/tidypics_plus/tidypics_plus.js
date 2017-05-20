define(function(require)
{
    var $ = require('jquery');
    var elgg = require('elgg');
  //  var hypeList = require('hypeList');
    var slick = require('slick');
    var lightbox = require('elgg/lightbox');
	var EXTENDED_TINYMCE = require('extended_tinymce');
	// load a new image into the lightbox following a click to a navigate button
    navigateImage = function(fromGuid, toGuid)
    {
        elgg.get('ajax/view/tidypics/image_popup', {
            data: {
                guid: toGuid
            },
            success: function (output) {
                $('.imagebox-popup #cboxLoadedContent').html(output);
                $('.imagebox-popup .elgg-slick-slider').removeClass('elgg-state-loading').slick();
                resizeColorBox();
                return true;
            }
        });
    }

    // ColorBox resize function
    var resizeTimer;
    function resizeColorBox()
    {
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
                if ($('#cboxOverlay').is(':visible')) {
                        $.colorbox.resize({width:'95%', height:'95%'});
                }
        }, 300);
    }

    jQuery(document).ready(function($)
    {
        // when a colorbox opens
        $(document).bind('cbox_open', function(){
            // disable main scrollbar for window
            $('body').css('overflow-y', 'hidden');

            // scroll to top of comment/info block
            $('.image_popup_comment_block .elgg-body').scrollTop(0);

        });

        // when a colorbox closes
        $(document).bind('cbox_closed', function(){
            // enable main scrollbar for window
            $('body').css('overflow-y', 'scroll');
        });

        // when a colorbox starts closing
        $(document).bind('cbox_cleanup', function(){
            if (window.tinymce) {
                tinyMCE.remove();
            }
        });

        // when a colorbox has completed
        $(document).bind('cbox_complete', function(){
            $('.imagebox-popup .elgg-slick-slider').removeClass('elgg-state-loading').slick();
            // connect galliComments to commenting system
            if (typeof window.elgg.galliComments !== "undefined")
            {
                $('.elgg-form-comment-save, #group-replies').find('input[type=submit]').on('click', elgg.galliComments.submit);
            }
            if (typeof window.elgg.au_sets !== "undefined")
            {
              // attach pinboards 'pin' action to new list items
              elgg.au_sets.pinclick();
            }
        });

        // when window is resized
        window.onresize = function()
        {
            // Resize ColorBox when resizing window or changing mobile device orientation
            jQuery(window).resize(resizeColorBox);
            window.addEventListener("orientationchange", resizeColorBox, false);
        };
    });
});

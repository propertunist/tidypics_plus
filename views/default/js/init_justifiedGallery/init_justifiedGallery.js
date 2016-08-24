/*
 * justifiedGallery initialisation for elgg
 * @package: ureka_theme
 * author: ura soul
 */

define(function(require)
{
    var $ = require('jquery');
    var justifiedGallery = require('justifiedGallery');
    var elgg = require('elgg');
    var Ajax = require('elgg/Ajax');
    var ajax = new Ajax();

    $(document).ready(function()
    {
        ajax.path('tidypics_plus_settings').done(function (output) {
            $options = output;
            $(".tidypics-gallery").justifiedGallery({
                selector: '> .elgg-item',
                rowHeight: $options.justify_rowheight,
                margins: $options.justify_margins,
                maxRowHeight: $options.justify_max_rowheight,
                fixedHeight: $options.justify_fixed_height,
                cssAnimation: $options.justify_css_animation,
                captions: $options.justify_captions,
                waitThumbnailsLoad: $options.justify_wait_thumbs,
                lastRow: $options.justify_last_row,
                captionSettings: { animationDuration: $options.justify_caption_anim_time,
                                    visibleOpacity: $options.justify_caption_opacity_visible,
                                    nonVisibleOpacity: $options.justify_caption_opacity_invisible },
                thumbnailPath: function (currentPath, width, height) {
                    if (Math.max(width, height) < 250) {
                        return currentPath.replace(/(.*)(large)(.*)/gi, "$1small$3");
                    } else {
                        return currentPath;
                    }
                }
            });
        });

        $('.tidypics-gallery').justifiedGallery().on('jg.complete', function (e) {
               $(".tidypics-image-list").css('visibility', 'visible');
        });
    });
});

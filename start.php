<?php
/**
 * Elgg tidypics_plus plugin
 *
 * @package tidypics_plus
 */
    elgg_register_event_handler('init', 'system', 'tidypics_plus_init');

/**
 * Initialise tidypics_plus plugin
 *
 */
function tidypics_plus_init() {
    $root = dirname(__FILE__);

    elgg_extend_view('elgg.css', 'css/tidypics_plus.css');
    elgg_extend_view('admin.css', 'css/tidypics_plus_admin.css');
    elgg_register_library('functions', $root . '/lib/functions.php');
    elgg_load_library('functions');
    elgg_register_ajax_view('tidypics/image_popup');
	elgg_register_page_handler('tidypics_plus_settings', 'tidypics_plus_get_JS_params');
    elgg_register_css('justified-gallery-on', 'css/justifiedGalleryOn.css');

    elgg_define_js('justifiedGallery', [
        'src' => 'https://bowercdn.net/c/justifiedGallery-3.6.2/dist/js/jquery.justifiedGallery.min.js',
        //'src' => elgg_get_simplecache_url('js', 'tidypics_plus/jquery.justifiedGallery.js'),
        'deps' => array('jquery'),
        'exports' => 'jQuery.fn.justifiedGallery',
    ]);

    elgg_define_js('isotope', [
        'src' => 'https://cdn.jsdelivr.net/isotope/3.0.1/isotope.pkgd.min.js',
    //    'src' => elgg_get_simplecache_url('js', 'tidypics_plus/isotope.pkgd.js'),
        'deps' => array('jquery'),
        'exports' => 'jQuery.fn.isotope',
    ]);

    elgg_define_js('imagesLoaded', [
        'src' => 'https://cdn.jsdelivr.net/imagesloaded/4.1.0/imagesloaded.pkgd.min.js',
        //'src' => elgg_get_simplecache_url('js', 'tidypics_plus/imagesloaded.pkgd.js'),
        'deps' => array('jquery'),
        'exports' => 'imagesLoaded',
    ]);
/*
    elgg_define_js('bridget', [
        'src' => 'https://bowercdn.net/c/jquery-bridget-2.0.1/jquery-bridget.js',
        //'src' => elgg_get_simplecache_url('js', 'tidypics_plus/jquery-bridget.js'),
        'deps' => array('jquery'),
        'exports' => 'bridget',
    ]);*/
}

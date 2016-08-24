<?php
/**
 * Full view of an album
 *
 * @uses $vars['entity'] TidypicsAlbum
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */
elgg_pop_breadcrumb();
$album = elgg_extract('entity', $vars);
$owner = $album->getOwnerEntity();

$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$metadata = elgg_view_menu('entity', array(
	'entity' => $album,
	'handler' => 'photos',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$owner_link = elgg_view('output/url', array(
	'href' => "photos/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($album->time_created);
$categories = elgg_view('output/categories', $vars);
$tags = elgg_view('output/tags', array('tags' => $album->tags));
if (($categories)||($tags))
    $footer = "$categories $tags";
if ($footer)
{
    $footer = "<div class=\"elgg-item-info elgg-object-footer\">$footer</div>";
}
$subtitle = "$author_text $date";

$params = array(
	'entity' => $album,
	'title' => false,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
);
$params = $params + $vars;
$summary = elgg_view('object/elements/summary', $params);

$body = '';
if ($album->description) {
	$body = elgg_view('output/longtext', array(
		'value' => $album->description,
		'class' => 'mbm',
	));
}

$body .= $album->viewImages(array(
	'gallery_class' => 'tidypics-image-list tidypics-gallery',
	'limit' => 12,
//	'pagination' => true,
//	'pagination_type' => 'infinite',
	'list_id' => 'tidypics_album_list',
	'position' => 'after'));
$body .= $footer;
$body .= elgg_view_comments($album);


if ('yes' == elgg_get_plugin_setting('justified_gallery_albums', 'tidypics_plus'))
{
	elgg_require_js('justifiedGallery');
	if (elgg_is_active_plugin('hypeLists'))
		elgg_require_js('init_justifiedGallery/init_justifiedGallery_hypeList');
	else
		elgg_require_js('init_justifiedGallery/init_justifiedGallery');
	elgg_load_css('justified-gallery-on');
}
elgg_require_js('tidypics/tidypics');
elgg_load_js('lightbox');
elgg_load_css('lightbox');
elgg_load_css('slick');
elgg_load_css('slick-theme');
elgg_load_css('elgg.slick');
elgg_require_js('tidypics_plus/tidypics_plus');

echo elgg_view('object/elements/full', array(
	'entity' => $album,
	'icon' => $owner_icon,
	'summary' => $summary,
	'body' => $body,
));

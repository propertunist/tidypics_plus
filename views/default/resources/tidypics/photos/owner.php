<?php
/**
 * Show all the albums that belong to a user or group
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

elgg_group_gatekeeper();

$owner = elgg_get_page_owner_entity();

if (!$owner) {
	forward(REFERER);
}

$title = elgg_echo('album:user', array($owner->name));

// set up breadcrumbs
elgg_push_breadcrumb(elgg_echo('photos'), 'photos/siteimagesall');
elgg_push_breadcrumb(elgg_echo('tidypics:albums'), 'photos/all');
elgg_push_breadcrumb($owner->name);

$offset = (int)get_input('offset', 0);
$limit = (int)get_input('limit', 16);

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'album',
	'container_guid' => $owner->getGUID(),
	'limit' => $limit,
	'offset' => $offset,
	'full_view' => false,
	'list_type' => 'gallery',
	'list_type_toggle' => false,
	'list_class' => 'elgg-list elgg-list-entity',
	'gallery_class' => 'tidypics-gallery tidypics-album-list',
));
if (!$content) {
	$content = elgg_echo('tidypics:none');
}

elgg_load_css('slick');
elgg_load_css('slick-theme');
elgg_load_css('elgg.slick');
if ('yes' == elgg_get_plugin_setting('album_masonry', 'tidypics_plus'))
{
	elgg_require_js('isotope');
	if (elgg_is_active_plugin('hypeList'))
		elgg_require_js('init_isotope/init_isotope-hypeList');
	else
		elgg_require_js('init_isotope/init_isotope');
}
elgg_require_js('tidypics/tidypics');
elgg_require_js('elgg/lightbox');
elgg_load_css('lightbox');

if (elgg_is_logged_in()) {
	if ($owner instanceof ElggGroup) {
		if ($owner->isMember(elgg_get_logged_in_user_entity())) {
			elgg_register_menu_item('title', array(
				'name' => 'addphotos',
				'href' => "ajax/view/photos/selectalbum/?owner_guid=" . $owner->getGUID(),
				'text' => elgg_echo("photos:addphotos"),
				'link_class' => 'elgg-button elgg-button-action elgg-lightbox'
			));
		}
	} else {
		elgg_register_menu_item('title', array(
			'name' => 'addphotos',
			'href' => "ajax/view/photos/selectalbum/?owner_guid=" . elgg_get_logged_in_user_guid(),
			'text' => elgg_echo("photos:addphotos"),
			'link_class' => 'elgg-button elgg-button-action elgg-lightbox'
		));
	}
}

elgg_register_title_button();

$params = array(
	'filter_context' => 'mine',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('photos/sidebar_al', array('page' => 'owner')),
);

// don't show filter if out of filter context
if ($owner instanceof ElggGroup) {
	$params['filter'] = false;
}

if ($owner->getGUID() != elgg_get_logged_in_user_guid()) {
	$params['filter_context'] = '';
}

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

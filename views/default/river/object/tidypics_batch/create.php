<?php
/**
 * Batch river view
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 *
 */

elgg_require_js('tidypics/tidypics');
$icon_options = array();
if ('yes' == elgg_get_plugin_setting('use_popup_river', 'tidypics_plus'))
{
	elgg_load_js('elgg/lightbox');
	elgg_load_css('lightbox');
	elgg_load_css('slick');
	elgg_load_css('slick-theme');
	elgg_load_css('elgg.slick');
	elgg_require_js('tidypics_plus/tidypics_plus');
	$icon_options['img_class'] = 'tidypics-photo';
	$icon_options['link_class'] = 'elgg-lightbox';
}
$batch = $vars['item']->getObjectEntity();

// Get images related to this batch
$images = elgg_get_entities_from_relationship(array(
	'relationship' => 'belongs_to_batch',
	'relationship_guid' => $batch->getGUID(),
	'inverse_relationship' => true,
	'type' => 'object',
	'subtype' => 'image',
	'offset' => 0,
));

$album = $batch->getContainerEntity();
if (!$album) {
	// something went quite wrong - this batch has no associated album
	return true;
}
$album_link = elgg_view('output/url', array(
	'href' => $album->getURL(),
	'text' => $album->getTitle(),
	'is_trusted' => true,
));

$subject = $vars['item']->getSubjectEntity();
$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$attachments = '';
if ((count($images))>1) {
	$preview_size = elgg_get_plugin_setting('river_thumbnails_size', 'tidypics');
	if(!$preview_size) {
		$preview_size = 'tiny';
	}
	$attachments = '<ul class="tidypics-river-list">';
	foreach($images as $image) {
		if ('yes' == elgg_get_plugin_setting('use_popup_river', 'tidypics_plus'))
		{
			$icon_options['href'] = 'ajax/view/tidypics/image_popup?guid=' . $image->guid;
			$icon_options['data-colorbox-opts'] = json_encode([
					'height' => '95%',
					'width' => '95%',
					'fixed' => true,
					'className' => 'imagebox-popup imagebox' . $image->guid,
			]);
		}
		else {
			$icon_options['href'] = $image->getURL();
		}
		$attachments .= '<li class="tidypics-photo-item">';
		$attachments .= elgg_view_entity_icon($image, $preview_size, $icon_options);
		$attachments .= '</li>';
	}
	$attachments .= '</ul>';
	$summary = elgg_echo('image:river:created:multiple', array($subject_link, count($images), $album_link));
}
elseif (count($images) == 1) {
	// View the comments of the image
	$vars['item']->object_guid = $images[0]->guid;
	$excerpt = strip_tags(elgg_get_excerpt($images[0]->description,500));
	$excerpt = '<div class="elgg-river-excerpt">' . $excerpt . '</div>';
	$responses = elgg_view('river/elements/responses', $vars);

	if ($responses) {
		$responses = "<div class=\"elgg-river-responses\">$responses</div>";
	}
	if ('yes' == elgg_get_plugin_setting('use_popup_river', 'tidypics_plus'))
	{
		$icon_options['href'] = 'ajax/view/tidypics/image_popup?guid=' . $images[0]->guid;
		$icon_options['data-colorbox-opts'] = json_encode([
				'height' => '95%',
				'width' => '95%',
				'fixed' => true,
				'className' => 'imagebox-popup imagebox' . $images[0]->guid,
		]);
	}
	else {
		$icon_options['href'] = $images[0]->getURL();
	}
	$attachments = '<div class="elgg-river-thumb">';
	$attachments .= elgg_view_entity_icon($images[0], $preview_size, $icon_options);
	$attachments .= '</div>';

	$image_link = elgg_view('output/url', array(
		'href' => $images[0]->getURL(),
		'text' => $images[0]->getTitle(),
		'is_trusted' => true,
	));
	$summary = elgg_echo('image:river:created', array($subject_link, $image_link, $album_link));
} else {
	// View the comments of the album
	$vars['item']->object_guid = $album->guid;
	$responses = elgg_view('river/elements/responses', $vars);
	if ($responses) {
		$responses = "<div class=\"elgg-river-responses\">$responses</div>";
	}
	$summary = elgg_echo('image:river:created:multiple', array($subject_link, count($images), $album_link));
}

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'attachments' => $attachments,
  'message' => $excerpt,
	'summary' => $summary
));

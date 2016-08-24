<?php
/**
 * Image album view
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */


$image = $vars['item']->getObjectEntity();
elgg_require_js('tidypics/tidypics');
$icon_options = array();
if ('yes' == elgg_get_plugin_setting('use_popup_river', 'tidypics_plus'))
{
	elgg_load_js('lightbox');
	elgg_load_css('lightbox');
	elgg_load_css('slick');
	elgg_load_css('slick-theme');
	elgg_load_css('elgg.slick');
	elgg_require_js('tidypics_plus/tidypics_plus');
	$icon_options['img_class'] = 'tidypics-photo';
	$icon_options['link_class'] = 'elgg-lightbox';
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

$subject = $vars['item']->getSubjectEntity();
$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$excerpt = strip_tags(elgg_get_excerpt($image->description,500));
$excerpt = '<div class="elgg-river-excerpt">' . $excerpt . '</div>';
//if (elgg_in_context('widgets'))
    $image_size = 'small';
//else
  //  $image_size = 'large';

$attachments = '<div class="elgg-river-thumb">' . elgg_view_entity_icon($image, $image_size, $icon_options . '</div>';

$image_link = elgg_view('output/url', array(
	'href' => $image->getURL(),
	'text' => $image->getTitle(),
	'is_trusted' => true,
));

$album_link = elgg_view('output/url', array(
	'href' => $image->getContainerEntity()->getURL(),
	'text' => $image->getContainerEntity()->getTitle(),
	'is_trusted' => true,
));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
//	'attachments' =>  $attachments,
	'message' => $attachments . $excerpt,
	'summary' => elgg_echo('image:river:created', array($subject_link, $image_link, $album_link)),
));

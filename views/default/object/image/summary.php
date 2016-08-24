<?php
/**
 * Summary of an image for lists/galleries
 *
 * @uses $vars['entity'] TidypicsImage
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

$image = elgg_extract('entity', $vars);
$icon_options = array();

if ('yes' == elgg_get_plugin_setting('use_popup_lists', 'tidypics_plus'))
{
	$icon_options['href'] = 'ajax/view/tidypics/image_popup?guid=' . $image->guid;
	$icon_options['link_class'] = 'elgg-lightbox';
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

$img = elgg_view_entity_icon($image, 'large', $icon_options);

$img_title = $image->getTitle();
if (strlen($img_title) > 40) {
	$img_title = substr($img_title, 0, 37).'...';
}

$owner_link = elgg_view('output/url', array(
	'href' => "photos/owner/" . $image->getOwnerEntity()->username,
	'text' => $image->getOwnerEntity()->name,
        'is_trusted' => TRUE,
));
$author_text = '<span class="elgg-subtext">' . elgg_echo('byline', array($owner_link)) . '</span>';
$likes_view = elgg_view('likes/count', array('entity' => $image));
if ($likes_view)
    $likes = '<br/><span class="elgg-subtext">' . $likes_view . '</span>';

$header = '<h3>' . elgg_view('output/url', array(
	'text' => $img_title,
	'href' => $image->getURL(),
	'is_trusted' => true,
	'class' => 'tidypics-heading',
)) . '</h3>';
if (elgg_in_context('gallery'))
	echo $img;
else
{
	$output = $img . '<br/>' .  $header . $author_text . $likes;
	$body = elgg_view('output/url', array(
		'text' => $output,
		'href' => $image->getURL(),
		'encode_text' => false,
		'is_trusted' => true,
	));

	echo elgg_view_module('tidypics-image', null, $body);
}

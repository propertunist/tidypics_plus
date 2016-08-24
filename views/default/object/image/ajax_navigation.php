<?php
/**
 * Photo navigation
 *
 * @uses $vars['entity']
 */

$photo = $vars['entity'];

$album = $photo->getContainerEntity();
$previous_photo = $album->getPreviousImage($photo->getGUID());
$next_photo = $album->getNextImage($photo->getGUID());
$size = $album->getSize();
$index = $album->getIndex($photo->getGUID());

echo '<ul class="elgg-menu elgg-menu-hz tidypics-album-nav">';
echo '<li>';
echo elgg_view('output/url', array(
	'text' => elgg_view_icon('arrow-left'),
	'href' => '#',
  'is_trusted' => TRUE,
	'onClick' => 'navigateImage(' . $photo->guid . ', ' . $previous_photo->guid . ');',
));
echo '</li>';

echo '<li>';
echo '<span>' . elgg_echo('image:index', array($index, $size)) . '</span>';
echo '</li>';

echo '<li>';
echo elgg_view('output/url', array(
	'text' => elgg_view_icon('arrow-right'),
	'href' => '#',
  'is_trusted' => TRUE,
	'onClick' => 'navigateImage(' . $photo->guid . ', ' . $next_photo->guid . ');',
));
echo '</li>';
echo '</ul>';

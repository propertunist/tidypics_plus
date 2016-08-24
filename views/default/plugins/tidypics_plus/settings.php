<div class="tidypics_plus-admin-panel">
<?php

$album_masonry = elgg_get_plugin_setting('album_masonry','tidypics_plus');
if (!$album_masonry)
{
   $album_masonry = 'yes';
   elgg_set_plugin_setting('album_masonry',$album_masonry,'tidypics_plus');
}

$justified_gallery_list = elgg_get_plugin_setting('justified_gallery_list','tidypics_plus');
if (!$justified_gallery_list)
{
   $justified_gallery_list = 'yes';
   elgg_set_plugin_setting('justified_gallery_list',$justified_gallery_list,'tidypics_plus');
}

$justified_gallery_albums = elgg_get_plugin_setting('justified_gallery_albums','tidypics_plus');
if (!$justified_gallery_albums)
{
   $justified_gallery_albums = 'yes';
   elgg_set_plugin_setting('justified_gallery_albums',$justified_gallery_albums,'tidypics_plus');
}

$use_popup_lists = elgg_get_plugin_setting('use_popup_lists','tidypics_plus');
if (!$use_popup_lists)
{
   $use_popup_lists = 'yes';
   elgg_set_plugin_setting('use_popup_lists',$use_popup_lists,'tidypics_plus');
}

$use_popup_river = elgg_get_plugin_setting('use_popup_river','tidypics_plus');
if (!$use_popup_river)
{
   $use_popup_river = 'yes';
   elgg_set_plugin_setting('use_popup_river',$use_popup_river,'tidypics_plus');
}

$navigation_mode = elgg_get_plugin_setting('navigation_mode','tidypics_plus');
if (!$navigation_mode)
{
   $navigation_mode = 'slider';
   elgg_set_plugin_setting('navigation_mode',$navigation_mode,'tidypics_plus');
}

$justify_margins = elgg_get_plugin_setting('justify_margins','tidypics_plus');
if (!$justify_margins)
{
   $justify_margins = '7';
   elgg_set_plugin_setting('justify_margins',$justify_margins,'tidypics_plus');
}

$justify_rowheight = elgg_get_plugin_setting('justify_rowheight','tidypics_plus');
if (!$justify_rowheight)
{
   $justify_rowheight = '200';
   elgg_set_plugin_setting('justify_rowheight',$justify_rowheight,'tidypics_plus');
}

$justify_max_rowheight = elgg_get_plugin_setting('justify_max_rowheight','tidypics_plus');
if (!$justify_max_rowheight)
{
   $justify_max_rowheight = '200%';
   elgg_set_plugin_setting('justify_max_rowheight',$justify_max_rowheight,'tidypics_plus');
}

$justify_fixed_height = elgg_get_plugin_setting('justify_fixed_height','tidypics_plus');
if (!$justify_fixed_height)
{
   $justify_fixed_height = 'no';
   elgg_set_plugin_setting('justify_fixed_height',$justify_fixed_height,'tidypics_plus');
}

$justify_css_animation = elgg_get_plugin_setting('justify_css_animation','tidypics_plus');
if (!$justify_css_animation)
{
   $justify_css_animation = 'no';
   elgg_set_plugin_setting('justify_css_animation',$justify_css_animation,'tidypics_plus');
}

$justify_wait_thumbs = elgg_get_plugin_setting('justify_wait_thumbs','tidypics_plus');
if (!$justify_wait_thumbs)
{
   $justify_wait_thumbs = 'no';
   elgg_set_plugin_setting('justify_wait_thumbs',$justify_wait_thumbs,'tidypics_plus');
}

$justify_last_row = elgg_get_plugin_setting('justify_last_row','tidypics_plus');
if (!$justify_last_row)
{
   $justify_last_row = 'center';
   elgg_set_plugin_setting('justify_last_row',$justify_last_row,'tidypics_plus');
}

$justify_captions = elgg_get_plugin_setting('justify_captions','tidypics_plus');
if (!$justify_captions)
{
   $justify_captions = 'yes';
   elgg_set_plugin_setting('justify_captions',$justify_captions,'tidypics_plus');
}

$justify_caption_anim_time = elgg_get_plugin_setting('justify_caption_anim_time','tidypics_plus');
if (!$justify_caption_anim_time)
{
   $justify_caption_anim_time = '500';
   elgg_set_plugin_setting('justify_caption_anim_time',$justify_caption_anim_time,'tidypics_plus');
}

$justify_caption_opacity_visible = elgg_get_plugin_setting('justify_caption_opacity_visible','tidypics_plus');
if (!$justify_caption_opacity_visible)
{
   $justify_caption_opacity_visible = '0.95';
   elgg_set_plugin_setting('justify_caption_opacity_visible',$justify_caption_opacity_visible,'tidypics_plus');
}

$justify_caption_opacity_invisible = elgg_get_plugin_setting('justify_caption_opacity_invisible','tidypics_plus');
if (!$justify_caption_opacity_invisible)
{
   $justify_caption_opacity_invisible = '0';
   elgg_set_plugin_setting('justify_caption_opacity_invisible',$justify_caption_opacity_invisible,'tidypics_plus');
}

$justify_border = elgg_get_plugin_setting('justify_border','tidypics_plus');
if (!$justify_border)
{
   $justify_border = '-1';
   elgg_set_plugin_setting('justify_border',$justify_border,'tidypics_plus');
}

echo "<h2>";
echo elgg_echo('tidypics_plus:admin:albums');
echo "</h2>";

echo "<label>";
echo elgg_echo('tidypics_plus:admin:masonry') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[album_masonry]',
   'value' => $album_masonry,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));

echo "<h2>";
echo elgg_echo('tidypics_plus:admin:images');
echo "</h2>";

echo "<label>";
echo elgg_echo('tidypics_plus:admin:justified_gallery_list') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justified_gallery_list]',
   'value' => $justified_gallery_list,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));
echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justified_gallery_albums') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justified_gallery_albums]',
   'value' => $justified_gallery_albums,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_margins') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_margins]', 'value'=>$justify_margins));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_rowheight') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_rowheight]', 'value'=>$justify_rowheight));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_max_rowheight') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_max_rowheight]', 'value'=>$justify_max_rowheight));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_fixed_height') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justify_fixed_height]',
   'value' => $v_fixed_height,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_css_animation') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justify_css_animation]',
   'value' => $justify_css_animation,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_wait_thumbs') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justify_wait_thumbs]',
   'value' => $justify_wait_thumbs,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_last_row') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justify_last_row]',
   'value' => $justify_last_row,
   'options_values' => array(
            'justify' => elgg_echo('tidypics_plus:option:justify'),
            'nojustify' => elgg_echo('tidypics_plus:option:nojustify'),
            'hide' => elgg_echo('tidypics_plus:option:hide'),
            'center' => elgg_echo('tidypics_plus:option:center'),
            'right' => elgg_echo('tidypics_plus:option:right'),
   ),
));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_captions') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[justify_captions]',
   'value' => $justify_captions,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_caption_anim_time') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_caption_anim_time]', 'value'=>$justify_caption_anim_time));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_caption_opacity_visible') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_caption_opacity_visible]', 'value'=>$justify_caption_opacity_visible));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_caption_opacity_invisible') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_caption_opacity_invisible]', 'value'=>$justify_caption_opacity_invisible));

echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:justify_border') . ': ';
echo "</label>";

echo elgg_view('input/text', array('name'=>'params[justify_border]', 'value'=>$justify_border));

echo "<h2>";
echo elgg_echo('tidypics_plus:admin:popup');
echo "</h2>";

echo "<label>";
echo elgg_echo('tidypics_plus:admin:use_popup_lists') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[use_popup_lists]',
   'value' => $use_popup_lists,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));
echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:use_popup_river') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[use_popup_river]',
   'value' => $use_popup_river,
   'options_values' => array(
           'no' => elgg_echo('option:no'),
           'yes' => elgg_echo('option:yes'),
   ),
));
echo "<br/><br/>";
echo "<label>";
echo elgg_echo('tidypics_plus:admin:navigation_mode') . ': ';
echo "</label>";

echo elgg_view('input/dropdown', array(
   'name' => 'params[navigation_mode]',
   'value' => $navigation_mode,
   'options_values' => array(
           'arrows' => elgg_echo('tidypics_plus:option:arrows'),
           'slider' => elgg_echo('tidypics_plus:option:slider'),
           'both' => elgg_echo('tidypics_plus:option:both'),
   ),
));

?>
</div>

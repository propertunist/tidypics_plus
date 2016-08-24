<?php

function tidypics_plus_get_JS_params(){
	$data = array();
	$data['justify_margins'] = elgg_get_plugin_setting('justify_margins','tidypics_plus');
	$data['justify_rowheight'] = elgg_get_plugin_setting('justify_rowheight','tidypics_plus');
	$data['justify_max_rowheight'] = elgg_get_plugin_setting('justify_max_rowheight','tidypics_plus');
	$data['justify_fixed_height'] = elgg_get_plugin_setting('justify_fixed_height','tidypics_plus');
	$data['justify_css_animation'] = elgg_get_plugin_setting('justify_css_animation','tidypics_plus');
	$data['justify_wait_thumbs'] = elgg_get_plugin_setting('justify_wait_thumbs','tidypics_plus');
	$data['justify_last_row'] = elgg_get_plugin_setting('justify_last_row','tidypics_plus');
	$data['justify_captions'] = elgg_get_plugin_setting('justify_captions','tidypics_plus');
	$data['justify_caption_anim_time'] = elgg_get_plugin_setting('justify_caption_anim_time','tidypics_plus');
	$data['justify_caption_opacity_visible'] = elgg_get_plugin_setting('justify_caption_opacity_visible','tidypics_plus');
	$data['justify_caption_opacity_invisible'] = elgg_get_plugin_setting('justify_caption_opacity_invisible','tidypics_plus');
	$data['justify_border'] = elgg_get_plugin_setting('justify_border','tidypics_plus');

	if (elgg_is_active_plugin('hypeList'))
		$data['hypelist_active'] = true;
	else
		$data['hypelist_active'] = false;

	foreach ($data as $key => $option)
	{
		if ($option == 'yes')
			$data[$key] = true;
		elseif ($option == 'no')
			$data[$key] = false;
	}

	echo json_encode($data);
}

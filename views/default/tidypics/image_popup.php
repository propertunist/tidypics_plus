<?php
/***********************
 * displays a panel that contains a full size image and allows commenting
 * for use in a lightbox
 ***********************/

 $image_guid = (int) get_input('guid');
 if ($image = get_entity($image_guid))
 {
	 	$album = $image->getContainerEntity();

		$img_src = $image->getIconURL('large');
		$img_src = elgg_format_url($img_src);
		$img = elgg_format_element('div',[
			'class' => 'image_popup_backgrnd',
			'title' => $image->name,
			'style' => 'background-image:url("' . $img_src . '");']
		);
		$img = elgg_view('output/url', array(
			'href' => $image->getURL(),
			'alt' => $image->name,
			'text' => $img,
			'is_trusted' => true
		));
	  $owner_link = elgg_view('output/url', array(
	  	'href' => "photos/owner/" . $image->getOwnerEntity()->username,
	  	'text' => $image->getOwnerEntity()->name,
      'is_trusted' => TRUE,
	  ));

	  $author_text = elgg_echo('byline', array($owner_link));
	  $date = elgg_view_friendly_time($image->time_created);

	  $owner_icon = elgg_view_entity_icon($image->getOwnerEntity(), 'tiny');

	  $metadata = elgg_view_menu('entity', array(
	  	'entity' => $image,
	  	'handler' => 'photos',
	  	'sort_by' => 'priority',
	  	'class' => 'elgg-menu-hz',
	  ));

	  $subtitle = "$author_text $date";
	  if (($categories)||($tags))
	  $footer = "$categories $tags";
	  $params = array(
	  	'entity' => $image,
	  	'title' => $image->title,
	  	'metadata' => $metadata,
	  	'subtitle' => $subtitle,
	  );
	  $list_body = elgg_view('object/elements/summary', $params);

	  $params = array('class' => 'mbl');
	  $summary = elgg_view_image_block($owner_icon, $list_body, $params);

	  $image_block .= '<div class="tidypics-photo-wrapper center">';
	  $image_block .= '<div class="tidypics-photo-block">';

		if (($album->getSize() > 1)&&(!elgg_in_context('pinboard-widget'))) {
			//	$index = ($album->getIndex($image_guid) >= 0) ? $album->getIndex($image_guid) : 0;

			switch (elgg_get_plugin_setting('navigation_mode', 'tidypics_plus')){
				case 'slider':
				{
					if (elgg_is_active_plugin('elgg_slider'))
					{
						// render popdown gallery icon area
						$images = $album->getImages();
						$index = $album->getIndex($image_guid);
						$slides = array();
						$count = 1;
						foreach ($images as $gallery_image)
						{
							$slides[$count] = elgg_view_entity_icon($gallery_image, 'small', array(
								'href' => '#',
								'is_trusted' => TRUE,
								'onClick' => 'navigateImage(' . $image->guid . ', ' . $gallery_image->guid . ');',
								'img_class' => 'tidypics-photo',
								'not_lazy' => true,
							));
							$count++;
						}

						$image_gallery = elgg_view('page/components/slider', array('slides' => $slides,
						// Slick slider settings
						'slick' => array(
								'slidesToShow' => 6,
								'slidesToScroll' => 2,
								'speed' => 400,
								'arrows' => true,
								'dots' => false,
								'autoplay' => false,
								'infinite' => true,
							//	'initialSlide' => $index
							//  'responsive'=> array(array('breakpoint' =>  470,
								//'settings'=> array('slidesToShow' =>  1,
								//'slidesToScroll' => 1)))
						)));
					}
					break;
				}
				case 'arrows':
				{
				  $image_block .= elgg_view('object/image/ajax_navigation', $vars);
					break;
				}
				case 'both':
				default:
				{
					if (elgg_is_active_plugin('elgg_slider'))
					{
						// render popdown gallery icon area
						$images = $album->getImages();
						$index = $album->getIndex($image_guid);
						$slides = array();
						$count = 1;
						foreach ($images as $gallery_image)
						{
							$slides[$count] = elgg_view_entity_icon($gallery_image, 'small', array(
								'href' => '#',
								'is_trusted' => TRUE,
								'onClick' => 'navigateImage(' . $image->guid . ', ' . $gallery_image->guid . ');',
								'img_class' => 'tidypics-photo',
								'not_lazy' => true,
							));
							$count++;
						}

						$image_gallery = elgg_view('page/components/slider', array('slides' => $slides,
						// Slick slider settings
						'slick' => array(
								'slidesToShow' => 6,
								'slidesToScroll' => 2,
								'speed' => 400,
								'arrows' => true,
								'dots' => false,
								'autoplay' => false,
								'infinite' => true,
							//	'initialSlide' => $index
							//  'responsive'=> array(array('breakpoint' =>  470,
								//'settings'=> array('slidesToShow' =>  1,
								//'slidesToScroll' => 1)))
						)));
					}
				  $image_block .= elgg_view('object/image/ajax_navigation', $vars);
					break;
				}
			}
	  }
	  $image_block .= elgg_view('photos/tagging/help', $vars);
	  $image_block .= elgg_view('photos/tagging/select', $vars);
	  $image_block .= $img;
	  $image_block .= elgg_view('photos/tagging/tags', $vars);
		$image_block .= '</div>';
		error_log($image_gallery);
		$image_block .= $image_gallery;
		$image_block .= '</div>';

	  $image_body .= $summary;

	  if ($image->description) {
	  	$image_body .= elgg_view('output/longtext', array(
	  		'value' => $image->description,
	  		'class' => 'mbl scrape-this',
	  	));
	  }

	  if ($footer)
	  {
      $image_block .= "<div class=\"elgg-item-info elgg-object-footer\">$footer</div>";
	  }
    $image_body .= elgg_view_comments($image,true, array(
			'form_position' => 'bottom'
		));

		echo elgg_view_image_block($image_block, $image_body, array(
			'class' => 'image_popup_comment_block'
		));
 }
 else {
 	return false;
 }

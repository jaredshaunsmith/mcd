<?php
function excerpt_please($post_id) {
  global $post;  
  $save_post = $post;
  $post = get_post($post_id);
  $output = get_the_excerpt();
  $post = $save_post;
  return $output;
}

/* Custom ajax loader */
add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
function my_wpcf7_ajax_loader () {
	return  get_template_directory_uri() . '/loading.gif';
}

// wysiwyg edits
function wpa_45815($arr){
    $arr['block_formats'] = 'Main Header=h4; Article Inline Heading=h6';
    return $arr;
  }
add_filter('tiny_mce_before_init', 'wpa_45815');



// caption
add_filter( 'img_caption_shortcode', 'cleaner_caption', 10, 3 );

function cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	if (strpos($content,'alt=""') == false) {
		$alt = substr($content, strpos($content, 'alt="'));
		$m = array();
	
		preg_match('/"([^"]+)"/', $alt, $m);
		$alt = $m[1];
	} else {
		$alt = '';
	}

	

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] )) {
		$output = '<div class="image-caption">';
		$output .= do_shortcode($content);
		$output .= $output .= '<div class="caption-container"><span class="caption-title">'.$alt.'</span></div>';
	} else {

		/* Set up the attributes for the caption <div>. */
		$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
		$attributes .= ' class="image-caption ' . esc_attr( $attr['align'] ) . '"';
		$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

		/* Open the caption <div>. */
		$output = '<div' . $attributes .'>';

		/* Allow shortcodes for the content the caption was created for. */
		$output .= do_shortcode( $content );

		/* Append the caption text. */
		$output .= '<div class="caption-container c-p-plumb"><span class="caption-title">'.$attr['caption'].'</span>';
		$output .= '<span class="caption-small">' . $alt . '</span></div>';

		/* Close the caption </div>. */
		$output .= '</div>';

	}
	/* Return the formatted, clean output. */
	return $output;
}





add_theme_support( 'post-thumbnails' ); 

// add base options page
acf_add_options_page();

//add main menu options page
$menu = array(
	'page_title' => 'Main Menu',
	'menu_title' => 'Main Menu'
	);
acf_add_options_page($menu);

//add contact overlay options page
$cus = array(
	'page_title' => 'Contact Us Overlay',
	'menu_title' => 'Contact Us'
	);
acf_add_options_page($cus);
?>
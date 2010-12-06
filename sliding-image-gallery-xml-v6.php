<?php
/*
Plugin Name: Sliding Image Gallery XML v6
Plugin URI: http://www.flashdo.com/item/sliding-image-gallery-xml-v6/93
Description: Dynamic sliding image gallery for product showcase / banner rotators.
Version: 1.0.0
Author: FlashBlue
Author URI: http://www.flashdo.com/user/flashblue
License: GPL2
*/

/* start global parameters */
	$slidingimagegalleryxmlv6_params = array(
		'count'	=> 0, // number of Sliding Image Gallery XML v6 embeds
	);
/* end global parameters */

/* start client side functions */
	function slidingimagegalleryxmlv6_get_embed_code($slidingimagegalleryxmlv6_attributes) {
		global $slidingimagegalleryxmlv6_params;
		$slidingimagegalleryxmlv6_params['count']++;

		$plugin_dir = get_option('slidingimagegalleryxmlv6_path');
		if ($plugin_dir === false) {
			$plugin_dir = 'flashdo/flashblue/sliding-image-gallery-xml-v6';
		}
		$plugin_dir = trim($plugin_dir, '/');

		$xml_file_name = !empty($slidingimagegalleryxmlv6_attributes[2]) ? $slidingimagegalleryxmlv6_attributes[2] : 'xml/banner.xml';
		$xml_file_path = WP_CONTENT_DIR . "/{$plugin_dir}/{$xml_file_name}";

		if (function_exists('simplexml_load_file')) {
			if (file_exists($xml_file_path)) {
				$data = simplexml_load_file($xml_file_path);
				$width = (int)$data->globals->attributes()->width;
				$height = (int)$data->globals->attributes()->height;
			}
		} elseif ((int)$slidingimagegalleryxmlv6_attributes[4] > 0 && (int)$slidingimagegalleryxmlv6_attributes[6] > 0) {
			$width = (int)$slidingimagegalleryxmlv6_attributes[4];
			$height = (int)$slidingimagegalleryxmlv6_attributes[6];
		} else {
			return '<!-- invalid Sliding Image Gallery XML v6 width and / or height -->';
		}

		$swf_embed = array(
			'width' => $width,
			'height' => $height,
			'text' => isset($slidingimagegalleryxmlv6_attributes[7]) ? trim($slidingimagegalleryxmlv6_attributes[7]) : '',
			'component_path' => WP_CONTENT_URL . "/{$plugin_dir}/",
			'swf_name' => 'banner.swf',
		);
		$swf_embed['swf_path'] = $swf_embed['component_path'].$swf_embed['swf_name'];

		if (!is_feed()) {
			$embed_code = '<div id="slidingimagegalleryxmlv6'.$slidingimagegalleryxmlv6_params['count'].'">'.$swf_embed['text'].'</div>';
			$embed_code .= '<script type="text/javascript">';
			$embed_code .= "swfobject.embedSWF('{$swf_embed['swf_path']}', 'slidingimagegalleryxmlv6{$slidingimagegalleryxmlv6_params['count']}', '{$swf_embed['width']}', '{$swf_embed['height']}', '9.0.0.0', '', {".($xml_file_name != 'xml/banner.xml' ? ", xmlUrl: '{$xml_file_name}'" : '')." }, {base: '{$swf_embed['component_path']}', scale: 'noscale', salign: 'tl', wmode: 'transparent', allowScriptAccess: 'sameDomain', allowFullScreen: true }, {});";
			$embed_code.= '</script>';
		} else {
			$embed_code = '<object width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'">';
			$embed_code .= '<param name="base" value="'.$swf_embed['component_path'].'"></param>';
			$embed_code .= '<param name="movie" value="'.$swf_embed['swf_path'].'"></param>';
			$embed_code .= '<param name="scale" value="noscale"></param>';
			$embed_code .= '<param name="salign" value="tl"></param>';
			$embed_code .= '<param name="wmode" value="transparent"></param>';
			$embed_code .= '<param name="allowScriptAccess" value="sameDomain"></param>';
			$embed_code .= '<param name="allowFullScreen" value="true"></param>';
			$embed_code .= '<param name="sameDomain" value="true"></param>';
			$embed_code .= '<param name="flashvars" value="'.($xml_file_name != 'xml/banner.xml' ? '&xmlUrl='.$xml_file_name : '').'"></param>';
			$embed_code .= '<embed type="application/x-shockwave-flash" width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'" src="'.$swf_embed['swf_path'].'" scale="noscale" salign="tl" wmode="transparent" allowScriptAccess="sameDomain" allowFullScreen="true" flashvars="'.($xml_file_name != 'xml/banner.xml' ? '&xmlUrl='.$xml_file_name : '').'"';
			$embed_code .= '></embed>';
			$embed_code .= '</object>';
		}

		return $embed_code;
	}

	function slidingimagegalleryxmlv6_filter_content($content) {
		return preg_replace_callback('|\[sliding-image-gallery-xml-v6\s*(settings="([^"]+)")?\s*(width="([0-9]+)")?\s*(height="([0-9]+)")?\s*\](.*)\[/sliding-image-gallery-xml-v6\]|i', 'slidingimagegalleryxmlv6_get_embed_code', $content);
	}

	function slidingimagegalleryxmlv6_echo_embed_code($settings_xml_path = '', $div_text = '', $width = 0, $height = 0) {
		echo slidingimagegalleryxmlv6_get_embed_code(array(2 => $settings_xml_path, 7 => $div_text, 4 => $width, 6 => $height));
	}

	function slidingimagegalleryxmlv6_load_swfobject_lib() {
		wp_enqueue_script('swfobject');
	}
/* end client side functions */

/* start admin section functions */
	function slidingimagegalleryxmlv6_admin_menu() {
		add_options_page('Sliding Image Gallery XML v6 Options', 'Sliding Image Gallery XML v6', 'manage_options', 'slidingimagegalleryxmlv6', 'slidingimagegalleryxmlv6_admin_options');
	}

	function slidingimagegalleryxmlv6_admin_options() {
		  if (!current_user_can('manage_options'))  {
	    wp_die(__('You do not have sufficient permissions to access this page.'));
	  }

	  $slidingimagegalleryxmlv6_default_path = get_option('slidingimagegalleryxmlv6_path');
	  if ($slidingimagegalleryxmlv6_default_path === false) {
	  	$slidingimagegalleryxmlv6_default_path = 'flashdo/flashblue/sliding-image-gallery-xml-v6';
	  }
?>

<div class="wrap">
	<h2>Sliding Image Gallery XML v6</h2>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row" style="width: 40em;">SWF and assets path is <?php echo WP_CONTENT_DIR; ?>/</th>
				<td><input type="text" style="width: 25em;" name="slidingimagegalleryxmlv6_path" value="<?php echo $slidingimagegalleryxmlv6_default_path; ?>" /></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="slidingimagegalleryxmlv6_path" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
<?php
	}
/* end admin section functions */

/* start hooks */
	add_filter('the_content', 'slidingimagegalleryxmlv6_filter_content');
	add_action('init', 'slidingimagegalleryxmlv6_load_swfobject_lib');
	add_action('admin_menu', 'slidingimagegalleryxmlv6_admin_menu');
/* end hooks */

?>

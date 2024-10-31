<?php
/*
Plugin Name: Nav Menu Query Meta Box
Plugin URI: http://blog.aizatto.com/nav-menu-query-meta-box
Description: Nav Menu Query Meta Box (NMQMB) allows you to quickly add a post or a taxonomy to your menu by specifying its ID.
Author: Ezwan Aizat Bin Abdullah Faiz
Author URI: http://aizatto.com
Version: 0.1
License: LGPLv2
*/

// No need to load the rest of the plugin
// if we aren't on the nav-menus.php page
if ($pagenow != 'nav-menus.php') {
	return;
}

add_action('admin_init', array('NavMenuQueryMetaBox', 'admin_init'));
wp_enqueue_script('nav-menu-query', WP_PLUGIN_URL . '/nav-menu-query-meta-box/script.js', 'nav-menu', false, true);

class NavMenuQueryMetaBox {
	// We cannot call #add_meta_box yet as it has not been defined,
    // therefore we will call it in the admin_init hook
	function admin_init() {
		add_meta_box('add-by-query', 'Query', array(__CLASS__, 'nav_menu_meta_box'), 'nav-menus', 'side', 'default');
	}

	function nav_menu_meta_box() { ?>
	<div class="query">
			<p>
				<label class="howto" for="post_type_or_taxonomy">
					<span><?php _e('Post Type or Taxonomy'); ?></span>
				</label>
				<select id="post_type_or_taxonomy" name="post_type_or_taxonomy" style="width: 100%">
					<option value="post_type">Post Type</option>
					<option value="taxonomy">Taxonomy</option>
				</select>
			</p>

			<p>
				<label class="howto" for="post_type_or_taxonomy_id">
					<span><?php _e('ID'); ?></span>
					<input id="post_type_or_taxonomy_id" name="post_type_or_taxonomy_id" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e('ID'); ?>" />
				</label>
			</p>

			<p style="display: block; margin: 1em 0; clear: both;">
				<label class="howto" for="post_type_or_taxonomy_title">
					<span><?php _e('Title'); ?></span>
					<input id="post_type_or_taxonomy_title" name="post_type_or_taxonomy_title" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e('Optional'); ?>" />
				</label>
			</p>

		<p class="button-controls">
			<span class="list-controls">
			</span>
			<span class="add-to-menu">
				<img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
				<input type="submit" class="button-secondary" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-custom-menu-item" />
			</span>
		</p>

	</div>
<?php
	}
}

<?php

/**
 * Plugin Name: LR Responsive Slide Menu
 * Plugin URI:  http://www.logicrays.com/
 * Description: Create Simple Responsive Slide Menu For Mobile, Use shortcode [responsiveslidemenu] in header.php
 * Version:     1.0
 * Author:      Logicrays Wordpress Team.
 */
define( 'lr_responsive_slide_menu_path', plugins_url( '', __FILE__ ) );
function responsive_slide_menu_scripts() {
	if (!is_admin()) {
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', true);
		wp_enqueue_script( 'slide-menu-jquery', lr_responsive_slide_menu_path.'/assets/js/slide-menu.js', true);

		wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_style( 'slide-menu', lr_responsive_slide_menu_path.'/assets/css/slide-menu.css' );
		wp_enqueue_style( 'preview-css', lr_responsive_slide_menu_path.'/assets/css/preview.css' );

	}

}

add_action( 'get_footer', 'responsive_slide_menu_scripts' );



add_action( 'admin_enqueue_scripts', 'responsive_slide_menu_backend_scripts');



function responsive_slide_menu_backend_scripts() {

	wp_enqueue_style ( 'wp-color-picker' );

    wp_enqueue_script ( 'wp-color-picker', false, array ( 'jquery' ) );

	wp_enqueue_script( 'color-picker-custom', lr_responsive_slide_menu_path.'/assets/js/color-picker.js', true);

}

 

add_action('admin_menu', 'responsive_slide_menu');

function responsive_slide_menu() {

    add_menu_page('Responsive Slide Menu Settings',

            'Responsive Slide Menu',

            'manage_options',

            'responsiveslidemenu',

            responsiveslidemenu_settings

    );

}

function responsiveslidemenu_settings(){

?>

<div class="wrap">

  <div class="icon32" id="icon-options-general"><br>

  </div>

  <h2>Responsive Slide Menu Options</h2>

  <form action="options.php" method="post">

<?php

settings_fields("section");

?>

<style>

.shortcode {font-size: 16px;}

</style>

<p class="shortcode"><strong>Use Shortcode: [responsiveslidemenu] in header.php</strong></p>

<?php

do_settings_sections("theme-options");

submit_button();

?>

</form>

</div>

<?php

}

function responsiveslidemenu_fields()

{

	add_settings_section("section", "All Settings", null, "theme-options");	

	

	add_settings_field("theme_location", "Theme Location", "rsm_theme_location_element", "theme-options", "section");

	add_settings_field("mobile_width", "Pixel Width to Switch to Slide Menu", "rsm_mobile_width_element", "theme-options", "section");

	add_settings_field("menu_id", "Slide Menu Id", "rsm_menu_id_element", "theme-options", "section");

	add_settings_field("menu_background", "Slide Menu Background", "rsm_menu_background_element", "theme-options", "section");

	add_settings_field("menu_background_hover", "Slide Menu Background Hover", "rsm_menu_background_hover_element", "theme-options", "section");

	add_settings_field("menu_item_color", "Slide Menu Item Color", "rsm_menu_item_color_element", "theme-options", "section");

	add_settings_field("menu_item_color_hover", "Slide Menu Item Color Hover", "rsm_menu_item_color_hover_element", "theme-options", "section");

	

    register_setting("section", "theme_location");

	register_setting("section", "mobile_width");

	register_setting("section", "menu_id");

	register_setting("section", "menu_background");

	register_setting("section", "menu_background_hover");

	register_setting("section", "menu_item_color");

	register_setting("section", "menu_item_color_hover");

}



add_action("admin_init", "responsiveslidemenu_fields");



function rsm_theme_location_element()

{

?>

<input type="text" name="theme_location" id="theme_location" value="<?php echo get_option('theme_location'); ?>" />

<p class="description"><?php _e( 'Please enter Theme Location, Eg. top' ); ?></p>

<?php

}

function rsm_mobile_width_element()

{

?>

<input type="number" name="mobile_width" id="mobile_width" value="<?php echo get_option('mobile_width'); ?>" />

<p class="description"><?php _e( 'Please enter Mobile Width, Eg. 767' ); ?></p>

<?php

}

function rsm_menu_id_element()

{

?>

<input type="text" name="menu_id" id="menu_id" value="<?php echo get_option('menu_id'); ?>" />

<p class="description"><?php _e( 'Please enter Menu Id, Eg. top-menu' ); ?></p>

<?php

}

function rsm_menu_background_element()

{

	$options = get_option('menu_background');

?>

<input type="text" name="menu_background[button_color]" id="menu_background" class="color-field" value="<?php echo esc_attr( $options['button_color'] ); ?>" />

<p class="description"><?php _e( 'Please Select Background.' ); ?></p>

<?php

}

function rsm_menu_background_hover_element()

{

	$options = get_option('menu_background_hover');

?>

<input type="text" name="menu_background_hover[button_color]" id="menu_background_hover" class="color-field" value="<?php echo esc_attr( $options['button_color'] ); ?>" />

<p class="description"><?php _e( 'Please Select Background Hover.' ); ?></p>

<?php

}

function rsm_menu_item_color_element()

{

	$options = get_option('menu_item_color');

?>

<input type="text" name="menu_item_color[button_color]" id="menu_item_color" class="color-field" value="<?php echo esc_attr( $options['button_color'] ); ?>" />

<p class="description"><?php _e( 'Please Select Menu Item Color.' ); ?></p>

<?php

}

function rsm_menu_item_color_hover_element()

{

	$options = get_option('menu_item_color_hover');

?>

<input type="text" name="menu_item_color_hover[button_color]" id="menu_item_color_hover" class="color-field" value="<?php echo esc_attr( $options['button_color'] ); ?>" />

<p class="description"><?php _e( 'Please Select Menu Item Color Hover.' ); ?></p>

<?php

}

function responsiveslidemenu_function($atts, $content = null){

ob_start();

?>

<div class="lrresponsivemenu">

  <div class="btn-list">

    <button type="button" class="btn slide-menu-control" data-target="test-menu-left" data-action="toggle">

    <i class="fa fa-reorder"></i></button>

  </div>

  <div class="slide-menu" id="test-menu-left">

      <div class="controls">

        <button type="button" class="btn slide-menu-control" data-action="close">Close</button>

        <button type="button" class="btn slide-menu-control" data-action="back">Back</button>

      </div>

      <?php 

	  wp_nav_menu( array(

		'theme_location' => get_option('theme_location'),

		'menu_id'        => get_option('menu_id'),

	  ) ); 

	  ?>      

  </div>  

</div>

<script>

jQuery(document).ready(function () {

var menuLeft = jQuery('#test-menu-left').slideMenu({

	              position: 'left',

                  submenuLinkAfter: ' >',

                  backLinkBefore: '< '

     });

});

</script>

<?php

$mobile_width = get_option('mobile_width');

$menu_background = get_option('menu_background');

$bg = $menu_background['button_color'];



$menu_background_hover = get_option('menu_background_hover');

$bg_hover = $menu_background_hover['button_color'];



$menu_item_color = get_option('menu_item_color');

$item = $menu_item_color['button_color'];



$menu_item_color_hover = get_option('menu_item_color_hover');

$item_hover = $menu_item_color_hover['button_color'];



$rs_custom_css = "

@media screen and (max-width: {$mobile_width}px) {

.lrresponsivemenu{display:block;}

.slide-menu ul a{color: $item !important;}

.slide-menu a:hover{background: $bg_hover !important;color: $item_hover !important;}

.slide-menu {background: $bg !important;}";

?>

<style>

.lrresponsivemenu {

 display:none;

}

<?php echo $rs_custom_css; ?>

</style>

<?php

return ob_get_clean();

}

add_shortcode( 'responsiveslidemenu', 'responsiveslidemenu_function' );
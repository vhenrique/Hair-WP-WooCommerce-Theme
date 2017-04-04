<?php
// Theme prefix
	global $themePrefix;
	$themePrefix = "vhs_";

// Define templateurl
	define('TEMPLATEURL', get_template_directory_uri());

// Make theme available for translation
	load_theme_textdomain('lang', TEMPLATEPATH . '/languages');

// Location defaults
	date_default_timezone_set('Brazil/East');
	setlocale(LC_ALL, 'pt_BR');
	define("CHARSET", "utf-8");

// Set content width
	if(!isset($content_width)) $content_width = 640;

// Register navigation menus
	add_theme_support('nav-menus');
	register_nav_menus(array('menu'=>'Menu', 'footer'=>'Rodapé'));

// Register post thumbnail sizes
	add_theme_support('post-thumbnails', array('product', 'page'));
	add_image_size($themePrefix.'featuredProduct', 275, 275, true);
	add_image_size($themePrefix.'singleProduct', 410, 510, false);

// Enqueue scripts
	add_action('wp_enqueue_scripts', 'vhs_enqueue_scripts_and_styles');
	function vhs_enqueue_scripts_and_styles(){
		wp_enqueue_script('layerslider', get_template_directory_uri().'/assets/js/layerslider.js', array('jquery'), '', true);
		wp_enqueue_script('classie', get_template_directory_uri().'/assets/js/classie.js', array('jquery'), '', true);
		wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', array('jquery'), '', true);
		wp_enqueue_script('sticky', get_template_directory_uri().'/assets/js/jquery.sticky.min.js', array('jquery'), '', true);
		wp_enqueue_script('jsplugins', get_template_directory_uri().'/assets/js/jsplugins.js', array('jquery'), '', true);
		wp_enqueue_script('modernizr', get_template_directory_uri().'/assets/js/modernizr.min.js', array('jquery'), '', true);
		wp_enqueue_script('photostack', get_template_directory_uri().'/assets/js/photostack.js', array('jquery'), '', true);
		wp_enqueue_style('responsive', get_template_directory_uri().'/assets/css/responsive.css');
	} 

// Admin extensions
	$extensions_path = TEMPLATEPATH . '/extensions/';
	if(file_exists($extensions_path . 'custom-functions.php')) require_once($extensions_path . 'custom-functions.php');
	if(file_exists($extensions_path . 'custom-wordpress-tweeks.php')) require_once($extensions_path . 'custom-wordpress-tweeks.php');

	// Custom user role
	if(file_exists($extensions_path . 'custom-user-role.php')) require_once($extensions_path . 'custom-user-role.php');

// Custom theme options
	if(!class_exists('ReduxFramework') && file_exists($extensions_path . 'redux/framework.php')) require_once($extensions_path . 'redux/framework.php');
	if(file_exists($extensions_path . 'custom-theme-options.php')) require_once($extensions_path . 'custom-theme-options.php');

// Custom metaboxes
	add_action('init', 'vhs_admin_init');
	function vhs_admin_init(){
		if(file_exists($extensions_path . 'custom-metaboxes/init.php')) require_once($extensions_path . 'custom-metaboxes/init.php');
	}

// Admin footer info
	add_action( 'admin_footer', 'admin_footer' );
	add_filter( 'update_footer', '__return_empty_string', 11 );
	function admin_footer(){
	    echo '<div id="wpfooter" role="contentinfo">';
		echo sprintf('<p id="footer-left" class="alignleft"><span id="footer-thankyou">Theme developped by <a href="%s" title="%s">vhenrique</a>. Thanks for use!</span></p>', 'http://vhenrique.com', 'Vhenrique portfolio.');
		echo sprintf('<p id="footer-upgrade" class="alignright"><a href="%s" title="%s"><img src="%s" width="50px"/></a></p>', 'http://vhenrique.com', 'Vhenrique portfolio.', TEMPLATEURL.'/screenshot.png');
		echo '<div class="clear"></div></div>';
	}	

	add_action( 'after_setup_theme', 'vhs_woocommerce_support' );
	function vhs_woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

?>
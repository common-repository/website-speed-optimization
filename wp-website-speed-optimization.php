<?php
/**
 * Plugin Name: Website Speed Optimization
 * Plugin URI: 	https://wordpress.org/plugins/website-speed-optimization/
 * Description: Website Speed Optimization will help your website speed up page loading. Check your <a href="admin.php?page=wso-setting">WSO</a> page on how to start.
 * Version: 0.1.3
 * Author: TuTM
 * Author URI: tutm.itedu@gmail.com
 * Text Domain: website-speed-optimization
 * Domain Path: /lang
 * License: GPLv2 or later
 */

define('WSO_RESET_ON_ACTIVATE', false); //if true TODO set false
define('WSO_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WSO_PLUGIN_DIR', dirname(__FILE__));
define('WSO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define('WSO_CACHE_DIR', wp_upload_dir()['basedir'] . '/wso-cache');
define('WSO_VERSION', "0.1");
define('WSO_TEXTDOMAIN', "website-speed-optimization");

function websiteSpeedOptimizationInit() {
	/**
	 * Register a custom menu page.
	**/
	function wsoAddMenu() {
	    add_menu_page(
	            __('Website Speed Optimization', WSO_TEXTDOMAIN), /* title plugin */ 'WSO', /* name menu plugin */ 'manage_options', 'wso-setting', /* slug plugin */ 'wso_setting', /* call function view if plugin */ WSO_PLUGIN_URL . '/icon.png', /* icon plugin */ 81 /* position plugin after setting */
	    );
	}
	add_action('admin_menu', 'wsoAddMenu');

	/* add js css admin */
    function wso_add_css_js($hook) {        
        wp_enqueue_style( 'wso_styles', WSO_PLUGIN_URL . '/wso_styles.css' );
        wp_enqueue_script( 'wso_script', WSO_PLUGIN_URL . '/wso_script.js' );
    }
    add_action( 'admin_enqueue_scripts', 'wso_add_css_js', 10 );

	// Add Toolbar Menus
	function wso_admin_toolbar() {
		global $wp_admin_bar;

		$args = array(
			'id'     => 'wso_bar',
			'title'  => '<span class="wso-icon"></span>' . __( 'WSO', 'WSO_TEXTDOMAIN' ),
			'href'   => network_admin_url( 'admin.php?page=wso-setting' ),
		);
		$wp_admin_bar->add_menu( $args );


		if(get_option( 'wso-options' ) !== false){
			$wso_all_options = (get_option( 'wso-options' ));
			if ( ( isset($wso_all_options['wso-o-25']) && $wso_all_options['wso-o-25'] == 'true' ) || ( isset($wso_all_options['wso-o-26']) && $wso_all_options['wso-o-26'] == 'true' ) ) { /* if cache */
				if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ){
					$wso_protocol	=	'https';
				}else{
					$wso_protocol	=	'http';
				}
		    	$wso_protocol = $wso_protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		    	$wso_url_cache = $wso_protocol . '&wso-re-cache=true';
		    	if(strpos($wso_protocol, '?') === false){
		    		$wso_url_cache = $wso_protocol . '?wso-re-cache=true';
		    	}
				$wp_admin_bar->add_menu(array('parent' => 'wso_bar', 'title' => __('Refresh Cache'), 'id' => 'wso-re-cache', 'href' => $wso_url_cache));
			}
		}
	}
	add_action( 'wp_before_admin_bar_render', 'wso_admin_toolbar', 999 );

	/**
	 * Display a custom menu page
	**/
	function wso_setting() {
	    if (is_admin()) {	        
	        require_once dirname(__FILE__) . '/wso_setting.php';
	    }
	}	

	if(get_option( 'wso-options' ) === false){
		add_option( 'wso-options', array( "action" => "wso_options_save", "wso-oprion-active" => "off", "wso-option-oz" => "wso-custom" ));
	}
	$wso_all_options = (get_option( 'wso-options' ));

	if($wso_all_options['wso-oprion-active'] == 'on' ){
		require_once dirname(__FILE__) . '/inc/class-wso.php';
		require_once dirname(__FILE__) . '/inc/class-wso-jsmin.php';
		$WSO = new Website_Speed_Optimization_Func;
	}

	function wso_inject_html()
	{
		if(isset($_GET['page']) && $_GET['page'] == 'wso-setting'){
	    	echo '<div class="wso_update_fix"></div><div class="wso_update"><button>'. __('Save Changes', WSO_TEXTDOMAIN) .'</button></div>';
		}
	}
	add_action( 'admin_notices', 'wso_inject_html', 1 );

	add_action( 'wp_ajax_wso_options_save', 'wso_options_save');
	function wso_options_save(){
		if(is_user_logged_in() && is_admin()){
			if(isset($_POST['wso-oprion-active'])){

				$wso_oprion = 'off';
				if($_POST['wso-oprion-active'] == 'on' || $_POST['wso-oprion-active'] == 'off'){
					$wso_oprion = $_POST['wso-oprion-active'];
				}
				
				$wso_option_oz = 'wso-custom';
				if( isset( $_POST['wso-option-oz'] ) === true && in_array( $_POST['wso-option-oz'], array( 'wso-custom', 'wso-low', 'wso-medium', 'wso-high') ) === true ){
					$wso_option_oz = sanitize_text_field($_POST['wso-option-oz']);
				}
				$wso_data_option = array(
					"action" => "wso_options_save",
					"wso-oprion-active" => $wso_oprion,
					"wso-option-oz" => $wso_option_oz,
				);

				$wso_json = file_get_contents (WSO_PLUGIN_DIR . '/wso-options.json');
				$wso_datas = json_decode($wso_json,true);
				foreach ($wso_datas as $key => $wso_data) {
					$wso_os = $wso_data['option'];
					foreach ($wso_os as $key => $wso_o) {						
						if( isset($_POST[$wso_o['id']]) != NULL && ( $_POST[$wso_o['id']] == 'true' || $_POST[$wso_o['id']] == 'false' || $wso_o['id'] == 'wso-o-27' ) ){
							$wso_data_option[$wso_o['id']] = sanitize_text_field($_POST[$wso_o['id']]);
						}else{
							$wso_data_option[$wso_o['id']] = 'false';
						}
					}
				}

				update_option('wso-options', $wso_data_option);

				if ( ! class_exists( 'Website_Speed_Optimization_Func' ) ) {
					require_once dirname(__FILE__) . '/inc/class-wso.php';
				}
				Website_Speed_Optimization_Func::WSO_Set_Expires_headers();
			}
		}
		exit();
	}

	if(isset($_GET['wso-re-cache'])){
		$WSO_cache = file_get_contents( home_url('/?wso-cache=true') );
	}
}

add_action( 'init',  'websiteSpeedOptimizationInit');
?>
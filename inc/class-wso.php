<?php
	if( !defined( 'ABSPATH' ) ) {
		die;
	}
	

	if ( ! class_exists( 'Website_Speed_Optimization_Func' ) ) {

		class Website_Speed_Optimization_Func {

			public function __construct() {
				$wso_all_options = get_option( 'wso-options' );
				
				if( isset($_GET['wso-cache']) && strval($_GET['wso-cache']) == 'true' ){ /* if cache js css */

					if ( isset($wso_all_options['wso-o-25']) && $wso_all_options['wso-o-25'] == 'true' ) {
						add_action( 'wp_print_styles', array( $this, 'WSO_cache_css' ) ); /* Save all file Css */
					}

					if ( isset($wso_all_options['wso-o-26']) && $wso_all_options['wso-o-26'] == 'true' ) {
						add_action( 'wp_enqueue_scripts', array( $this, 'WSO_cache_js_setup_ini_script'), 9996);
						add_action( 'wp_enqueue_scripts', array( $this, 'WSO_cache_js'), 99999); /* Save all file Js */
					}

				}else{

					/* Function wso-o-01 */
					if($wso_all_options['wso-o-01'] == 'true'){
						add_filter('style_loader_src', array( $this, 'WSO_func_01' ), 9999);
						add_filter('script_loader_src', array( $this, 'WSO_func_01' ), 9999);
					}

					/* Function wso-o-02 */
					if($wso_all_options['wso-o-02'] == 'true'){
						remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
						remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
					}

					/* Function wso-o-03 */
					if($wso_all_options['wso-o-03'] == 'true'){
						remove_action( 'wp_head', 'wp_shortlink_wp_head' );
				    	remove_action( 'template_redirect', 'wp_shortlink_header');
					}

					/* Function wso-o-04 */
					if($wso_all_options['wso-o-04'] == 'true'){
						remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
					}

					/* Function wso-o-05 */
					if($wso_all_options['wso-o-05'] == 'true'){
						remove_action( 'wp_head', 'wlwmanifest_link');
					}

					/* Function wso-o-06 */
					if($wso_all_options['wso-o-06'] == 'true'){
						add_filter('the_generator', array( $this, 'WSO_func_06' ));
					}

					/* Function wso-o-20 */
					if($wso_all_options['wso-o-20'] == 'true'){
						remove_action('wp_head', 'rest_output_link_wp_head', 10);
						remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
						remove_action('template_redirect', 'rest_output_link_header', 11, 0);
					}

					/* Function wso-o-07 */
					if($wso_all_options['wso-o-07'] == 'true'){
						add_filter('pre_ping', array( $this, 'WSO_func_07' ));
					}

					/* Function wso-o-08 */
					if($wso_all_options['wso-o-08'] == 'true'){
						add_filter('wp_enqueue_scripts', array( $this, 'WSO_func_08' ));
					}

					/* Function wso-o-09 */
					if($wso_all_options['wso-o-09'] == 'true'){
						add_action('wp_enqueue_scripts', array( $this, 'WSO_func_09' ));
					}

					/* Function wso-o-10 */
					if ( $wso_all_options['wso-o-10'] == 'true' ) {
						remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
					}

					/* Function wso-o-11 */
					if ( $wso_all_options['wso-o-11'] == 'true' ) {
						remove_action( 'wp_head', 'feed_links', 10 );
						remove_action( 'wp_head', 'feed_links_extra', 10 );					
					}

					/* Function wso-o-21 */
					if ( $wso_all_options['wso-o-21'] == 'true' ) {
						add_filter('xmlrpc_enabled', '__return_false');
					}

					
					if ( isset($wso_all_options['wso-o-25']) && $wso_all_options['wso-o-25'] != 'true' ) { /* if cache css active */
						/* Function wso-o-14 */
						if ( $wso_all_options['wso-o-14'] == 'true' && $wso_all_options['wso-o-13'] == 'false' ) {
							add_action( 'wp_print_styles', array( $this, 'WSO_insert_css_inline' ) );
						}

						/* Function wso-o-16 */
						if ( $wso_all_options['wso-o-16'] == 'true' && $wso_all_options['wso-o-13'] == 'false' ) {
							add_action( 'wp_footer', array( $this, 'WSO_insert_css_inline_footer' ) );
						}
					}										

					if ( isset($wso_all_options['wso-o-26']) && $wso_all_options['wso-o-26'] != 'true' ) { /* if cache js active */
						/* Function wso-o-19 */
						if ( $wso_all_options['wso-o-19'] == 'true' && $wso_all_options['wso-o-13'] == 'false') {
							add_action( 'wp_enqueue_scripts', array( $this, 'WSO_setup_ini_script'), 9997);							

							if($wso_all_options['wso-o-17'] == 'true'){
								add_action( 'wp_enqueue_scripts', array( $this, 'WSO_insert_js_footer' ), 9998);
								add_action( 'wp_enqueue_scripts', array( $this, 'WSO_remove_all_js' ), 9999);						
							}else{
								add_filter( 'script_loader_tag', array( $this, 'WSO_add_defer_async' ), 20, 3 );
							}
						}
					}

					/* Function wso-o-13 */
					if ( $wso_all_options['wso-o-13'] == 'true') {
						if ( isset($wso_all_options['wso-o-25']) && $wso_all_options['wso-o-25'] != 'true' ) { /* if cache css active */
							if ( $wso_all_options['wso-o-14'] == 'true') {
								add_action( 'wp_print_styles', array( $this, 'WSO_insert_css_inline' ) );
							}
							if ( $wso_all_options['wso-o-16'] == 'true') {
								add_action( 'wp_footer', array( $this, 'WSO_insert_css_inline_footer' ) );
							}
						}
						if ( isset($wso_all_options['wso-o-26']) && $wso_all_options['wso-o-26'] != 'true' ) { /* if cache js active */
							if ( $wso_all_options['wso-o-19'] == 'true' ) {
								add_action( 'wp_enqueue_scripts', array( $this, 'WSO_setup_ini_script'), 9997);

								if($wso_all_options['wso-o-17'] == 'true'){
									add_action( 'wp_enqueue_scripts', array( $this, 'WSO_insert_js_footer' ), 9998);
								}
							}
						}
						
						add_action('get_header', array( $this, 'WSO_html_begin' ) );
					}

					if ( isset($wso_all_options['wso-o-25']) && $wso_all_options['wso-o-25'] == 'true' ) { /* if cache css active */
						add_action( 'wp_print_styles', array( $this, 'WSO_cache_css_insert_footer' ) );
                    	add_action( 'wp_print_styles', array( $this, 'WSO_remove_all_styles' ) );
					}

					if ( isset($wso_all_options['wso-o-26']) && $wso_all_options['wso-o-26'] == 'true' ) { /* if cache js active */
						add_action( 'wp_footer', array( $this, 'WSO_cache_js_insert_footer' ), 9998 );
                    	add_action( 'wp_enqueue_scripts', array( $this, 'WSO_remove_all_js' ), 9999 );
                    	add_filter( 'script_loader_tag', array( $this, 'WSO_add_defer_async' ), 20, 3 );
					}

				}

				if ( isset($wso_all_options['wso-o-19']) && $wso_all_options['wso-o-19'] == 'true' ) {
					add_action( 'wp_head', array( $this, 'WSO_insert_core_js' ), 1 );

				}

			}	// END function __construct

			/* =================================== */
			/* =================================== */
			/* 		    Function action      		*/
			/* =================================== */
			/* =================================== */
			function WSO_insert_css_inline(){
				$wso_all_options = get_option( 'wso-options' );
				$WSO_all_styles = $this->WSO_get_all_styles();
				$WSO_css_minify = false;
				if($wso_all_options['wso-o-15'] == 'true' && $wso_all_options['wso-o-13'] == 'false'){
					$WSO_css_minify = true;
				}
				global $WSO_all_css;
				foreach ( $WSO_all_styles as $style ) {
					$WSO_all_css .= "<style type=\"text/css\" " . ( $style['media'] ? "media=\"{$style['media']}\"" : '' ) . ">";
					$WSO_all_css .= $this->WSO_inline_css( $style['src'], $WSO_css_minify );
					$WSO_all_css .= "</style>";						
				}
				if($wso_all_options['wso-o-16'] == 'false' || ($wso_all_options['wso-o-13'] == 'true' && $wso_all_options['wso-o-16'] == 'true') ){ /* If no move css to footer */
					echo $WSO_all_css;
					$WSO_all_css = "";
				}
				$this->WSO_remove_all_styles();
			}	//	END function WSO_insert_css_inline

			function WSO_insert_css_inline_footer(){
				global $WSO_all_css;
				echo $WSO_all_css;
			}	//	END function WSO_insert_css_inline_footer

			function WSO_remove_core_js(){
				$wso_all_options = get_option( 'wso-options' );
				global $wp_scripts;

				if ( isset( $wp_scripts->queue ) && is_array( $wp_scripts->queue ) ) {
					foreach ( $wp_scripts->queue as $scripts ) {
						if($scripts == "jquery" || $scripts == "jquery-core"){
							wp_deregister_script( $scripts );
							wp_dequeue_script( $scripts );
						}
					}
				}				
			}

			function WSO_move_js_footer(){
				$WSO_all_scripts = $this->WSO_get_all_js();
				$wso_all_options = get_option( 'wso-options' );

				global $WSO_all_js;
				$WSO_all_js = $WSO_all_scripts;				

				foreach ( $WSO_all_scripts as $scripts ) {
					wp_deregister_script( $scripts['handle'] );
					wp_dequeue_script( $scripts['handle'] );
				}

				wp_deregister_script('wp-embed');
				if($wso_all_options['wso-o-17'] == 'false'){
					foreach ( $WSO_all_js as $scripts ) {						

						$url = $scripts['src'];
						$base_url = get_bloginfo( 'wpurl' );
						if ( $url[0] == '/' && $url[1] != '/' ) {							
							$url  = $base_url . $url;
						}

						wp_enqueue_script( $scripts['handle'], $url, array(), '', true );
						if($scripts['data'] != ''){							
							wp_add_inline_script($scripts['handle'], $scripts['data'], 'before');							
						}							
					}					
				}
			}	//	END WSO_move_js_footer

			function WSO_insert_js_footer($handle){
				global $WSO_all_js;
				$wso_all_options = get_option( 'wso-options' );				
					
				$WSO_js_minify = false;
				if($wso_all_options['wso-o-18'] == 'true' && $wso_all_options['wso-o-13'] == 'false'){
					$WSO_js_minify = true;
				}

				foreach ( $WSO_all_js as $scripts ) {
					if($scripts['data'] != ''){
						wp_add_inline_script( 'wso-jquery-core', $scripts['data'], 'after' );
					}
					wp_add_inline_script( 'wso-jquery-core', $this->WSO_inline_script($scripts['src'], $WSO_js_minify) );
						
				}
			}	//	END function WSO_insert_css_inline_footer

			function WSO_add_defer_async( $tag, $handle, $src ) {
			    global $WSO_all_js;			   
			    if( count($WSO_all_js) <= 0 ){
			    	$WSO_all_js = $this->WSO_get_all_js();
			    }

			    foreach ( $WSO_all_js as $scripts ) {			    	
			    	if( false !== strpos( strtolower( $src ), strtolower( $scripts['src'] ) ) && $handle != "wso-jquery-core"){			    					    		
			    		$tag = '<script src="' . $src . '" defer type="text/javascript"></script>' . "\n";
			    		if($scripts['data'] != ""){
			    			$tag = '<script type="text/javascript" charset="utf-8" defer>'. $scripts['data'] .'</script>' . "\n" . $tag;
			    		}
			    	}
				}
				if( $handle == "wso-jquery-core"){
	    			$tag = '<script src="' . $src . '" async type="text/javascript"></script>' . "\n";
	    		}
			    return $tag;
			}

			function WSO_remove_all_js() {
				global $WSO_all_js;
				if( count($WSO_all_js) <= 0 ){
			    	$WSO_all_js = $this->WSO_get_all_js();
			    }

				foreach ( $WSO_all_js as $scripts ) {
					if( $scripts['handle'] != 'wso-jquery-core' ){
						wp_deregister_script( $scripts['handle'] );
						wp_dequeue_script( $scripts['handle'] );
					}
				}
			}

			function WSO_setup_ini_script() {
				global $wp_scripts;				

		 		if ( isset( $wp_scripts->queue ) && is_array( $wp_scripts->queue ) ) {
					foreach ( $wp_scripts->queue as $scripts ) {						
						if(count($wp_scripts->registered[ $scripts ]->deps) > 0){
							foreach ($wp_scripts->registered[ $scripts ]->deps as $deps) {
								wp_enqueue_script( $deps, '', array(), '', false );
							}
						}
					}
				}				

				$this->WSO_remove_core_js();

				$this->WSO_move_js_footer();
			}	//	END function WSO_setup_ini_script

			/* =================================== */
			/* =================================== */
			/* 		    Function handling   		*/
			/* =================================== */
			/* =================================== */
			function WSO_get_all_styles() {
				global $wp_styles;
				$list = array();				
				$exclude = array( 'admin-bar','dashicons' );/* Not access css */

				if ( isset( $wp_styles->queue ) && is_array( $wp_styles->queue ) ) {
					foreach ( $wp_styles->queue as $style ) {						
						if( in_array($style, $exclude) === false && $this->WSO_is_css_file( $wp_styles->registered[ $style ]->src) === true){
							$list[] = array(
								'handle' => $style,
								'src'   => $wp_styles->registered[ $style ]->src,
								'media' => $wp_styles->registered[ $style ]->args,
							);
						}
					}
				}
				return $list;
			}    //	END function WSO_get_all_styles

			function WSO_remove_all_styles() {
				$WSO_all_styles = $this->WSO_get_all_styles();
				foreach ( $WSO_all_styles as $style ) {	
					if($this->WSO_is_css_file( $style['src'] ) === true){
						wp_dequeue_style( $style['handle'] );
						wp_deregister_style( $style['handle'] );
					}
				}				
			}    //	END function WSO_remove_all_styles

			function WSO_inline_css( $url, $minify = true ) {

				$base_url = get_bloginfo( 'wpurl' );
				$path     = false;
				if ( strpos( $url, $base_url ) !== false ) {
					$path = str_replace( $base_url, rtrim( ABSPATH, '/' ), $url );
				} elseif ( $url[0] == '/' && $url[1] != '/' ) {
					$path = rtrim( ABSPATH, '/' ) . $url;
					$url  = $base_url . $url;
				}
				if ( $path && file_exists( $path ) ) {
					$css = file_get_contents( $path );
					if ( $minify ) {
						$css = $this->WSO_minify_css( $css );
					}
					$css = $this->WSO_replace_url_on_css( $css, $url );
					return $css;
				} else {
					return false;
				}

			}   //	END function WSO_inline_css

			function WSO_minify_css( $css ) {
				// remove comments
				$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
				$css = str_replace( array( "\t", "\n", "\r" ), ' ', $css );
				$css = preg_replace('/(  \b)|( \s+)/', ' ', $css);
				$css = str_replace( array( ' {', '{ ' ), '{', $css );
				$css = str_replace( array( ' }', '} ', ';}' ), '}', $css );
				$css = str_replace( array(': ', ' :'), ':', $css );
				$css = str_replace( array('; ', ' ;'), ';', $css );
				$css = str_replace( array(', ', ' ,'), ',', $css );

				return $css;
			}   //	END function WSO_minify_css

			function WSO_replace_url_on_css( $css, $url ) {
				$css_dir = substr( $url, 0, strrpos( $url, '/' ) );
				$css = preg_replace( "/url(?!\(['\"]?(data:|http:))\(['\"]?([^\/][^'\"\)]*)['\"]?\)/i", "url({$css_dir}/$2)", $css );
				return $css;
			}    //	END function WSO_replace_url_on_css

			function WSO_is_css_file( $file ) {
				if(strpos( $file, '.css' ) !== false){
					return true;
				}else{
					return false;
				}				
			}   //	END function WSO_is_css_file

			/* JS */
			function WSO_get_all_js() {
				global $wp_scripts;
				$list = array();				
				$exclude = array( 'admin-bar','dashicons');/* Not access js */

				$wso_all_options = get_option( 'wso-options' );				
				if($wso_all_options['wso-o-19'] === 'false'){
					$exclude[] = 'jquery';
					$exclude[] = 'jquery-core';
				}
				$exclude[] = 'wso-jquery-core';

				if ( isset( $wp_scripts->queue ) && is_array( $wp_scripts->queue ) ) {
					foreach ( $wp_scripts->queue as $scripts ) {
						if($wso_all_options['wso-o-19'] === 'true' && ( $scripts == "jquery" || $scripts == "jquery-core") ){
							/* no action */							
						}else if( in_array($scripts, $exclude) === false){							
							if($wp_scripts->registered[ $scripts ]->args != ""){
								$wso_data = "";
								if(isset($wp_scripts->registered[ $scripts ]->extra['data'])){
									$wso_data = $wp_scripts->registered[ $scripts ]->extra['data'];
								}

								$a = array(array(
									'handle' 	=> $scripts,
									'src'   	=> $wp_scripts->registered[ $scripts ]->src,
									'deps'		=> $wp_scripts->registered[ $scripts ]->deps,
									'data' 		=> $wso_data,
								));
								array_splice($list, 0, 0, $a);
							}else{
								$wso_data = "";
								if(isset($wp_scripts->registered[ $scripts ]->extra['data'])){
									$wso_data = $wp_scripts->registered[ $scripts ]->extra['data'];
								}

								$list[] = array(
									'handle' 	=> $scripts,
									'src'   	=> $wp_scripts->registered[ $scripts ]->src,
									'deps'		=> $wp_scripts->registered[ $scripts ]->deps,
									'data' 		=> $wso_data,
								);
							}
						}						
					}
				}
				return $list;
			}    //	END function WSO_get_all_styles

			function WSO_inline_script( $url, $minify = false ) {
				
				$base_url = get_bloginfo( 'wpurl' );
				$path     = false;
				if ( strpos( $url, $base_url ) !== false ) {
					$path = str_replace( $base_url, rtrim( ABSPATH, '/' ), $url );
				} elseif ( $url[0] == '/' && $url[1] != '/' ) {
					$path = rtrim( ABSPATH, '/' ) . $url;
					$url  = $base_url . $url;
				}
				if ( $path && file_exists( $path ) ) {
					$js = file_get_contents( $path );
					if ( $minify ) {
						$js = WSO_JSMin::minify( $js );
					}					
					return $js;				
				} else {
					return false;
				}

			}   //	END function WSO_inline_script

			/* HTML */
			function WSO_minifyHTML($html) {
        		$wso_all_options = get_option( 'wso-options' );

        		if ( isset($wso_all_options['wso-o-25']) && $wso_all_options['wso-o-25'] != 'true' && isset($wso_all_options['wso-o-26']) && $wso_all_options['wso-o-26'] != 'true' ) { /* if cache css and js not active */

			        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
			        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
			        $html = '';
			        $css = '';	       
			        
			        foreach ($matches as $token) {
			            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			            $content = $token[0];
			            $raw_html = "";
			            if(!empty($token['script'])){		            	
			            	$raw_html .= WSO_JSMin::minify($content);
			            }else if(!empty($token['style'])){
			            	if ( $wso_all_options['wso-o-16'] == 'true' ) {
			                	$css .= $this->WSO_minify_css($content);
			                }else{
			                	$raw_html .= $this->WSO_minify_css($content);
			                }
			            }else{
			                $raw_html .= $content;
			            }
			            $html .= $raw_html;
			        }
			        $html .=  $css;
			    }



		        /* remove all comments html */
		     	$html = str_replace(array( "\t", "\n", "\r" ), ' ', $html);
		     	$html = preg_replace('/(  \b)|( \s+)/', ' ', $html);
		        
		        $html = str_replace(array( '" />' ), '"/>', $html);
		        $html = str_replace(array( '" >' ), '">', $html);

		        $html = preg_replace('/(\>\s\<)/', '><', $html);		        
		        $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);
		        return $html;
		    }

		    function WSO_html_end($html){		    	
		        return $this->WSO_minifyHTML($html);
		    }

		    function WSO_html_begin(){
		    	ob_start(array($this, 'WSO_html_end'));
		    }

			/* Function wso-o-01 */
			function WSO_func_01($src) {
			    if (strpos($src, 'ver='))
			        $src = remove_query_arg('ver', $src);
			    return $src;
			}

			/* Function wso-o-06 */
			function WSO_func_06($src) {
			     return '';
			}

			/* Function wso-o-07 */
			function WSO_func_07( &$links ) {
			  	foreach ( $links as $l => $link ){
			        if ( 0 === strpos( $link, get_option( 'home' ) ) ){
			            unset($links[$l]);
			        }
			  	}
			}

			/* Function wso-o-08 */
			function WSO_func_08($scripts) {
			    global $wp_scripts;
		 		/* Remove migrate */
		 		if(isset($wp_scripts->registered['jquery'])){
			 		$script = $wp_scripts->registered['jquery'];
			 		if ( $script->deps) {
			 			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			 		}
		 		}
			}

			/* Function wso-o-09 */
			function WSO_func_09() { 			   
			   	if ( ! is_user_logged_in() ) {
					wp_dequeue_style( 'dashicons' );
					wp_deregister_style( 'dashicons' );
				}
			}

			function WSO_Set_Expires_headers(){
				$wso_all_options = get_option( 'wso-options' );
				$wso_headers = array();
				if($wso_all_options['wso-o-22'] == 'true'){
					$wso_headers[] = "";
					$wso_headers[] = '# CSS';
					$wso_headers[] = 'ExpiresByType text/css "access plus 1 month"';
				}

				if($wso_all_options['wso-o-23'] == 'true'){
					$wso_headers[] = "";
					$wso_headers[] = '# JavaScript';
					$wso_headers[] = 'ExpiresByType text/javascript "access plus 1 month"';
					$wso_headers[] = 'ExpiresByType application/javascript "access plus 1 month"';
				}

				if($wso_all_options['wso-o-24'] == 'true'){
					$wso_headers[] = "";
					$wso_headers[] = '# Images';
					$wso_headers[] = 'ExpiresByType image/jpeg "access plus 1 year"';
					$wso_headers[] = 'ExpiresByType image/gif "access plus 1 year"';
					$wso_headers[] = 'ExpiresByType image/png "access plus 1 year"';
					$wso_headers[] = 'ExpiresByType image/webp "access plus 1 year"';
					$wso_headers[] = 'ExpiresByType image/svg+xml "access plus 1 year"';
					$wso_headers[] = 'ExpiresByType image/x-icon "access plus 1 year"';

					$wso_headers[] = "";
					$wso_headers[] = '# Video';
					$wso_headers[] = 'ExpiresByType video/mp4 "access plus 1 year"';
					$wso_headers[] = 'ExpiresByType video/mpeg "access plus 1 year"';

					$wso_headers[] = "";
					$wso_headers[] = '# Others';
					$wso_headers[] = 'ExpiresByType application/pdf "access plus 1 month"';
					$wso_headers[] = 'ExpiresByType application/x-shockwave-flash "access plus 1 month"';
				}


				if(count($wso_headers) > 0){
					$url_htaccess = get_home_path() . '.htaccess';
					$wso_json = file_get_contents($url_htaccess);
					$wso_json .= "";

					$wso_w = false;					
				  	if(strpos($wso_json, '# BEGIN WSO Set Expires headers') !== false){
				  		$wso_w = true;
				  	}

					if($wso_w === true){
						$wso_b = strpos($wso_json, "\n\n# BEGIN WSO Set Expires headers");
						$wso_e = strpos($wso_json, '# END WSO Set Expires headers') + strlen('# END WSO Set Expires headers');
						$wso_a = str_split($wso_json, $wso_b);
						$wso_c = str_split($wso_json, $wso_e);

						$wso_my_file = fopen($url_htaccess, "w");
						fwrite($wso_my_file, preg_replace('/\n$/','',$wso_a[0]));
						fwrite($wso_my_file, "\n" . $wso_c[1]);
					}else{
						$wso_my_file = fopen($url_htaccess, "a+");
					}

						fwrite($wso_my_file, "\n\n# BEGIN WSO Set Expires headers");
						fwrite($wso_my_file, "\n<IfModule mod_expires.c>");
						fwrite($wso_my_file, "\nExpiresActive On");
						foreach ($wso_headers as $wso_header) {
							fwrite($wso_my_file, "\n" . $wso_header);
						}
						fwrite($wso_my_file, "\n</IfModule>");
						fwrite($wso_my_file, "\n# END WSO Set Expires headers");					

					fclose($wso_my_file);
				}else{
					$url_htaccess = ABSPATH . '/.htaccess';
					$wso_json = file_get_contents($url_htaccess);
					$wso_json .= "";

					$wso_w = false;					
				  	if(strpos($wso_json, '# BEGIN WSO Set Expires headers') !== false){
				  		$wso_w = true;
				  	}

					if($wso_w === true){
						$wso_b = strpos($wso_json, "\n\n# BEGIN WSO Set Expires headers");
						$wso_e = strpos($wso_json, '# END WSO Set Expires headers') + strlen('# END WSO Set Expires headers');
						$wso_a = str_split($wso_json, $wso_b);
						$wso_c = str_split($wso_json, $wso_e);

						$wso_my_file = fopen($url_htaccess, "w");
						fwrite($wso_my_file, preg_replace('/\n$/','',$wso_a[0]));
						fwrite($wso_my_file, "\n" . $wso_c[1]);
					}

					fclose($wso_my_file);
				}
			}

			function wso_url_jquery(){
				$wso_all_options = get_option( 'wso-options' );
				if( isset($wso_all_options['wso-o-27']) && $wso_all_options['wso-o-27'] != "" && $wso_all_options['wso-o-27'] != "false"){
					return $wso_all_options['wso-o-27'];
				}else{
					return includes_url( '/js/jquery/jquery.js' );
				}
			}

			function WSO_insert_core_js(){
				echo '<script type="text/javascript" charset="utf-8" defer>' . $this->WSO_inline_script($this->wso_url_jquery(), true) . '</script>';
			}

			/* ================= */
			/* FUNC CACHE CSS JS */
			/* ================= */

			/* Save all file Css */
			function WSO_cache_css(){
                $WSO_all_styles = $this->WSO_get_all_styles();

                if(!file_exists(WSO_CACHE_DIR)){
                	wp_mkdir_p(WSO_CACHE_DIR);
                }

                $wso_cache_css_url = WSO_CACHE_DIR . '/wso_cache_css.wso';                

                $wso_my_file = fopen($wso_cache_css_url, "w");
                foreach ( $WSO_all_styles as $style ) {
                    fwrite( $wso_my_file, $this->WSO_inline_css( $style['src'], true ) . "\n" );
                }
                fclose($wso_my_file);
            }

            /* Save all file Css */
            function WSO_cache_js_setup_ini_script(){
                global $wp_scripts;

                if ( isset( $wp_scripts->queue ) && is_array( $wp_scripts->queue ) ) {
                    foreach ( $wp_scripts->queue as $scripts ) {                        
                        if(count($wp_scripts->registered[ $scripts ]->deps) > 0){
                            foreach ($wp_scripts->registered[ $scripts ]->deps as $deps) {
                                wp_enqueue_script( $deps, '', array(), '', false );
                            }
                        }
                    }
                }
            }
            function WSO_cache_js(){

                $WSO_all_js = $this->WSO_get_all_js();

                if(!file_exists(WSO_CACHE_DIR)){
                	wp_mkdir_p(WSO_CACHE_DIR);
                }

                $wso_cache_js_url = WSO_CACHE_DIR . '/wso_cache_js.wso';
                $wso_my_file = fopen($wso_cache_js_url, "w");
                foreach ( $WSO_all_js as $scripts ) {
                    if($scripts['data'] != ''){                         	
                        fwrite( $wso_my_file, '<script type="text/javascript" charset="utf-8" defer>' . $scripts['data'] . '</script>');
                    }
                    fwrite( $wso_my_file, '<script type="text/javascript" charset="utf-8" defer>' . $this->WSO_inline_script($scripts['src'], true) . '</script>' );
                }
                fclose($wso_my_file);

            }
            function WSO_cache_css_insert_footer(){

                $wso_cache_css_url = WSO_CACHE_DIR . '/wso_cache_css.wso';
                if(file_exists($wso_cache_css_url)){

                	$wso_my_file = fopen($wso_cache_css_url, "r");                
	                while(!feof($wso_my_file)) {
	                    $wso_line = fgets($wso_my_file);
	                    $wso_line_check = str_replace( array( "\t", "\n", "\r" ), '', $wso_line );
	                    if($wso_line_check != ""){
	                        echo '<style alt="wso-cache">'. $wso_line .'</style>';
	                    }
	                }

            	}

            }
            function WSO_cache_js_insert_footer(){

                $wso_cache_js_url = WSO_CACHE_DIR . '/wso_cache_js.wso';                
                if(file_exists($wso_cache_js_url)){
                	
                	$wso_my_file = fopen($wso_cache_js_url, "r");
	                while(!feof($wso_my_file)) {

	                    $wso_line = fgets($wso_my_file);
	                    $wso_line_check = str_replace( array( "\t", "\n", "\r" ), '', $wso_line );
	                    if($wso_line_check != ""){
	                        echo $wso_line; 
	                    }
	                }
	            }
                
            }
		}
	}
?>
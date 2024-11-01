<?php $wso_all_options = get_option( 'wso-options' ); ?>
<div class="wrap wso-wrap" id="wso">
	<div class="wso-container-flush">
		<div class="wso-row">
			<div class="wso-col-12">
				<h1 class="wso-title"><img src="<?php echo WSO_PLUGIN_URL; ?>icon.png" alt="Website Speed Optimization"> Website Speed Optimization</h1>
				<div class="wso-box">
					<div class="wso-title-box"><?php _e('Setting', WSO_TEXTDOMAIN); ?></div>
					<div class="wso-content-box">
						<ul class="wso-active-plugin">
							<li><?php _e('Activate Website Speed Optimization', WSO_TEXTDOMAIN); ?></li>
							<li>
								<div class="wso-enabled">									
									<input id="wso-radio-disabled" type="radio" name="first-switch" <?php if($wso_all_options['wso-oprion-active'] == 'off' || $wso_all_options['wso-oprion-active'] == NULL){ echo 'checked="checked"'; } ?> value="off">
									<label for="wso-radio-disabled"><?php _e('Disabled', WSO_TEXTDOMAIN); ?></label>
									<input id="wso-radio-enabled" type="radio" name="first-switch" <?php if($wso_all_options['wso-oprion-active'] == 'on'){ echo 'checked="checked"'; } ?> value="on">
									<label for="wso-radio-enabled"><?php _e('Enabled', WSO_TEXTDOMAIN); ?></label>
									<span class="toggle-outside"><span class="toggle-inside"></span></span>
								</div>	
							</li>
						</ul>
					</div>
				</div>
				<div class="wso-box">	
					<div class="wso-title-box"><?php _e('Basic Options', WSO_TEXTDOMAIN); ?></div>
					<div class="wso-content-box">						
						<div class="wso-row">							
							<div class="wso-col-4">
								<ul class="wso-options <?php if($wso_all_options['wso-option-oz'] == 'wso-low'){ echo 'active'; } ?>" data-level="1">
									<li>
										<input type="radio" name="wso-options" value="wso-low" id="wso-low" <?php if($wso_all_options['wso-option-oz'] == 'wso-low'){ echo 'checked="checked"'; } ?>><label for="wso-low"><?php _e('Low', WSO_TEXTDOMAIN); ?></label>
									</li>
									<li><?php _e('Optimize the website at a low level, the page loading speed is not much improved.', WSO_TEXTDOMAIN); ?></li>
								</ul>
							</div>
							<div class="wso-col-4">
								<ul class="wso-options <?php if($wso_all_options['wso-option-oz'] == 'wso-medium'){ echo 'active'; } ?>" data-level="2">
									<li>
										<input type="radio" name="wso-options" value="wso-medium" id="wso-medium" <?php if($wso_all_options['wso-option-oz'] == 'wso-medium'){ echo 'checked="checked"'; } ?>><label for="wso-medium"><?php _e('Medium', WSO_TEXTDOMAIN); ?></label>
									</li>
									<li><?php _e('Optimizing the website at an average level, the page loading speed is significantly improved.', WSO_TEXTDOMAIN); ?></li>
								</ul>
							</div>
							<div class="wso-col-4">
								<ul class="wso-options <?php if($wso_all_options['wso-option-oz'] == 'wso-high'){ echo 'active'; } ?>" data-level="3">
									<li>
										<input type="radio" name="wso-options" value="wso-high" id="wso-high" <?php if($wso_all_options['wso-option-oz'] == 'wso-high'){ echo 'checked="checked"'; } ?>><label for="wso-high"><?php _e('High', WSO_TEXTDOMAIN); ?></label>
									</li>
									<li><?php _e('Website optimization is at a high level, the page loading speed is pushed to the highest. An error may occur, please be careful.', WSO_TEXTDOMAIN); ?></li>
								</ul>
							</div>
							<div class="wso-col-4">
								<ul class="wso-options <?php if($wso_all_options['wso-option-oz'] == 'wso-custom'){ echo 'active'; } ?>" data-level="0">
									<li>
										<input type="radio" name="wso-options" value="wso-custom" id="wso-custom" <?php if($wso_all_options['wso-option-oz'] == 'wso-custom'){ echo 'checked="checked"'; } ?>><label for="wso-custom"><?php _e('Custom', WSO_TEXTDOMAIN); ?></label>
									</li>
									<li><?php _e('At this level, you can install arbitrary functions.', WSO_TEXTDOMAIN); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="wso-box">	
					<!-- <div class="wso-title-box">Setting</div> -->
					<div class="wso-content-box">
						<?php
							$wso_json = file_get_contents (WSO_PLUGIN_DIR . '/wso-options.json');
							$wso_datas = json_decode($wso_json,true); 
							foreach ($wso_datas as $key => $wso_data) {
								echo '<h3>'. __($wso_data['title'], WSO_TEXTDOMAIN) .'</h3>';
								$wso_os = $wso_data['option'];
								echo '<ul class="wso_setting">';
								foreach ($wso_os as $key => $wso_o) {
									if($wso_o['type'] == 'checkbox'){

										$wso_check = '';
										if(isset($wso_all_options[$wso_o['id']]) != NULL && $wso_all_options[$wso_o['id']] == 'true'){ 
											$wso_check = 'checked="checked"';
										}
										echo '<li><input type="checkbox" name="'. $wso_o['id'] .'" id="'. $wso_o['id'] .'" '. $wso_check .' data-level="'. $wso_o['level'] .'"><label for="'. $wso_o['id'] .'">'. __($wso_o['name'], WSO_TEXTDOMAIN) .'</label><a href="'. $wso_o['faq'] .'" class="wso_faq" target="_blank"><i class="dashicons dashicons-editor-help"></i></a></li>';

									}else if($wso_o['type'] == 'textbox'){

										$wso_text = '';
										if(isset($wso_all_options[$wso_o['id']]) != NULL){ 
											$wso_text = $wso_all_options[$wso_o['id']];
										}
										echo '<li><label for="'. $wso_o['id'] .'">'. __($wso_o['name'], WSO_TEXTDOMAIN) .'</label><input type="text" name="'. $wso_o['id'] .'" value="'. $wso_text .'" placeholder="'. __($wso_o['name'], WSO_TEXTDOMAIN) .'" id="'. $wso_o['id'] .'"/></li>';

									}
								}
								if($wso_data['note'] != ""){
									echo '<li class="wso_note">'. __($wso_data['note'], WSO_TEXTDOMAIN) .'</li>';
								}
								echo '</ul">';
							}
						?>						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
var WSO_JQUERY = {
    custom: 0
};
jQuery(document).ready(function() {
	jQuery('.wso-options').click(function() {
		WSO_JQUERY.custom = 0;
		jQuery(this).find('input[type=radio]').prop('checked', true);
		jQuery('.wso-options').removeClass('active');
		jQuery(this).addClass('active');

		var wso_value = parseInt(jQuery(this).attr('data-level'));
		if(wso_value != 0){
			jQuery('.wso_setting input[type=checkbox]').removeAttr('checked');
			jQuery('.wso_setting input[type=checkbox]').each(function() {
				if( parseInt(jQuery(this).attr('data-level')) <= wso_value){
					jQuery(this).prop('checked', true);
				}
			});
			jQuery('.wso_setting input[name=wso-o-19]').trigger('change');
		}		
	});

	jQuery('.wso_setting input[type=checkbox]').change(function(event) {
		if(WSO_JQUERY.custom == 1){
			jQuery('#wso-custom').prop('checked', true);
			jQuery('.wso-options').removeClass('active');
			jQuery('#wso-custom').parent('li').parent('ul').addClass('active');
		}
		WSO_JQUERY.custom = 1;
	});

	jQuery('.wso_setting input[name=wso-o-19]').change(function(event) {		
		if(jQuery(this).is(':checked')){
			jQuery('.wso_setting input[name=wso-o-17]').parent().removeClass('wso-box-off');
			jQuery('.wso_setting input[name=wso-o-18]').parent().removeClass('wso-box-off');
		}else{
			jQuery('.wso_setting input[name=wso-o-17]').parent().addClass('wso-box-off');
			jQuery('.wso_setting input[name=wso-o-18]').parent().addClass('wso-box-off');
			jQuery('.wso_setting input[name=wso-o-17], .wso_setting input[name=wso-o-18]').prop('checked', false);
		}
	});
	WSO_JQUERY.custom = 0;
	//jQuery('.wso-options input[type=radio]:checked').trigger('click');
	jQuery('.wso_setting input[name=wso-o-19]').trigger('change');
	jQuery('input[name=first-switch]').trigger('change');

	jQuery(window).scroll(function() {
		if(jQuery(window).width() <= 600){
			if(jQuery(window).scrollTop() > 50){
				jQuery('.wso_update').css('top', 0);
			}else{
				jQuery('.wso_update').css('top', '46px');
			}
		}
	});


	/* Action WSO */
	jQuery(window).load(function() {
		if(jQuery('input[name=first-switch]:checked').val() == 'off'){
			jQuery('.wso-box').each(function(index) {
				if(index != 0){
					jQuery(this).addClass('wso-box-off');
				}	
			});
		}
	});
	jQuery('input[name=first-switch]').change(function() {
		if(jQuery(this).val() == 'off'){
			jQuery('.wso-box').each(function(index) {
				if(index != 0){
					jQuery(this).addClass('wso-box-off');
				}	
			});
		}else{
			jQuery('.wso-box').removeClass('wso-box-off');
		}
	});
	/* Check Level */

	/* Action Save */
	jQuery('.wso_update button').click(function() {
		jQuery('#wso').addClass('wso-box-off');

		var data = { action: 'wso_options_save' };
		data['wso-oprion-active'] = jQuery('input[name=first-switch]:checked').val();
		data['wso-option-oz'] = jQuery('.wso-options input[name=wso-options]:checked').val();
		jQuery('.wso_setting input[type=checkbox]').each(function() {			
			if(jQuery(this).is(':checked')){
				data[jQuery(this).attr('name')] = true;	
			}else{
				data[jQuery(this).attr('name')] = false;
			}
		});

		jQuery('.wso_setting input[type=text]').each(function() {
			data[jQuery(this).attr('name')] = jQuery(this).val();
		});

		/* Send Ajax */
		
		jQuery.post(ajaxurl, data, function(response) {			        
        	setTimeout(function(){        		
        		jQuery('#wso').removeClass('wso-box-off');
        	}, 500);
	    });
	});

	/* fix height all box */
	jQuery(window).resize(function(event) {
		var max = 0;
		jQuery('.wso-options').each(function(index, el) {
			var m = jQuery(this).find('li:last-child').height();
			if(max < m){
				max = m;
			}
		});
		jQuery('.wso-options li:last-child').css('height', max + 'px');
	});
	jQuery(window).trigger('resize');
});
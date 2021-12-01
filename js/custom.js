jQuery(document).ready(function(){
	jQuery('.cs-variable-options-value').on('click',function(){
		var attribute_selected = jQuery(this).data('attribute');
		var option_selected = jQuery(this).data('attribute_value');
		if(jQuery(this).hasClass('active')){
			jQuery(this).removeClass('active');
			jQuery('select[name="attribute_'+attribute_selected+'"]').val([]).change();;
		}else{
			jQuery(this).addClass('active').siblings().removeClass('active');
			jQuery('select[name="attribute_'+attribute_selected+'"]').val(option_selected).change();
		}
	});


	jQuery('.reset_variations').on('click',function(){
		jQuery('li.cs-variable-options-value').removeClass('active');
	});
});
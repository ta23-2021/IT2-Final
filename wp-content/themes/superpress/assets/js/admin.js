jQuery(document).ready(function ($) {
	$('.tabs-stage .admin-tab').hide();
	$('.tabs-stage .admin-tab:first').show();
	$('.tabs-nav li:first').addClass('tab-active');
	$('.tabs-nav a').on('click', function(event){
		event.preventDefault();
		$('.tabs-nav li').removeClass('tab-active');
		$(this).parent().addClass('tab-active');
		$('.tabs-stage .admin-tab').hide();
		$($(this).attr('href')).show();
	});

	$('body').on('click', '.superpress_upload_image_button', function(e){
		e.preventDefault();
		var button = $(this),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : {
				type : 'image'
			},
			button: {
				text: 'Use this image' 
			},
			multiple: false 
		}).on('select', function() { 
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$(button).removeClass('button-image').html('<img class="true_pre_image" src="' + attachment.url + '" style="width:100%;display:block;" />').next().val(attachment.id).next().show();
			button.addClass('has-image');
		})
		.open();
	});

	$('body').on('click', '.superpress_remove_image_button', function(){
		$(this).hide().prev().val('').prev().addClass('button-image').html('Upload image');
		$(this).hide().prev().val('').prev().removeClass('has-image')
		return false;
	});
	
	$('.color-field').each(function(){
		$(this).wpColorPicker();
	});
});
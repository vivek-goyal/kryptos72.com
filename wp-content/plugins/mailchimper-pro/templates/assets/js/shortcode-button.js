(function() {
    tinymce.PluginManager.add('ssfp_shortcode_button', function( editor, url ) {
	var menubuttons = []
	var newmenu = {} , newmenu_answers = {};
	if ( ssfp_shortcode_button.datas != "" ) {
		jQuery.each( ssfp_shortcode_button.datas, function( objindex, objvalue ) {
			newmenu = {
				text: objvalue.name,
				value: objvalue.id,
				onclick: function() {
				editor.windowManager.open( {
						width : 500, 
						height : 225,
						title: 'Insert MailChimper PRO',
						name: 'ssp',
						text: objvalue.id,
						body: [
						{
							type: 'listbox',
							name: 'mode',
							label: 'Mode',
							'values': [
								{text: 'Popup', value: 'popup'},
								{text: 'Embed', value: 'embed'}
							]
						},
						{
							type: 'listbox',
							name: 'visible',
							label: 'Animated Display in Embed Mode',
							'values': [
								{text: 'Enable', value: 'false'},
								{text: 'Disable', value: 'true'}
							]
						},
						{
							type: 'listbox',
							name: 'width',
							label: 'Width',
							'values': [
								{text: 'Default', value: 'default'},
								{text: '100%', value: '100%'},
								{text: '90%', value: '90%'},
								{text: '80%', value: '80%'},
								{text: '70%', value: '70%'},
								{text: '60%', value: '60%'},
								{text: '50%', value: '50%'},
								{text: '40%', value: '40%'},
								{text: '30%', value: '30%'},
								{text: '20%', value: '20%'},
								{text: '10%', value: '10%'}
							]
						}
						],
						onsubmit: function( e ) {
							var shortcode_content = '[' + this.name() + ' id="' + this.text() + '"';
							if ( e.data.mode == "embed" ) shortcode_content += ' embed="true"';
							if ( e.data.mode == "embed" && e.data.visible == "true" ) shortcode_content += ' visible="true"';
							if ( e.data.width != "default" ) shortcode_content += ' width="' + e.data.width + '"';
							shortcode_content += ']';
							editor.insertContent( shortcode_content );
						}
					});
				}
            }
			menubuttons.push(newmenu);
 		});
	}
		if ( ! jQuery.isEmptyObject( menubuttons ) ) {
			editor.addButton( 'ssfp_shortcode_button', {
				icon: 'icon dashicons-email-alt',
				title: 'Insert MailChimper PRO',
				type: 'menubutton',
				menu: menubuttons
			   });
		}
	});
})();
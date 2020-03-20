jQuery(window).load(function() {
	var simplesp = jQuery.noConflict();
	var active_ssp, statform = '', toppos, actionfl = false, rmdni = false;
	simplesp(function() {
	simplesp("#simple_subscription_popup_tabs").tabs();
	simplesp('.open-tab').click(function (event) {
		simplesp( "#simple_subscription_popup_tabs" ).tabs( "option", "active", 0 );
    });
	simplesp("#ssp_name").focus();
	 simplesp(function() {
    simplesp( "#simple_subscription_popup_accordion" ).accordion({
		collapsible: true,
		heightStyle: "content"
    });

	});
	})
    simplesp(document).on('click', '.ssfp-subscriber-table a', function(event){
	event.preventDefault();
	var userinfs = JSON.parse(simplesp('.user-inf-id'+simplesp(this).attr("data-id")).text());
	simplesp('.pop-up-content .email-info').html(userinfs.email);
	simplesp('.pop-up-content .link-info').html(userinfs.link);
	simplesp('.pop-up-content .date-info').html(userinfs.sdate);
	simplesp('.pop-up-content .form-info').html(userinfs.name);
	simplesp('.pop-up-content .params').html('');
	var formopts = JSON.parse(userinfs.formopts);
	if (JSON.parse(userinfs.params)!="")
	{
		if (typeof formopts[50] !== 'undefined') {
			simplesp.each( JSON.parse(userinfs.params), function( key, value ) {
				simplesp.each( formopts[50], function( fokey, fovalue ) {
					if (fovalue.id==key) {
						if ( fovalue.type == "radio" || fovalue.type == "select" ) {
							simplesp('.pop-up-content .params').append('<div><p><strong>'+fovalue.id+': </strong> <span>'+value+'</span></p></div>');
						}
						else if ( fovalue.type == "hidden" ) {
							simplesp('.pop-up-content .params').append('<div><p><strong>'+fovalue.id+': </strong> <span>'+fovalue.name+'</span></p></div>');
						}
						else {
							simplesp('.pop-up-content .params').append('<div><p><strong>'+fovalue.name+': </strong> <span>'+value+'</span></p></div>');
						}
					}
				});
			});
		}
	}
	simplesp('.pop-up-screen, .overlay').fadeIn();
    return false;
    });
    simplesp('.close').on('click', function(event){
	event.preventDefault();
	  simplesp('.pop-up-screen, .overlay').fadeOut(600,function(){
	  });
     return false;
    });
	//define presets
	var presets = new Array();
	presets['default'] = { 
		customfieldsmargin:"7px", bgcolor:"rgb(254, 254, 254)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(199, 28, 9)",buttoncolor:"rgb(247, 247, 247)",closecolor:"rgb(0, 0, 0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(93, 93, 93)",fontfamily:"Trade Winds",contentfontfamily:"Quattrocento Sans",contentfontsize:"12px",	borderradius:"12px",inputborderradius:"0px",fontsize:"20px"
	  };
	presets['business'] = { 
		customfieldsmargin:"7px", bgcolor:"rgb(254, 254, 254)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(153, 153, 153)",buttoncolor:"rgb(0, 0, 0)",closecolor:"rgb(153, 153, 153)",closefontsize:"11px",color:"rgb(0, 0, 0)",contentcolor:"rgb(153, 153, 153)",fontfamily:"Source Sans Pro",contentfontfamily:"Source Sans Pro",contentfontsize:"12px",	borderradius:"0px",inputborderradius:"0px",fontsize:"20px"
	  };	
	presets['baby'] = { 
		customfieldsmargin:"5px", bgcolor:"rgb(241, 174, 245)",lockbgcolor:"rgb(255, 255, 255)",buttonbgcolor:"rgb(0, 0, 0)",buttoncolor:"rgb(242, 111, 97)",closecolor:"rgb(0, 0, 0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(242, 111, 97)",fontfamily:"Sofia",contentfontfamily:"Sofadi One",contentfontsize:"12px",	borderradius:"71px",inputborderradius:"5px",fontsize:"20px"
	  };	
	presets['dating'] = { 
		customfieldsmargin:"5px", bgcolor:"rgb(144, 26, 34)",lockbgcolor:"rgb(251, 251, 251)",buttonbgcolor:"rgb(0, 0, 0)",buttoncolor:"rgb(255, 255, 255)",closecolor:"rgb(0,0,0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(249, 236, 235)",fontfamily:"Aladin",contentfontfamily:"Sofadi One",contentfontsize:"12px",	borderradius:"13px",inputborderradius:"0px",fontsize:"47px"
	  };	
	presets['technology'] = { 
		customfieldsmargin:"5px", bgcolor:"rgb(84, 168, 192)",lockbgcolor:"rgb(86, 86, 86)",buttonbgcolor:"rgb(198, 198, 198)",buttoncolor:"rgb(0, 0, 0)",closecolor:"rgb(198, 198, 198)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(86, 86, 86)",fontfamily:"Aldrich",contentfontfamily:"Alef",contentfontsize:"11px",	borderradius:"0px",inputborderradius:"0px",fontsize:"31px" 
	  };	
	presets['finance'] = { 
		customfieldsmargin:"5px", bgcolor:"rgb(253, 253, 253)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(0, 0, 0)",buttoncolor:"rgb(227, 242, 97)",closecolor:"rgb(235, 232, 232)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(0, 0, 0)",fontfamily:"Signika",contentfontfamily:"Ubuntu",contentfontsize:"12px",	borderradius:"0px",inputborderradius:"20px",fontsize:"20px"
	  };
	  //customize start	
		initialize_sliders();

	function initialize_sliders()
	{
	simplesp( ".ssp_accordion_more_api" ).accordion({
	  collapsible: true,
	  heightStyle: "content",
	  active: false,
	  alwaysOpen: false
	});
	initialize_tooltips();
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_animation_speed").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_animation_speed_value" ).val().replace("Animation Speed: ","").replace("sec","");
	  	//initialize the animation speed property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_animation_speed" ).slider({
			range: "min",
			step: 0.1,
			value: thisvalue,
			min: 0.1,
			max: 60,
			slide: function( event, ui ) {
			simplesp( "#"+ssp_id+" .simple_subscription_popup_animation_speed_value" ).val( "Animation Speed: "+ui.value + "sec" );
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_font_size").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_font_size_value" ).val().replace("Font Size: ","").replace("px","");
	  	//initialize the font-size property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_font_size" ).slider({
			range: "min",
			value: thisvalue,
			min: 6,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_font_size_value" ).val( "Font Size: "+ui.value + "px" );
				if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner h2").css("font-size",ui.value + "px");
			reset_preset(ssp_id);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_content_font_size").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_content_font_size_value" ).val().replace("Content Font Size: ","").replace("px","");
	  	//initialize the content font-size property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_content_font_size" ).slider({
			range: "min",
			value: thisvalue,
			min: 6,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_content_font_size_value" ).val( "Content Font Size: "+ui.value + "px" );
				if (simplesp(".inside-form").length!=0) simplesp(".inside-form>p").css("font-size",ui.value + "px");
			reset_preset(ssp_id);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_border_radius").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_border_radius_value" ).val().replace("Border Radius: ","").replace("px","");
	  	//initialize the border-radius property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_border_radius" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_border_radius_value" ).val( "Border Radius: "+ui.value + "px" );
				if (simplesp(".mc_embed_signup .mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup .mc_embed_signup_inner").css("border-radius",ui.value+"px "+ui.value+"px "+ui.value+"px "+ui.value+"px");
			reset_preset(ssp_id);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_close_button_size").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_close_button_size_value" ).val().replace("Close Button Size: ","").replace("px","");
	  	//initialize the close button size property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_close_button_size" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_close_button_size_value" ).val( "Close Button Size: "+ui.value + "px" );
				if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_close").css("font-size",ui.value + "px");
			reset_preset(ssp_id);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_vertical_space").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_vertical_space_value" ).val().replace("Vertical Space: ","").replace("px","");
	  	//initialize the vertical space property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_vertical_space" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_vertical_space_value" ).val( "Vertical Space: "+ui.value + "px" );
				if (simplesp(".mc_embed_signup_inner").length!=0) 
				{
					if (simplesp("#"+ssp_id+" .display_style").val()=="lefttop"||simplesp("#"+ssp_id+" .display_style").val()=="righttop"||simplesp("#"+ssp_id+" .display_style").val()=="centertop") simplesp(".simplesignuppro").css("top", ui.value + "px");
					if (simplesp("#"+ssp_id+" .display_style").val()=="leftbottom"||simplesp("#"+ssp_id+" .display_style").val()=="rightbottom"||simplesp("#"+ssp_id+" .display_style").val()=="centerbottom") simplesp(".simplesignuppro").css("top",parseInt(toppos)-ui.value + "px");
				}
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_image_opacity").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_image_opacity_value" ).val().replace("Image Opacity: ","");
	  	//initialize the vertical space property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_image_opacity" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			max: 1,
			step: 0.1,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_image_opacity_value" ).val( "Image Opacity: "+ui.value);
				if (simplesp(".ssfproacenter").length!=0) 
				{
					simplesp(".ssfproacenter").css("opacity",ui.value);
				}
					simplesp("#"+ssp_id+" .img-cont img").css("opacity",ui.value);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_horizontal_space").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_horizontal_space_value" ).val().replace("Horizontal Space: ","").replace("px","");
	  	//initialize the horizontal space property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_horizontal_space" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_horizontal_space_value" ).val( "Horizontal Space: "+ui.value + "px" );
				if (simplesp(".mc_embed_signup_inner").length!=0) 
				{
					if (simplesp("#"+ssp_id+" .display_style").val()=="lefttop"||simplesp("#"+ssp_id+" .display_style").val()=="leftbottom"||simplesp("#"+ssp_id+" .display_style").val()=="leftcenter") simplesp(".simplesignuppro").css("left",ui.value + "px");
					if (simplesp("#"+ssp_id+" .display_style").val()=="righttop"||simplesp("#"+ssp_id+" .display_style").val()=="rightbottom"||simplesp("#"+ssp_id+" .display_style").val()=="rightcenter") simplesp(".simplesignuppro").css("right",ui.value + "px");
				}
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_cmargin").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_cmargin_value" ).val().replace("Fields Margin: ","").replace("px","");
	  	//initialize the opacity property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_cmargin" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			step: 1,
			max: 100,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_cmargin_value" ).val( "Fields Margin: "+ui.value+"px" );
				if (simplesp(".customfields").length!=0) simplesp(".customfields").css("marginBottom",ui.value+"px");
			reset_preset(ssp_id);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_iborderradius").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_iborderradius_value" ).val().replace("Input Border Radius: ","").replace("px","");
	  	//initialize the opacity property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_iborderradius" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			step: 1,
			max: 100,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_iborderradius_value" ).val( "Input Border Radius: "+ui.value+"px" );
				if (simplesp(".customfields").length!=0) {
					simplesp(".customfields").css("borderRadius",ui.value+"px");
				}
				simplesp(".ssp_email").css({"border-top-left-radius":ui.value+"px","border-bottom-left-radius":ui.value+"px"});
				simplesp(".subscribe").css({"border-top-right-radius":ui.value+"px","border-bottom-right-radius":ui.value+"px"});
			reset_preset(ssp_id);
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_fcookie_days").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_fcookie_days_value" ).val().replace("Filled Cookie Days: ","");
	  	//initialize the opacity property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_fcookie_days" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			step: 1,
			max: 999,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_fcookie_days_value" ).val( "Filled Cookie Days: "+ui.value );
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_display_timer").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_display_timer_value" ).val().replace("Display Timer: ","").replace("sec","");
	  	//initialize the display timer property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_display_timer" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			step: 0.1,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_display_timer_value" ).val( "Display Timer: "+ui.value + "sec" );
			}
			});
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_cookie_days").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	var thisvalue = simplesp( "#"+ssp_id+" .simple_subscription_popup_cookie_days_value" ).val().replace("Cookie Days: ","");
	  	//initialize the cookie days property slider
			simplesp( "#"+ssp_id+" .simple_subscription_popup_cookie_days" ).slider({
			range: "min",
			value: thisvalue,
			min: 0,
			max: 200,
			slide: function( event, ui ) {
				simplesp( "#"+ssp_id+" .simple_subscription_popup_cookie_days_value" ).val( "Cookie Days: "+ui.value );
			}
			});
	})

	
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1001").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
		simplesp("#"+ssp_id+" .simple_subscription_popup_preview1001").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1001").css('background-color', rgba);
					if (simplesp(".mc_embed_signup .mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup .mc_embed_signup_inner form").css("background",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1001").css('background-color', rgba);
					if (simplesp(".mc_embed_signup .mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup .mc_embed_signup_inner form").css("background",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})

	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1002").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
		simplesp("#"+ssp_id+" .simple_subscription_popup_preview1002").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1002").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner h2").css("color",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1002").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner h2").css("color",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1003").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	simplesp("#"+ssp_id+" .simple_subscription_popup_preview1003").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1003").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner p").css("color",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1003").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner p").css("color",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1004").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	simplesp("#"+ssp_id+" .simple_subscription_popup_preview1004").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1004").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner .subscribe").css("background",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1004").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner .subscribe").css("background",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1005").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	simplesp("#"+ssp_id+" .simple_subscription_popup_preview1005").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1005").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner .subscribe").css("color",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1005").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner .subscribe").css("color",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1006").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	simplesp("#"+ssp_id+" .simple_subscription_popup_preview1006").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1006").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_close").css("color",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1006").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_close").css("color",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})
	simplesp("#simple_subscription_popup_accordion .simple_subscription_popup_preview1007").each(function( index ) {
	var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
	simplesp("#"+ssp_id+" .simple_subscription_popup_preview1007").spectrum({
                move: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1007").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_close").css("color",rgba);
					reset_preset(ssp_id);
                },
                change: function(color) {
					var rgba = color.toRgbString();
					simplesp("#"+ssp_id+" .simple_subscription_popup_preview1007").css('background-color', rgba);
					if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_close").css("color",rgba);
					reset_preset(ssp_id);
                },
                showAlpha: true,
                color: simplesp(this).css("background-color"),
                clickoutFiresChange: true,
                showInput: true,
                showButtons: false
            });	
	})
			//bind event to change font family
		simplesp(".font_family").on("change", function(){
			if (simplesp(this).val()=="") simplesp(".mc_embed_signup_inner h2").css("font-family","");
			else
			{
				if (!simplesp("link[href='http://fonts.googleapis.com/css?family="+simplesp(this).val()+":400,700']").length) simplesp('head').append('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='+simplesp(this).val()+':400,700" type="text/css" />');
				if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner h2").css("font-family",simplesp(this).val()+", serif");
			}
					reset_preset(simplesp(this).parent().parent().attr("id"));
		});
			//bind event to change content font family
		simplesp(".content_font_family").on("change", function(){
			if (simplesp(this).val()=="") simplesp(".mc_embed_signup_inner p, .mc_embed_signup_inner input").css("font-family","");
			else
			{
				if (!simplesp("link[href='http://fonts.googleapis.com/css?family="+simplesp(this).val()+":400,700']").length) simplesp('head').append('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='+simplesp(this).val()+':400,700" type="text/css" />');
				if (simplesp(".mc_embed_signup_inner").length!=0) simplesp(".mc_embed_signup_inner p, .mc_embed_signup_inner input").css("font-family",simplesp(this).val()+", serif");
			}
				reset_preset(simplesp(this).parent().parent().attr("id"));
		});
		
		simplesp( document ).on( "click", ".image-upload", function( event ) {
		var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
			simplesp( "#" + ssp_id + " .image-upload" ).wpmediauploader({
				"button": "#" + ssp_id + " .image-upload",
				"target": "#" + ssp_id + " .uploaded-image",
				"container":"<div class=\"image_container\"><div class=\"img-cont-outer\"><div class=\"img-cont\"><img src=\"[content]\"></div></div><input type=\"hidden\" class=\"upl_image upl-photo\" name=\"image[]\" value=\"[objImageUrl]\"><div><input class=\"remove_customimage_button button remove-button\" type=\"button\" value=\"REMOVE\" /></div></div>",
				"mode": "insert",
				"indexcontainer": "",
				"type": "single",
				"callback": function() {}
			});
		})	
		
			//bind event to change preset
		simplesp(".preset").on("change", function(){
		var assp = simplesp(this).parent().parent().attr("id");
			set_preset(simplesp(this).val(),assp);
		});
	}
	
	simplesp( document ).on( "click", ".remove_customimage_button", function( event ) {
		event.preventDefault();
		simplesp( this ).parentsUntil( ".uploaded-image" ).html( "<div class=\"imageelement\"><div class=\"uploaded-image\"><input class=\"image-upload button add-button\" type=\"button\" value=\"UPLOAD\" /></div></div>" );
		return false;
	});	
	
	function set_preset(prs,active_ssp)
	{
		if (prs=='custom') prs='current';
		if (typeof presets[prs] !== 'undefined') 
		{
			simplesp( "#"+active_ssp+" .simple_subscription_popup_font_size_value" ).val( "Font Size: "+presets[prs]['fontsize'] );
			simplesp( "#"+active_ssp+" .simple_subscription_popup_content_font_size_value" ).val( "Content Font Size: "+presets[prs]['contentfontsize'] );
			simplesp( "#"+active_ssp+" .simple_subscription_popup_border_radius_value" ).val( "Border Radius: "+presets[prs]['borderradius'] );
			simplesp( "#"+active_ssp+" .simple_subscription_popup_close_button_size_value" ).val( "Close Button Size: "+presets[prs]['closefontsize'] );
			simplesp( "#"+active_ssp+" .simple_subscription_popup_cmargin_value" ).val( "Fields Margin: "+presets[prs]['customfieldsmargin'] );
			simplesp( "#"+active_ssp+" .simple_subscription_popup_iborderradius_value" ).val( "Input Border Radius: "+presets[prs]['inputborderradius'] );
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1001").css('background-color', presets[prs]['bgcolor']);
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1007").css('background-color', presets[prs]['lockbgcolor']);
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1002").css('background-color', presets[prs]['color']);
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1003").css('background-color', presets[prs]['contentcolor']);
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1004").css('background-color', presets[prs]['buttonbgcolor']);
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1005").css('background-color', presets[prs]['buttoncolor']);
			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1006").css('background-color', presets[prs]['closecolor']);
			simplesp("#"+active_ssp+" .font_family").val(presets[prs]['fontfamily']);
			simplesp("#"+active_ssp+" .content_font_family").val(presets[prs]['contentfontfamily']);
			initialize_sliders();			
		}
	}

	function reset_preset(active_ssp)
	{
		simplesp("#"+active_ssp+" .preset").val("custom");
	}
	
	function play_ssp()
	{
	if (simplesp( "#"+active_ssp+" .preset").val()=="custom")
	{
		presets['current'] = {
			customfieldsmargin:			''+simplesp( "#"+active_ssp+" .simple_subscription_popup_cmargin_value" ).val().replace("Fields Margin: ","")+'',
			bgcolor:					''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1001").css('background-color')+'',
			lockbgcolor:				''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1007").css('background-color')+'',
			buttonbgcolor:				''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1004").css('background-color')+'',
			buttoncolor:				''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1005").css('background-color')+'',
			closecolor:					''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1006").css('background-color')+'',
			closefontsize:				''+simplesp( "#"+active_ssp+" .simple_subscription_popup_close_button_size_value" ).val().replace("Close Button Size: ","")+'',
			color:						''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1002").css('background-color')+'',
			contentcolor:				''+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1003").css('background-color')+'',
			fontfamily:					''+simplesp("#"+active_ssp+" .font_family").val()+'',
			contentfontfamily:			''+simplesp("#"+active_ssp+" .content_font_family").val()+'',
			contentfontsize:			''+simplesp( "#"+active_ssp+" .simple_subscription_popup_content_font_size_value" ).val().replace("Content Font Size: ","")+'',
			borderradius:				''+simplesp( "#"+active_ssp+" .simple_subscription_popup_border_radius_value" ).val().replace("Border Radius: ","")+'',
			inputborderradius:			''+simplesp( "#"+active_ssp+" .simple_subscription_popup_iborderradius_value" ).val().replace("Input Border Radius: ","")+'',
			fontsize:					''+simplesp( "#"+active_ssp+" .simple_subscription_popup_font_size_value" ).val().replace("Font Size: ","")+''
		}
	}
	console.log(
			'customfieldsmargin:"'+simplesp( "#"+active_ssp+" .simple_subscription_popup_cmargin_value" ).val().replace("Fields Margin: ","")+'", bgcolor:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1001").css('background-color')+'",lockbgcolor:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1007").css('background-color')+'",buttonbgcolor:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1004").css('background-color')+'",buttoncolor:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1005").css('background-color')+'",closecolor:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1006").css('background-color')+'",closefontsize:"'+simplesp( "#"+active_ssp+" .simple_subscription_popup_close_button_size_value" ).val().replace("Close Button Size: ","")+'",color:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1002").css('background-color')+'",contentcolor:"'+simplesp("#"+active_ssp+" .simple_subscription_popup_preview1003").css('background-color')+'",fontfamily:"'+simplesp("#"+active_ssp+" .font_family").val()+'",contentfontfamily:"'+simplesp("#"+active_ssp+" .content_font_family").val()+'",contentfontsize:"'+simplesp( "#"+active_ssp+" .simple_subscription_popup_content_font_size_value" ).val().replace("Content Font Size: ","")+'",	borderradius:"'+simplesp( "#"+active_ssp+" .simple_subscription_popup_border_radius_value" ).val().replace("Border Radius: ","")+'",inputborderradius:"'+simplesp( "#"+active_ssp+" .simple_subscription_popup_iborderradius_value" ).val().replace("Input Border Radius: ","")+'",fontsize:"'+simplesp( "#"+active_ssp+" .simple_subscription_popup_font_size_value" ).val().replace("Font Size: ","")+'"'
);
	if ( simplesp().simplesignuppro ) simplesp( "#simplesignuppro-admin" ).simplesignuppro( 'destroy' );
	var ff, cff;
	if (simplesp("#"+active_ssp+" .font_family").val()!='') ff = simplesp("#"+active_ssp+" .font_family").val();
	else ff = '';
	if (simplesp("#"+active_ssp+" .content_font_family").val()!='') cff = simplesp("#"+active_ssp+" .content_font_family").val();
	else cff = '';
	if (simplesp( "#"+active_ssp+" .autoopen" ).val()==1) {var autoopen = "true";}
	else {var autoopen = "";}
	if (simplesp( "#"+active_ssp+" .boldcontent" ).val()==1) {var boldcontent = 'bold';}
	else {var boldcontent = 'normal';}
	if (simplesp( "#"+active_ssp+" .atbottom" ).val()==1) {var atbottom = "true";}
	else {var atbottom = "";}
	if (simplesp( "#"+active_ssp+" .boldtitle" ).val()==1) {var boldtitle = 'bold';}
	else {var boldtitle = 'normal';}
	if (simplesp( "#"+active_ssp+" .doubleoptin" ).val()==1) {var doubleoptin = "true";}
	else {var doubleoptin = "";}
	if (simplesp( "#"+active_ssp+" .updateexisting" ).val()==1) {var updateexisting = "true";}
	else {var updateexisting = "";}
	if (simplesp( "#"+active_ssp+" .replaceinterests" ).val()==1) {var replaceinterests = "true";}
	else {var replaceinterests = "";}
	if (simplesp( "#"+active_ssp+" .sendwelcome" ).val()==1) {var sendwelcome = "true";}
	else {var sendwelcome = "";}
	if (simplesp( "#"+active_ssp+" .onceperuser" ).val()==1) {var onceperuser = "true";}
	else {var onceperuser = "";}
	if (simplesp( "#"+active_ssp+" .lock" ).val()==1) {var lock = "true";}
	else {var lock = "";}
	if (simplesp( "#"+active_ssp+" .hidebutton" ).val()==1) {var hidebutton = "true";}
	else {var hidebutton = "";}
	if (simplesp( "#"+active_ssp+" .closewithlayer" ).val()==1) {var closewithlayer = "true";}
	else {var closewithlayer = "";}
	if (simplesp( "#"+active_ssp+" .youtube_autoplay" ).val()==1) {var youtube_autoplay = "1";}
	else {var youtube_autoplay = "";}
	var ypos = simplesp( "#"+active_ssp+" .youtube_position:checked" ).val();
		var customfsarray = new Array();
		var customfs = {};
		simplesp("#"+active_ssp+" .one-custom-field").each(function( index ) {
			if (simplesp(this).children(".cfid").val()!=''&&simplesp(this).children(".cfname").val())
			{
			customfs = {};
			if (simplesp(this).children(".cfrequired").val()=='1') {var thisreq = 'true';}
			else {var thisreq = 'false';}
			customfs.id = simplesp(this).children(".cfid").val();
			customfs.name = simplesp(this).children(".cfname").val();
			customfs.required = thisreq;
			customfs.warning = simplesp(this).children(".cfwarning").val();
			customfs.type = simplesp(this).children(".cfid").attr("data-type");
			customfs.minlength = simplesp(this).children(".cfminlength").val();
				customfsarray.push(customfs);
			}
		});
		var cont = simplesp("#"+active_ssp+" .formtext").val();
		var tit = simplesp("#"+active_ssp+" .formtitle").val();
		var contenttext = cont;
		var contenttitle = tit;
		if (simplesp("#"+active_ssp+" .addmoreapi_youtube").is(':checked'))
		{
			if (simplesp("#"+active_ssp+" .youtube_videoid").val()!='')
			{
				var youtubeurl = 'http://www.youtube.com/embed/'+simplesp("#"+active_ssp+" .youtube_videoid").val()+'?version=3&wmode=transparent';
				if (simplesp("#"+active_ssp+" .youtube_autoplay").is(':checked')) youtubeurl += '&autoplay=1';
				else youtubeurl += '&autoplay=0';
				if (simplesp("#"+active_ssp+" .youtube_showinfo").is(':checked')) youtubeurl += '&showinfo=1';
				else  youtubeurl += '&showinfo=0';
				if (simplesp("#"+active_ssp+" .youtube_loop").is(':checked')) youtubeurl += '&loop=1';
				else youtubeurl += '&loop=0';
				if (simplesp("#"+active_ssp+" .youtube_controls").is(':checked')) youtubeurl += '&controls=0';
				else youtubeurl += '&controls=1';
				var videowidth = "100%";
				var videoheight = "195px";
				if (simplesp("#"+active_ssp+" .youtube_videowidth").val()!="") videowidth = simplesp("#"+active_ssp+" .youtube_videowidth").val().replace("px","");
				if (simplesp("#"+active_ssp+" .youtube_videoheight").val()!="") videoheight = simplesp("#"+active_ssp+" .youtube_videoheight").val().replace("px","");
				var youtubecontent = "<div class='ssfproacenter'><iframe class='customplayer' width='"+videowidth+"' height='"+videoheight+"' src='"+youtubeurl+"' frameborder='0' allowfullscreen></iframe></div>";
				if (simplesp("#"+active_ssp+" .youtube_position:checked").val()=="1") contenttitle = youtubecontent+tit;
				if (simplesp("#"+active_ssp+" .youtube_position:checked").val()=="2") contenttext = cont+youtubecontent;
				if (simplesp("#"+active_ssp+" .youtube_position:checked").val()=="3"||simplesp("#"+active_ssp+" .youtube_position:checked").val()=="4") contenttitle = tit+youtubecontent;
			}
		}
		if (simplesp("#"+active_ssp+" .addmoreapi_image").is(':checked'))
		{
			if (simplesp("#"+active_ssp+" .upl_image").val()!='')
			{
				var imagewidth = "", imageheight = "", divwidth = "", divheight = "", repeat = "", divbgsize = "";
				if (simplesp("#"+active_ssp+" .imagewidth").val()!="") {
					imagewidth = "width='" + simplesp("#"+active_ssp+" .imagewidth").val().replace("px","") + "'";
					divwidth = simplesp("#"+active_ssp+" .imagewidth").val();
				}
				if (simplesp("#"+active_ssp+" .imageheight").val()!="") {
					imageheight = "width='" + simplesp("#"+active_ssp+" .imageheight").val().replace("px","") + "'";
					divheight = simplesp("#"+active_ssp+" .imageheight").val();
				}
				if ( divwidth == "" && divheight == "" ) {
				}
				else {
					if ( divwidth == "" ) {
						divwidth = "auto";
					}
					if ( divheight == "" ) {
						divheight = "auto";
					}
					divbgsize = "background-size: " + divwidth + " " + divheight + ";"
				}
				if (simplesp("#"+active_ssp+" .image_repeat").is(':checked')) {
					repeat = 'background-repeat: repeat;';
				}
				else {
					repeat = 'background-repeat: no-repeat;';
				}
				var imagecontent = "<div class='ssfproacenter'><img style='opacity:" + simplesp("#"+active_ssp+" .simple_subscription_popup_image_opacity_value").val().replace("Image Opacity: ","") + "' src='" + simplesp("#"+active_ssp+" .upl_image").val() + "' "+imagewidth+" "+imageheight+" /></div>";
				if ( simplesp("#"+active_ssp+" .image_position:checked").val()=="4" ) {
					if ( divbgsize == "" ) {
						divbgsize = "background-size: cover;"
					}
					var imagecontent = "<div class='ssfproacenter' style='background-image: url(" + simplesp("#"+active_ssp+" .upl_image").val() + ");" + repeat + divbgsize + "opacity:" + simplesp("#"+active_ssp+" .simple_subscription_popup_image_opacity_value").val().replace("Image Opacity: ","") + ";'></div>";
					ypos = 4;
				}
				if ( simplesp("#"+active_ssp+" .image_position:checked").val()=="5" ) {
					if ( divbgsize == "" ) {
						divbgsize = "background-size: contain;"
					}
					var imagecontent = "<div class='ssfproacenter' style='background-image: url(" + simplesp("#"+active_ssp+" .upl_image").val() + ");" + repeat + divbgsize + "opacity:" + simplesp("#"+active_ssp+" .simple_subscription_popup_image_opacity_value").val().replace("Image Opacity: ","") + ";'></div>";
					ypos = 4;
				}
				if (simplesp("#"+active_ssp+" .image_position:checked").val()=="1") contenttitle = imagecontent+tit;
				if (simplesp("#"+active_ssp+" .image_position:checked").val()=="2") contenttext = cont+imagecontent;
				if (simplesp("#"+active_ssp+" .image_position:checked").val()=="3"||simplesp("#"+active_ssp+" .image_position:checked").val()=="4"||simplesp("#"+active_ssp+" .image_position:checked").val()=="5") contenttitle = tit+imagecontent;
			}
		}
	var object = {
		"animtime":					simplesp( "#"+active_ssp+" .simple_subscription_popup_animation_speed_value" ).val().replace("Animation Speed: ","").replace("sec",""),
		"animation":				simplesp( "#"+active_ssp+" .animation" ).val(),
		"customfields":				JSON.stringify( customfsarray ),
		"autoopen":					"1",
		"facebook_appid":			simplesp( "#"+active_ssp+" .facebookappid" ).val(),
		"googleplus_clientid":		simplesp( "#"+active_ssp+" .gplusclientid" ).val(),
		"googleplus_apikey":		simplesp( "#"+active_ssp+" .gplusapikey" ).val(),
		"inputborderradius":		simplesp( "#"+active_ssp+" .simple_subscription_popup_iborderradius_value" ).val().replace("Input Border Radius: ",""),
		"customfieldsmargin":		simplesp( "#"+active_ssp+" .simple_subscription_popup_cmargin_value" ).val().replace("Fields Margin: ",""),
		"mode":						simplesp("#"+active_ssp+" .mode").val(), 
		"bgcolor":					simplesp("#"+active_ssp+" .simple_subscription_popup_preview1001").css("background-color"),
		"buttonbgcolor":			simplesp("#"+active_ssp+" .simple_subscription_popup_preview1004").css("background-color"),
		"buttoncolor":				simplesp("#"+active_ssp+" .simple_subscription_popup_preview1005").css("background-color"),	
		"closecolor":				simplesp("#"+active_ssp+" .simple_subscription_popup_preview1006").css("background-color"),	
		"closefontsize":			simplesp( "#"+active_ssp+" .simple_subscription_popup_close_button_size_value" ).val().replace("Close Button Size: ",""),
		"color":					simplesp("#"+active_ssp+" .simple_subscription_popup_preview1002").css("background-color"),	
		"contentcolor":				simplesp("#"+active_ssp+" .simple_subscription_popup_preview1003").css("background-color"),	
		"fontfamily":				ff,
		"bottomtitle":		  		simplesp("#"+active_ssp+" .bottomline").val(),
		"closewithlayer":			closewithlayer,
		"contentfontfamily":		cff,
		"contentfontsize":			simplesp( "#"+active_ssp+" .simple_subscription_popup_content_font_size_value" ).val().replace("Content Font Size: ",""),
		"contentweight":			boldcontent,
		"title":			    	contenttitle,
		"text":						contenttext,
		"vspace":					simplesp( "#"+active_ssp+" .simple_subscription_popup_vertical_space_value" ).val().replace("Vertical Space: ",""),
		"hspace":					simplesp( "#"+active_ssp+" .simple_subscription_popup_horizontal_space_value" ).val().replace("Horizontal Space: ",""),
		"timer":					1000,
		"position":					simplesp("#"+active_ssp+" .display_style").val(),
		"invalid_address":			simplesp("#"+active_ssp+" .invalidemail").val(),
		"signup_success":			simplesp("#"+active_ssp+" .successsignup").val(),
		"borderradius":				simplesp( "#"+active_ssp+" .simple_subscription_popup_border_radius_value" ).val().replace("Border Radius: ",""),
		"openbottom":				atbottom,
		"fontsize":					simplesp( "#"+active_ssp+" .simple_subscription_popup_font_size_value" ).val().replace("Font Size: ",""),
		"fontweight":				boldtitle,
		"double_optin":				doubleoptin,
        "update_existing":			updateexisting,
        "replace_interests":		replaceinterests,
        "send_welcome":				sendwelcome,
        "mailchimp_listid":			simplesp( "#"+active_ssp+" .listid").val(),
		"once_per_user":			"",
		"once_per_filled":			"",
		"cookie_days":				0,
		"subscribe_text":			simplesp( "#"+active_ssp+" .subscribe_text").val(),
		"placeholder_text":			simplesp( "#"+active_ssp+" .placeholder_text").val(),
		"path":						sspa_params.admin_url,
		"lock":						lock,
		"hideclose":				hidebutton,
		"lockbgcolor":				simplesp("#"+active_ssp+" .simple_subscription_popup_preview1007").css("background-color"),
		"preset":					simplesp("#"+active_ssp+" .preset").val(),
		"trackform":				"",
		"preview":					"true",
		"yaplay":					youtube_autoplay,
		"ypos":						ypos,
		"embed":					"",
		"elemanimation":			simplesp( "#"+active_ssp+" .elementanimation" ).val(),
		"cdatas1":					"",
		"cdatas2":					"",
		"filled_cookie_days":		"-1",
		"formid":					"",
		"openwithlink":				"",
		"redirect":					""
		};
		console.log(object);
	simplesp("#simplesignuppro-admin").replaceWith( '<div id="simplesignuppro-admin" class="simplesignuppro"></div>' );
	simplesp("#simplesignuppro-admin").simplesignuppro(object);
		setTimeout(function(){toppos = simplesp(".simplesignuppro").css("top").replace("px","");},1000);
	}
	
	simplesp("body").on( "click", ".play_button",function() {
	var s_id = simplesp(this).parent().parent().attr("id");
	active_ssp = s_id;
	play_ssp();
	})
	
	function add_signup_form() {
		var error = "0";
		var ssp_id = Math.abs(simplesp("#ssp_name").val().split("").reduce(function(a,b){a=((a<<5)-a)+b.charCodeAt(0);return a&a},0));
		if ( simplesp( "#ssp_name" ).val() != "" ) {
			if ( rmdni == false ) {
			rmdni = true;
			simplesp( "#button-container" ).html('<img width="20" style="margin-left:50px;" src="'+sspa_params.plugin_url+'/templates/assets/img/preloader.gif">');
			var data = {
				action: 'ajax_ssp',
				sspcmd: 'add',
				signup_form_id: ssp_id,
				form_name: simplesp("#ssp_name").val(),
				global_use: '1',
				options: JSON.stringify( {} )
				};
			checker = setTimeout( function() { 
				if ( simplesp( "#button-container" ).html() == '<img width="20" style="margin-left:50px;" src="'+sspa_params.plugin_url+'/templates/assets/img/preloader.gif">') {
					simplesp( "#button-container" ).html('<a id="add_new_ssp" class="button button-primary button-small">New Form</a>');
					simplesp( "#error_log" ).html( "Error during the form creation." );
				}
			}, 15000 );
			simplesp.post(sspa_params.admin_url, data, function(response) {
				if ( response.toLowerCase().indexOf( "success" ) >= 0 || response.toLowerCase().indexOf( "updated" ) >= 0 ) {
					clearTimeout( checker );
					simplesp( "#error_log" ).html( "Successful! Redirecting to the newsletter form." );
					window.location = response.replace( "success", "" );
				}
				else {
					simplesp( "#button-container" ).html('<a id="add_new_ssp" class="button button-primary button-small">New Form</a>');
					simplesp( "#error_log" ).html( "Error during the save process: " + response );
				}
				rmdni = false;
				});
			}
		}
	}
	simplesp( "#ssp_name" ).keypress(function( event ) {
		if ( event.which == 13 ) {
			event.preventDefault();
			add_signup_form();
		}
	});
  
  	simplesp( document ).on( "click", "#add_new_ssp", function (event) {
		event.preventDefault();
		add_signup_form();
	});
	
  	simplesp(document).on("click", ".add_custom_fields", function () {
	var s_id = simplesp(this).parent().parent().attr("id");
	simplesp("#"+s_id+" .custom_field_section").append("<div class='one-custom-field'><input type='text' data-type='text' class='cfid simple_subscription_popup_tooltip' title='ID of input field, eg.: FNAME' value='' onkeyup=\"this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');\" placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip' value='' title='Name of custom field, eg.: First Name' placeholder='Name'><input type='text' class='cfwarning simple_subscription_popup_tooltip' title='Warning text for the field if it is required, eg.: Firstname field is mandatory' value='' placeholder='Warning'><input type='text' class='cfminlength simple_subscription_popup_tooltip' title='Minimum character length for required field' value='' placeholder='0'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' title='Check this if the field is mandatory' value='0'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Field' src='"+sspa_params.plugin_url+"/templates/assets/img/delete.png'></div>");
			initialize_tooltips();
	});
  	simplesp(document).on("click", ".add_custom_fields_radio", function () {
	var s_id = simplesp(this).parent().parent().attr("id");
	simplesp("#"+s_id+" .custom_field_section").append("<div class='one-custom-field'><input type='text' data-type='radio' class='cfid simple_subscription_popup_tooltip' title='ID of radio field, eg.: GENDER' value='' onkeyup=\"this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');\" placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='' title='Name and value pair for custom field, eg.: Female:female,Male:male' placeholder='Female:female,Male:male'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' title='Check this if the field is mandatory' value='0'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Field' src='"+sspa_params.plugin_url+"/templates/assets/img/delete.png'></div>");
			initialize_tooltips();
	});
  	simplesp(document).on("click", ".add_custom_fields_checkbox", function () {
	var s_id = simplesp(this).parent().parent().attr("id");
	simplesp("#"+s_id+" .custom_field_section").append("<div class='one-custom-field'><input type='text' data-type='checkbox' class='cfid simple_subscription_popup_tooltip' title='ID of checkbox field, eg.: I agreee with Terms and Conditions' value='' onkeyup=\"this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');\" placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='' title='Value of custom field, eg.: Yes' placeholder='Yes'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' title='Check this if the field is mandatory' value='0'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Field' src='"+sspa_params.plugin_url+"/templates/assets/img/delete.png'></div>");
			initialize_tooltips();
	});
  	simplesp(document).on("click", ".add_custom_fields_textarea", function () {
	var s_id = simplesp(this).parent().parent().attr("id");
	simplesp("#"+s_id+" .custom_field_section").append("<div class='one-custom-field'><input type='text' data-type='textarea' class='cfid simple_subscription_popup_tooltip' title='ID of textarea field, eg.: Description' onkeyup=\"this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');\" value='' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip' value='' title='Placeholder for custom field, eg.: Description' placeholder='Description'><input type='text' class='cfwarning simple_subscription_popup_tooltip' title='Warning text for the field if it is required, eg.: Description field is mandatory' value='' placeholder='Warning'><input type='text' class='cfminlength simple_subscription_popup_tooltip' title='Minimum character length for required field' value='' placeholder='0'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' title='Check this if the field is mandatory' value='0'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Field' src='"+sspa_params.plugin_url+"/templates/assets/img/delete.png'></div>");
			initialize_tooltips();
	});
  	simplesp(document).on("click", ".add_custom_fields_select", function () {
	var s_id = simplesp(this).parent().parent().attr("id");
	simplesp("#"+s_id+" .custom_field_section").append("<div class='one-custom-field'><input type='text' data-type='select' class='cfid simple_subscription_popup_tooltip' title='ID of select field, eg.: FRUITS' value='' onkeyup=\"this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');\" placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='' title='Name and value pair for custom field, eg.: Select from the list,Apple:apple,Orange:orange,Lemon:lemon' placeholder='Select from the list,Apple:applevalue,Orange:orangevalue,Lemon:lemonvalue' class='longinput'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' title='Check this if the field is mandatory' value='0'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Field' src='"+sspa_params.plugin_url+"/templates/assets/img/delete.png'></div>");
			initialize_tooltips();
	});
  	simplesp(document).on("click", ".add_custom_fields_hidden", function () {
	var s_id = simplesp(this).parent().parent().attr("id");
	simplesp("#"+s_id+" .custom_field_section").append("<div class='one-custom-field'><input type='text' data-type='hidden' class='cfid simple_subscription_popup_tooltip' title='ID of hidden field, eg.: SIGNUP' value='' onkeyup=\"this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');\" placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='' title='Value of the field, eg.: blog name' placeholder='blog name' class='longinput'><div class='emptycheckbox'></div><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Field' src='"+sspa_params.plugin_url+"/templates/assets/img/delete.png'></div>");
			initialize_tooltips();
	});
  	simplesp(document).on("click", ".remove_cfield", function () {
		simplesp(this).parent().remove();
	})
	 	simplesp("body").on( "click", ".global_signup, .autoopen, .atbottom, .boldcontent, .doubleoptin, .updateexisting, .replaceinterests, .onceperuser, .lock, .hidebutton, .boldtitle, .trackforms, .disablemobile, .disablemembers, .sendwelcome, .openwithlink, .once_per_filled, .closewithlayer, .cfrequired, #subscribers-select-all, .subscribers-select",function() {
		if (simplesp(this).val()==0||simplesp(this).val()=="false") {simplesp(this).val("1");simplesp(this).attr("checked","checked");}
		else {simplesp(this).val("0");simplesp(this).removeAttr("checked","");}
	})
	 	simplesp("body").on( "click", ".admincheckbox",function() {
		if (simplesp(this).val()!="1") {simplesp(this).val("1");simplesp(this).attr("checked","checked");}
		else {simplesp(this).val("false");simplesp(this).removeAttr("checked","");}
	})
	
		simplesp("body").on( "click", ".getapiinfo",function(event ) {
		event.preventDefault();
		if (rmdni==false)
			{
			rmdni = true;
			var thiselement = simplesp(this);
			var parentelement = simplesp(this).parent();
			var thisbutton = simplesp(this).parent().html();
			var ssp_id = simplesp(parentelement).parent().parent().parent().parent().parent().attr("id");
		simplesp(this).parent().html('<img width="20" style="margin-left:50px;" src="'+sspa_params.plugin_url+'/templates/assets/img/preloader.gif">');
		var field1 = '', field2 = '', field3 = '';
		if (simplesp(thiselement).attr("data-apiid")=="awebercredentials")
		{
			field1 = simplesp("#"+ssp_id+" .aweber_authorizationcode").val();
		}
		if (simplesp(thiselement).attr("data-apiid")=="benchmarklists")
		{
			field1 = simplesp("#"+ssp_id+" .benchmark_apikey").val();
		}
		if (simplesp(thiselement).attr("data-apiid")=="campaynlists")
		{
			field1 = simplesp("#"+ssp_id+" .campayn_domain").val();
			field2 = simplesp("#"+ssp_id+" .campayn_apikey").val();
		}
		if (simplesp(thiselement).attr("data-apiid")=="constantcontactlists")
		{
			field1 = simplesp("#"+ssp_id+" .constantcontact_apikey").val();
			field2 = simplesp("#"+ssp_id+" .constantcontact_accesstoken").val();
		}
		if (simplesp(thiselement).attr("data-apiid")=="getresponselists")
		{
			field1 = simplesp("#"+ssp_id+" .getresponse_apikey").val();
		}
		if (simplesp(thiselement).attr("data-apiid")=="ymlplists")
		{
			field1 = simplesp("#"+ssp_id+" .ymlp_username").val();
			field2 = simplesp("#"+ssp_id+" .ymlp_apikey").val();
		}
		var data = {
				action: 'ajax_ssp',
				sspcmd: 'getapiinfo',
				field1: field1,
				field2: field2,
				field3: field3,
				id: simplesp(thiselement).attr("data-apiid")
				};
				simplesp.post(sspa_params.admin_url, data, function(response) {
				if (response.indexOf("success")>= 0) 
				{
					simplesp(parentelement).html('<span><strong>SUCCESS</strong></span>');
					setTimeout(function(){simplesp(parentelement).html(thisbutton)},2000);
				}
				else {
						if (response.indexOf("Error") == -1) {
					if (simplesp(thiselement).attr("data-apiid")=="awebercredentials")
					{
						var cred = response.split("-");
							simplesp("#"+ssp_id+" .aweber_consumerkey").val(cred[0]);
							simplesp("#"+ssp_id+" .aweber_consumersecret").val(cred[1]);
							simplesp("#"+ssp_id+" .aweber_accesskey").val(cred[2]);
							simplesp("#"+ssp_id+" .aweber_accesssecret").val(cred[3]);
							simplesp(parentelement).html('<span><strong>SUCCESS</strong></span>');
							setTimeout(function(){simplesp(parentelement).html(thisbutton)},2000);
					}
					else if (simplesp("#"+ssp_id+" ."+simplesp(thiselement).attr("data-apiid")+"_container").length>0)
					{
						if (response.indexOf("Error") == -1) {
						simplesp("#"+ssp_id+" ."+simplesp(thiselement).attr("data-apiid")+"_container").html(response); 
						simplesp(parentelement).html(thisbutton);
						simplesp("body").on( "click", "#"+ssp_id+" ."+simplesp(thiselement).attr("data-apiid")+"_container .getid",function() {
							simplesp("#"+ssp_id+" ."+simplesp(this).attr("data-target")).val(simplesp(this).attr("data-value"));
						})
						 
					}
						else simplesp(parentelement).html(thisbutton+'<span><strong>'+response+'</strong></span>');
					}
					}
					else simplesp(parentelement).html(thisbutton+'<span><strong>'+response+'</strong></span>');
					rmdni = false;
				}
				});
			
			};
			
		});
		simplesp( '#subscribers-select-all' ).click(function (event) {
			if ( simplesp( this ).val() != "1" ) {
				simplesp( '.subscribers-select' ).prop( 'checked', true );
				simplesp( '.subscribers-select' ).val( '1' );
			}
			else {
				simplesp( '.subscribers-select' ).prop( 'checked', false );
				simplesp( '.subscribers-select' ).val( '0' );
			}
		})
		simplesp( '#delete_alls' ).click( function ( event ) {
			if( simplesp( ".subscribers-select").is( ':checked' ) ) {
				simplesp( "#dialog-confirm3" ).dialog( "open" );
			}
			else {
				return false;
			}
		})
		simplesp("body").on( "click", ".save_form",function() {
		if (rmdni==false)
			{
			var ssp_id = simplesp(this).parentsUntil(".main_form_container").parent(".main_form_container").attr("id");
			var buttonspan = simplesp(this).parent();
			var error = false;
			var checker;
			var answers_array = [];
			simplesp("#"+ssp_id+" .signup_error_span").html('');
			if (simplesp("#"+ssp_id+" .font_family").val()!='') {var ff = simplesp("#"+ssp_id+" .font_family").val();}
			else {var ff = '';}
			if (simplesp("#"+ssp_id+" .content_font_family").val()!='') {var cff = simplesp("#"+ssp_id+" .content_font_family").val();}
			else {var cff = '';}
			if (simplesp( "#"+ssp_id+" .autoopen" ).val()==1) {var autoopen = true;}
			else {var autoopen = false;}
			if (simplesp( "#"+ssp_id+" .boldcontent" ).val()==1) {var boldcontent = 'bold';}
			else {var boldcontent = 'normal';}
			if (simplesp( "#"+ssp_id+" .atbottom" ).val()==1) {var atbottom = true;}
			else {var atbottom = false;}
			if (simplesp( "#"+ssp_id+" .boldtitle" ).val()==1) {var boldtitle = 'bold';}
			else {var boldtitle = 'normal';}
			if (simplesp( "#"+ssp_id+" .doubleoptin" ).val()==1) {var doubleoptin = true;}
			else {var doubleoptin = false;}
			if (simplesp( "#"+ssp_id+" .updateexisting" ).val()==1) {var updateexisting = true;}
			else {var updateexisting = false;}
			if (simplesp( "#"+ssp_id+" .replaceinterests" ).val()==1) {var replaceinterests = true;}
			else {var replaceinterests = false;}
			if (simplesp( "#"+ssp_id+" .sendwelcome" ).val()==1) {var sendwelcome = true;}
			else {var sendwelcome = false;}
			if (simplesp( "#"+ssp_id+" .onceperuser" ).val()==1) {var onceperuser = true;}
			else {var onceperuser = false;}
			if (simplesp( "#"+ssp_id+" .lock" ).val()==1) {var lock = true;}
			else {var lock = false;}
			if (simplesp( "#"+ssp_id+" .hidebutton" ).val()==1) {var hidebutton = true;}
			else {var hidebutton = false;}
			if (simplesp( "#"+ssp_id+" .openwithlink" ).val()==1) {var openwithlink = true;}
			else {var openwithlink = false;}
			if (simplesp( "#"+ssp_id+" .once_per_filled" ).val()==1) {var once_per_filled = true;}
			else {var once_per_filled = false;}
			if (simplesp( "#"+ssp_id+" .closewithlayer" ).val()==1) {var closewithlayer = true;}
			else {var closewithlayer = false;}
			if (simplesp( "#"+ssp_id+" .trackforms" ).val()==1) {var trackforms = true;}
			else {var trackforms = false;}
			if (simplesp( "#"+ssp_id+" .disablemobile" ).val()==1) {var disablemobile = true;}
			else {var disablemobile = false;}
			if (simplesp( "#"+ssp_id+" .disablemembers" ).val()==1) {var disablemembers = true;}
			else {var disablemembers = false;}
					var customfsarray = new Array();
					var customfs = {};
					simplesp("#"+ssp_id+" .one-custom-field").each(function( index ) {
						if (simplesp(this).children(".cfid").val()!=''&&simplesp(this).children(".cfname").val())
						{
						customfs = {};
						if (simplesp(this).children(".cfrequired").val()=='1') {var thisreq = 'true';}
						else {var thisreq = 'false';}
						customfs.id = simplesp(this).children(".cfid").val();
						customfs.name = simplesp(this).children(".cfname").val();
						customfs.required = thisreq;
						customfs.type = simplesp(this).children(".cfid").attr("data-type");
						customfs.warning = simplesp(this).children(".cfwarning").val();
						customfs.minlength = simplesp(this).children(".cfminlength").val();
							customfsarray.push(customfs);
						}
					});

			var options = [
			simplesp( "#"+ssp_id+" .simple_subscription_popup_animation_speed_value" ).val().replace("Animation Speed: ","").replace("sec",""),
			autoopen,
			simplesp("#"+ssp_id+" .mode").val(),
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1001").css("background-color"),
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1004").css("background-color"),
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1005").css("background-color"),
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1006").css("background-color"),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_close_button_size_value" ).val().replace("Close Button Size: ",""),
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1002").css("background-color"),
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1003").css("background-color"),
			ff,
			cff,
			simplesp( "#"+ssp_id+" .simple_subscription_popup_content_font_size_value" ).val().replace("Content Font Size: ",""),
			boldcontent,
			simplesp("#"+ssp_id+" .formtitle").val(),
			simplesp("#"+ssp_id+" .formtext").val(),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_vertical_space_value" ).val().replace("Vertical Space: ",""),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_horizontal_space_value" ).val().replace("Horizontal Space: ",""),
			parseFloat(simplesp( "#"+ssp_id+" .simple_subscription_popup_display_timer_value" ).val().replace("Display Timer: ","").replace("sec")),
			simplesp("#"+ssp_id+" .display_style").val(),
			simplesp("#"+ssp_id+" .invalidemail").val(),
			simplesp("#"+ssp_id+" .successsignup").val(),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_border_radius_value" ).val().replace("Border Radius: ",""),
			atbottom,
			simplesp( "#"+ssp_id+" .simple_subscription_popup_font_size_value" ).val().replace("Font Size: ",""),
			boldtitle,
			doubleoptin,
			updateexisting,
			replaceinterests,
			sendwelcome,
			simplesp( "#"+ssp_id+" .listid").val(),
			onceperuser,
			simplesp( "#"+ssp_id+" .simple_subscription_popup_cookie_days_value" ).val().replace("Cookie Days: ",""),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_cmargin_value" ).val().replace("Fields Margin: ",""),
			simplesp("#"+ssp_id+" .mailchimpapikey").val(),
			simplesp("#"+ssp_id+" .notemail").val(),
			simplesp( "#"+ssp_id+" .subscribe_text").val(),
			simplesp( "#"+ssp_id+" .placeholder_text").val(),
			lock,
			hidebutton,
			simplesp("#"+ssp_id+" .animation").val(),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_fcookie_days_value" ).val().replace("Filled Cookie Days: ",""),
			simplesp( "#"+ssp_id+" .simple_subscription_popup_iborderradius_value" ).val().replace("Input Border Radius: ",""),
			simplesp("#"+ssp_id+" .facebookappid").val(),
			simplesp("#"+ssp_id+" .gplusclientid").val(),
			simplesp("#"+ssp_id+" .gplusapikey").val(),
			simplesp("#"+ssp_id+" .bottomline").val(),
			openwithlink,
			once_per_filled,
			closewithlayer,
			customfsarray,
			simplesp("#"+ssp_id+" .simple_subscription_popup_preview1007").css("background-color"),
			simplesp("#"+ssp_id+" .preset").val(),
			simplesp("#"+ssp_id+" .addmoreapi_activecampaign").val(),
			simplesp("#"+ssp_id+" .activecampaign_url").val(),
			simplesp("#"+ssp_id+" .activecampaign_apikey").val(),
			simplesp("#"+ssp_id+" .activecampaign_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_aweber").val(),
			simplesp("#"+ssp_id+" .aweber_authorizationcode").val(),
			simplesp("#"+ssp_id+" .aweber_consumersecret").val(),
			simplesp("#"+ssp_id+" .aweber_accesskey").val(),
			simplesp("#"+ssp_id+" .aweber_accesssecret").val(),
			simplesp("#"+ssp_id+" .aweber_consumerkey").val(),
			simplesp("#"+ssp_id+" .aweber_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_benchmark").val(),
			simplesp("#"+ssp_id+" .benchmark_apikey").val(),
			simplesp("#"+ssp_id+" .benchmark_listid").val(),
			simplesp("#"+ssp_id+" .benchmark_doubleoptin").val(),
			simplesp("#"+ssp_id+" .addmoreapi_campaignmonitor").val(),
			simplesp("#"+ssp_id+" .campaignmonitor_apikey").val(),
			simplesp("#"+ssp_id+" .campayn_listid").val(),
			simplesp("#"+ssp_id+" .campaignmonitor_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_campayn").val(),
			simplesp("#"+ssp_id+" .campayn_domain").val(),
			simplesp("#"+ssp_id+" .campayn_apikey").val(),
			simplesp("#"+ssp_id+" .addmoreapi_constantcontact").val(),
			simplesp("#"+ssp_id+" .constantcontact_apikey").val(),
			simplesp("#"+ssp_id+" .constantcontact_accesstoken").val(),
			simplesp("#"+ssp_id+" .constantcontact_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_freshmail").val(),
			simplesp("#"+ssp_id+" .freshmail_apikey").val(),
			simplesp("#"+ssp_id+" .freshmail_apisecret").val(),
			simplesp("#"+ssp_id+" .freshmail_listhash").val(),
			simplesp("#"+ssp_id+" .addmoreapi_getresponse").val(),
			simplesp("#"+ssp_id+" .getresponse_apikey").val(),
			simplesp("#"+ssp_id+" .getresponse_campaignid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_icontact").val(),
			simplesp("#"+ssp_id+" .icontact_appid").val(),
			simplesp("#"+ssp_id+" .icontact_apiusername").val(),
			simplesp("#"+ssp_id+" .icontact_apipassword").val(),
			simplesp("#"+ssp_id+" .icontact_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_infusionsoft").val(),
			simplesp("#"+ssp_id+" .infusionsoft_apikey").val(),
			simplesp("#"+ssp_id+" .infusionsoft_campaignid").val(),
			simplesp("#"+ssp_id+" .infusionsoft_groupid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_interspire").val(),
			simplesp("#"+ssp_id+" .interspire_username").val(),
			simplesp("#"+ssp_id+" .interspire_usertoken").val(),
			simplesp("#"+ssp_id+" .interspire_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_madmimi").val(),
			simplesp("#"+ssp_id+" .madmimi_username").val(),
			simplesp("#"+ssp_id+" .madmimi_apikey").val(),
			simplesp("#"+ssp_id+" .madmimi_listname").val(),
			simplesp("#"+ssp_id+" .addmoreapi_mailerlite").val(),
			simplesp("#"+ssp_id+" .mailerlite_apikey").val(),
			simplesp("#"+ssp_id+" .mailerlite_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_mailigen").val(),
			simplesp("#"+ssp_id+" .mailigen_apikey").val(),
			simplesp("#"+ssp_id+" .mailigen_listid").val(),
			simplesp("#"+ssp_id+" .mailigen_doubleoptin").val(),
			simplesp("#"+ssp_id+" .addmoreapi_mailjet").val(),
			simplesp("#"+ssp_id+" .mailjet_apikey").val(),
			simplesp("#"+ssp_id+" .mailjet_secretkey").val(),
			simplesp("#"+ssp_id+" .mailjet_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_emma").val(),
			simplesp("#"+ssp_id+" .emma_accountid").val(),
			simplesp("#"+ssp_id+" .emma_publickey").val(),
			simplesp("#"+ssp_id+" .emma_privatekey").val(),
			simplesp("#"+ssp_id+" .addmoreapi_mymail").val(),
			simplesp("#"+ssp_id+" .mymail_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_ontraport").val(),
			simplesp("#"+ssp_id+" .ontraport_appid").val(),
			simplesp("#"+ssp_id+" .ontraport_key").val(),
			simplesp("#"+ssp_id+" .ontraport_tagid").val(),
			simplesp("#"+ssp_id+" .ontraport_sequenceid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_pinpointe").val(),
			simplesp("#"+ssp_id+" .pinpointe_username").val(),
			simplesp("#"+ssp_id+" .pinpointe_usertoken").val(),
			simplesp("#"+ssp_id+" .pinpointe_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_sendinblue").val(),
			simplesp("#"+ssp_id+" .sendinblue_accesskey").val(),
			simplesp("#"+ssp_id+" .sendinblue_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_sendreach").val(),
			simplesp("#"+ssp_id+" .sendreach_key").val(),
			simplesp("#"+ssp_id+" .sendreach_secret").val(),
			simplesp("#"+ssp_id+" .sendreach_userid").val(),
			simplesp("#"+ssp_id+" .sendreach_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_sendy").val(),
			simplesp("#"+ssp_id+" .sendy_installationurl").val(),
			simplesp("#"+ssp_id+" .sendy_apikey").val(),
			simplesp("#"+ssp_id+" .sendy_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_simplycast").val(),
			simplesp("#"+ssp_id+" .simplycast_publickey").val(),
			simplesp("#"+ssp_id+" .simplycast_secretkey").val(),
			simplesp("#"+ssp_id+" .simplycast_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_ymlp").val(),
			simplesp("#"+ssp_id+" .ymlp_username").val(),
			simplesp("#"+ssp_id+" .ymlp_apikey").val(),
			simplesp("#"+ssp_id+" .ymlp_groupid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_youtube").val(),
			simplesp("#"+ssp_id+" .youtube_videoid").val(),
			simplesp("#"+ssp_id+" .youtube_position:checked").val(),
			simplesp("#"+ssp_id+" .youtube_autoplay").val(),
			simplesp("#"+ssp_id+" .youtube_showinfo").val(),
			simplesp("#"+ssp_id+" .youtube_loop").val(),
			simplesp("#"+ssp_id+" .youtube_controls").val(),
			simplesp("#"+ssp_id+" .youtube_videowidth").val(),
			simplesp("#"+ssp_id+" .youtube_videoheight").val(),
			trackforms,
			simplesp("#"+ssp_id+" .elementanimation").val(),
			simplesp("#"+ssp_id+" .addmoreapi_mailpoet").val(),
			simplesp("#"+ssp_id+" .mailpoet_listid").val(),
			simplesp("#"+ssp_id+" .addmoreapi_image").val(),
			simplesp("#"+ssp_id+" .upl_image").val(),
			simplesp("#"+ssp_id+" .image_position:checked").val(),
			simplesp("#"+ssp_id+" .imagewidth").val(),
			simplesp("#"+ssp_id+" .imageheight").val(),
			simplesp("#"+ssp_id+" .simple_subscription_popup_image_opacity_value").val().replace("Image Opacity: ",""),
			simplesp("#"+ssp_id+" .image_repeat").val(),
			simplesp("#"+ssp_id+" .redirecturl").val().trim(),
			disablemobile,
			disablemembers
			];
			if (error==false)
			{
			rmdni = true;
		simplesp(buttonspan).html('<img width="20" style="margin-left:50px;" src="'+sspa_params.plugin_url+'/templates/assets/img/preloader.gif">');
		var data = {
				action: 'ajax_ssp',
				sspcmd: 'save',
				signup_form_id: ssp_id,
				form_name: simplesp(".header_"+ssp_id).text(),
				global_use: simplesp("#"+ssp_id+" .global_signup").val(),
				options: JSON.stringify( options )
				};
				checker = setTimeout(function(){if (simplesp(buttonspan).html()!='<input type="submit" name="save_form" class="save_form button button-primary button-small" value="SAVE">'||simplesp(buttonspan).html()!='<input type="submit" name="save_form" class="save_form button button-primary button-small" value="UPDATE">')
			{
			simplesp(buttonspan).html('<input type="submit" name="save_form" class="save_form button button-primary button-small" value="TRY AGAIN"><span style="margin-left: 35px;line-height:25px;color: #FC0303;">Error during the save process</span>')
			}
			},15000);
				simplesp.post(sspa_params.admin_url, data, function(response) {
				if (response.indexOf("success")>= 0||response.indexOf("updated")>= 0) 
				{
				clearTimeout(checker);
				if (response.indexOf("success")>= 0) var buttontext = "SAVE";
				else var buttontext = "UPDATE";
				simplesp(buttonspan).html('<span style="margin-left: 35px;line-height:25px;"><strong>'+buttontext+'D</strong></span>');
				setTimeout(function(){simplesp(buttonspan).html('<input type="submit" name="save_form" class="save_form button button-primary button-small" value="'+buttontext+'">')},2000);
				}
					rmdni = false;
				});
			
			};
			}
		});
	//customize end
    simplesp( "#dialog-confirm" ).dialog({
      resizable: false,
      height:220,
	  autoOpen: false,
      modal: true,
      buttons: {
        "Delete Form": function() {
		remove_form();
          simplesp( this ).dialog( "close" );
        },
        Cancel: function() {
          simplesp( this ).dialog( "close" );
        }
      }
    });
    simplesp( "#dialog-confirm2" ).dialog({
      resizable: false,
      height:220,
	  autoOpen: false,
      modal: true,
      buttons: {
        "Delete Stats": function() {
		simplesp("#"+statform).submit();
          simplesp( this ).dialog( "close" );
        },
        Cancel: function() {
          simplesp( this ).dialog( "close" );
        }
      }
    });
    simplesp( "#dialog-confirm3" ).dialog({
      resizable: false,
      height:220,
	  width: 400,
	  autoOpen: false,
      modal: true,
      buttons: {
        "Delete": function() {
			delete_selected_subscribers();
        },
        "Cancel": function() {
			simplesp( this ).dialog( "close" );
        }
      }
    });
    simplesp( "#dialog-confirm4" ).on( "submit", function( e ) {
      e.preventDefault();
      duplicate_form();
    });	
	
    simplesp( "#dialog-confirm4" ).dialog({
      resizable: false,
      height: 250,
	  width: 500,
	  autoOpen: false,
      modal: true,
      buttons: [
		{
			text: 'Duplicate',
			click : function( e ) {
				e.preventDefault();
				duplicate_form();
				simplesp( this ).dialog( "close" );
			}
		},
		{
			text: 'Cancel',
			click : function() {
				simplesp( this ).dialog( "close" );
			}
		}
      ]
    }); 		
	simplesp("body").on( "click", ".duplicate_form",function(e) {
		e.preventDefault();
		var attr = simplesp(this).attr("data-formid");
		if (typeof attr !== typeof undefined && attr !== false) {
			actionfl = attr;attr = "";
			var c = 2;
			var newname = simplesp(this).attr("data-formname")+" - "+c;
			while (simplesp("#"+Math.abs(newname.split("").reduce(function(a,b){a=((a<<5)-a)+b.charCodeAt(0);return a&a},0))).length > 0) {
				newname = simplesp(this).attr("data-formname")+" - "+c;
				c++;
			}
			simplesp("#dform_name").val(newname);
		}
		simplesp( "#dialog-confirm4" ).dialog( "open" );
	})
	function duplicate_form() {
			if (simplesp( "#" + Math.abs( simplesp( "#dform_name" ).val().split( "" ).reduce(
				function( a, b ){
					a = ( ( a << 5 ) - a ) + b.charCodeAt( 0 );
					return a&a
				}, 0 ) ) ).length > 0 ) {
				simplesp( ".duplicate-notice" ).css( "display", "block" );
			}
			else {
				if ( actionfl != false ) {
					var data = {
						action: 'ajax_ssp',
						sspcmd: 'duplicate',
						signup_form_id: actionfl,
						form_name: simplesp( "#dform_name" ).val(),
						form_nid : Math.abs(simplesp("#dform_name").val().split("").reduce(function(a,b){a=((a<<5)-a)+b.charCodeAt(0);return a&a},0))
						};
						simplesp.post( sspa_params.admin_url, data, function( response ) {
							if ( response.toLowerCase().indexOf( "duplicated" ) >= 0 ) {
								window.location.href = sspa_params.adminpage_url + "&result=duplicated";
							}
							else {
								window.location.href = sspa_params.adminpage_url + "&result=fail&reason=" + response;
							}
						});			
				}
			}
	}
	function delete_selected_subscribers() {
		var delparts = [];
		simplesp( '.subscribers-select' ).each( function( index ) {
			if ( simplesp( this ).val() == '1' ) {
				var thisid = simplesp( this ).attr( "id" ).split( "-" );
				if ( typeof thisid[ 1 ] != undefined ) {
					delparts.push( thisid[ 1 ] );
				}
			}
		})
		simplesp( "body" ).append( "<form id='delete_subscribers_form' method='post' name='delete_subscribers_form'><input type='hidden' name='delete_subscribers' value='" + JSON.stringify( delparts ) + "'></form>" );
		simplesp( "#delete_subscribers_form" ).submit();
	}
	simplesp("body").on( "click", ".delete_form",function(event) {
		event.preventDefault();
		statform = simplesp(this).attr("data-formid");
		buttonspan_global = simplesp(this).parent();
		simplesp( "#dialog-confirm" ).dialog( "open" );
	})
	
	simplesp("body").on( "click", ".reset_ssfp_stats",function(event) {
		event.preventDefault();
		statform = simplesp(this).attr("data-formid");
		simplesp( "#dialog-confirm2" ).dialog( "open" );
	})
	
	function remove_form()
{
		var ssp_id = simplesp(buttonspan_global).parent().parent().attr("id");
		if ( statform != '' ) {
			ssp_id = statform;
		}
		var parent = simplesp("#"+ssp_id);
		var head = parent.prev('h3');
					rmdni = true;
			var data = {
				action: 'ajax_ssp',
				sspcmd: 'delete',
				signup_form_id: ssp_id
				};
				simplesp.post(sspa_params.admin_url, data, function( response ) {
					rmdni = false;
					if ( statform != '' && response == 'deleted' ) {
						window.location.href = sspa_params.adminpage_url + "&result=deleted";
					}
					if ( statform != '' && response != 'deleted' ) {
						window.location.href = sspa_params.adminpage_url + "&result=fail";
					}
				});

		parent.add(head).fadeOut('slow',function(){
		simplesp(this).remove();
		simplesp('html, body').animate({scrollTop: "0px"}, 1000, 'easeOutCirc',function(){simplesp("#ssp_name").focus();});
		});
}
	
	function initialize_tooltips()
	{
		simplesp(".simple_subscription_popup_tooltip").tooltip({
			  content: function () {
				  return simplesp(this).prop('title');
			  },
			  hide: { effect: "explode", duration: 0 }
		  });	
	}

	function get_random_color() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.round(Math.random() * 15)];
		}
		return color;
	}
		if (simplesp("#simple_subscription_popup_stats .ssfp-graph").length>0)
		{
			var chartdatas = JSON.parse(simplesp("#simple_subscription_popup_stats .ssfp-graph .graph_params").text());
			var pieData = [];
			var charttype = simplesp("#simple_subscription_popup_stats .ssfp-graph").attr("data-chart");
			if (charttype=="pie"||charttype=="polar")
			{
				simplesp.each(chartdatas, function (i, elem) {
					pieData.push({value: elem[1],color:get_random_color(),highlight: get_random_color(),label: elem[0]})
				});
			if (charttype=="pie") window.modalSurveyChart = new Chart(jQuery("#simple_subscription_popup_stats .ssfp-graph canvas")[0].getContext("2d")).Pie(pieData);
			if (charttype=="polar") window.modalSurveyChart = new Chart(jQuery("#simple_subscription_popup_stats .ssfp-graph canvas")[0].getContext("2d")).PolarArea(pieData);
			}
			if (charttype=="bar")
			{
			var dset = [], fillColor = get_random_color(), strokeColor = get_random_color(), highlightFill = get_random_color(), highlightStroke = get_random_color(), labs = [];
			simplesp.each(chartdatas, function (e, el) {
				labs.push(el[0]);
				dset.push(el[1]);
			});
			barChartData = {
					labels : labs,
					datasets : 
					[
						{
						fillColor : fillColor,
						strokeColor : '#000',
						highlightFill: highlightFill,
						highlightStroke: highlightStroke,
						data : dset
						}
					]
				}
			if (charttype=="bar") window.modalSurveyChart = new Chart(jQuery("#simple_subscription_popup_stats .ssfp-graph canvas")[0].getContext("2d")).Bar(barChartData,{barStrokeWidth : 1});
			}
		}
	simplesp("#wpbody-content .wrap").css("visibility","visible");
	simplesp("#screen_preloader").fadeOut("slow",function(){simplesp(this).remove();});
	simplesp('html, body').animate({scrollTop: "0px"}, 1000, 'easeOutCirc',function(){simplesp("#ssp_name").focus();});
})
jQuery(document).ready( function () {
	if ( sspa_params.dtables == "true" ) {
		function initialize_datatables() {
			jQuery('.ssfp-table-subscribers').DataTable({
					"dom": '<"ssfprotoolbar">T<"clear">lBfrtip',
					"buttons": [
					{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5]
					}},
					{
					extend: 'excelHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5]
					}},
					{
					extend: 'csvHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5]
					}},
					{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5]
					}},
					{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5]
					}},
					], 
					"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }], 
					"aoColumnDefs": [{ type: 'usdate', targets: 5 }], 
					"order": [[ 1, "desc" ]]
					});
			jQuery('.ssfp-table-link').DataTable({
					"dom": '<"ssfprotoolbar">T<"clear">lBfrtip',
					"buttons": ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'], 
					"order": [[ 0, "desc" ]]
					});
			jQuery('.ssfp-table-form').DataTable({
					"dom": '<"ssfprotoolbar">T<"clear">lBfrtip',
					"buttons": ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'], 
					"order": [[ 0, "desc" ]]
					});
			jQuery('.ssfp-table-date').DataTable({
					"dom": '<"ssfprotoolbar">T<"clear">lBfrtip',
					"buttons": ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'], 
					"order": [[ 0, "desc" ]], 
					"aoColumnDefs": [{ type: 'usdate', targets: 0 }], 
					});
		}
		
		function get_random_color() {
			var letters = '0123456789ABCDEF'.split('');
			var color = '#';
			for (var i = 0; i < 6; i++ ) {
				color += letters[Math.round(Math.random() * 15)];
			}
			return color;
		}
		initialize_datatables();
		jQuery("div.ssfprotoolbar").html('<a href="'+sspa_params.madmin_url+'admin.php?page=simple_signup_pro_stats"class="DTTT_button DTTT_button_copy">Stats by Links</a><a href="'+sspa_params.madmin_url+'admin.php?page=simple_signup_pro_stats&stat=form" class="DTTT_button DTTT_button_copy">Stats by Forms</a><a href="'+sspa_params.madmin_url+'admin.php?page=simple_signup_pro_stats&stat=date" class="DTTT_button DTTT_button_copy">Stats by Date</a>');
		if (sspa_params.ganalytics!='')
		{
				var data = {
					action: 'ajax_ssp',
					sspcmd: 'analytics',
					type: sspa_params.ganalytics
					};
					jQuery.post(sspa_params.admin_url, data, function(response) {
						if (response.indexOf("Error") == -1) 
						{
		jQuery("#stat_with_ganalytics").html(response);
		initialize_datatables();
							jQuery("div.ssfprotoolbar").html('<a href="'+sspa_params.madmin_url+'admin.php?page=simple_signup_pro_stats"class="DTTT_button DTTT_button_copy">Stats by link</a><a href="'+sspa_params.madmin_url+'admin.php?page=simple_signup_pro_stats&stat=form" class="DTTT_button DTTT_button_copy">Stats by form</a><a href="'+sspa_params.madmin_url+'admin.php?page=simple_signup_pro_stats&stat=date" class="DTTT_button DTTT_button_copy">Stats by date</a>');
						if (jQuery("#simple_subscription_popup_stats .ssfp-graph").length>0)
						{
							var chartdatas = JSON.parse(jQuery("#simple_subscription_popup_stats .ssfp-graph .graph_params").text());
							var pieData = [];
							var charttype = jQuery("#simple_subscription_popup_stats .ssfp-graph").attr("data-chart");
							if (charttype=="pie"||charttype=="polar")
							{
								jQuery.each(chartdatas, function (i, elem) {
									pieData.push({value: elem[1],color:get_random_color(),highlight: get_random_color(),label: elem[0]})
								});
							if (charttype=="pie") window.modalSurveyChart = new Chart(jQuery("#simple_subscription_popup_stats .ssfp-graph canvas")[0].getContext("2d")).Pie(pieData);
							if (charttype=="polar") window.modalSurveyChart = new Chart(jQuery("#simple_subscription_popup_stats .ssfp-graph canvas")[0].getContext("2d")).PolarArea(pieData);
							}
							if (charttype=="bar")
							{
							var dset = [], fillColor = get_random_color(), strokeColor = get_random_color(), highlightFill = get_random_color(), highlightStroke = get_random_color(), labs = [];
							jQuery.each(chartdatas, function (e, el) {
								labs.push(el[0]);
								dset.push(el[1]);
							});
							barChartData = {
									labels : labs,
									datasets : 
									[
										{
										fillColor : fillColor,
										strokeColor : '#000',
										highlightFill: highlightFill,
										highlightStroke: highlightStroke,
										data : dset
										}
									]
								}
							if (charttype=="bar") window.modalSurveyChart = new Chart(jQuery("#simple_subscription_popup_stats .ssfp-graph canvas")[0].getContext("2d")).Bar(barChartData,{barStrokeWidth : 1});
							}
						}
					}
			});		
		}
		jQuery.fn.dataTableExt.oSort['usdate-asc']  = function(a,b) {
		var usDatea = a.split( '-' );
		var usDateb = b.split( '-' );
		var usDateac = usDatea[2].split( ' ' );
		if ( usDateac[ 1 ] != undefined ) 
		{
			var usDatead = usDateac[1].split( ':' );
			var usDatebc = usDateb[2].split( ' ' );
			var usDatebd = usDatebc[1].split( ':' );
			usDatea[3] = usDatead[ 0 ] + usDatead[ 1 ];
			usDateb[3] = usDatebd[ 0 ] + usDatebd[ 1 ];
		}
		else {
			var usDateac = ["","",""];
			var usDatebd = ["","",""];
			var usDatead = ["","",""];
			var usDatebd = ["","",""];
		}
		var x = usDateac[0] + usDatea[1] + usDatea[0] + usDatea[3];
		var y = usDateac[0] + usDateb[1] + usDateb[0] + usDateb[3];

		return ((x < y) ? -1 : ((x > y) ?  1 : 0));
		};

		jQuery.fn.dataTableExt.oSort['usdate-desc'] = function(a,b) {
			var usDatea = a.split( '-' );
			var usDateb = b.split( '-' );
			var usDateac = usDatea[2].split( ' ' );
			if ( usDateac[ 1 ] != undefined ) 
			{
				var usDatead = usDateac[1].split( ':' );
				var usDatebc = usDateb[2].split( ' ' );
				var usDatebd = usDatebc[1].split( ':' );
				usDatea[3] = usDatead[ 0 ] + usDatead[ 1 ];
				usDateb[3] = usDatebd[ 0 ] + usDatebd[ 1 ];
			}
			else {
				var usDateac = ["","",""];
				var usDatebd = ["","",""];
				var usDatead = ["","",""];
				var usDatebd = ["","",""];
			}
			var x = usDateac[0] + usDatea[1] + usDatea[0] + usDatea[3];
			var y = usDateac[0] + usDateb[1] + usDateb[0] + usDateb[3];

			return ((x < y) ? 1 : ((x > y) ?  -1 : 0));
		};
		jQuery( '.simple-signup-list-table-saved-forms' ).DataTable({ "dom": 'lfrtip', "order": [[ 2, "desc" ]], "aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ 8 ] }
	   ] });
   }
} );
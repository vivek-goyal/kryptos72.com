;(function ( $, window, document, undefined ) {
		/** Create the defaults once **/
		var pluginName = "simplesignuppro",
				defaults = {
					animtime:					0.4,
					animation:					'slide',
					autoopen:					true,
					mode:						'mailchimp',
					customfields:				[],
					facebook_appid:				'',
					googleplus_clientid:		'',
					googleplus_apikey:			'',		
					customfieldsmargin:			'0px',
					bgcolor:					'#000',
					lockbgcolor:				'#fff',
					buttonbgcolor:				'#c7122f',
					buttoncolor:				'#ffffff',	
					closecolor:					'#d71b1b',	
					closefontsize:				'18px',
					color:						'#d71b1b',
					contentcolor:				'#ccc',	
					fontfamily:					'Amaranth',
					contentfontfamily:			'Amaranth',
					openwithlink:				true,
					contentfontsize:			'13px',
					contentweight:				'normal',
					title:			    		'Subscribe to our Updates',
					bottomtitle:		  		'',
					text:						'We will only send notification when we releasing <strong>FREE</strong> and Premium <strong>Plugins, Themes</strong> or Updates for any of our existing products.',
					vspace:						"60px",
					hspace:						"10px",
					timer:						1000,
					position:					'CenterCenter',
					invalid_address:			'INVALID ADDRESS',
					signup_success:				'SIGNUP SUCCESS!',
					borderradius:				"3px",
					inputborderradius:			"3px",
					openbottom:					false,
					fontsize:					'20px',
					fontweight:					'bold',
					double_optin:				false,
					update_existing:			true,
					replace_interests:			false,
					send_welcome:				false,
					mailchimp_listid:			false,
					once_per_user:				false,
					cookie_days:				999,
					once_per_filled:			false,
					filled_cookie_days:			999,		
					subscribe_text:				'Get Updates',
					placeholder_text:			'Enter your email address',
					path:						'php/handler.php',
					lock:						true,
					closewithlayer:				true,
					hideclose:					false,
					preset:						'default',
					trackform:					true,
					yaplay:						true,
					ypos:						4,
					embed:						false,
					elemanimation:				"disabled",
					cdatas1:					"",
					cdatas2:					"",
					width:						"",
					visible:					"",
					redirecturl:				"",
					disablemobile:				false
		};
	/** The actual plugin constructor **/
	function Plugin ( element, options ) {
			this.element = element;
			this.settings = $.extend( {}, defaults, options );
			this._defaults = defaults;
			this._name = pluginName;
			this.init();
	}

	/** Avoid Plugin.prototype conflicts **/
	$.extend( Plugin.prototype, {
			init: function () {
		var presets = new Array(), opened = false, once_opened = false, lastScrollTop = 0, blocker = 0, fontstoappend = '', socialemail = '', locker = '', closebutton = '', bt = '', sociallogin = '<div class="ssp_social_login">',leftstart, topstart, leftend, topend, side, openpos, error = 0, data = {}, customdatas = {}, customfieldsarray = new Array(), fieldname, thisdata, thisval, cmail, exdate, c_value, now, time, c_start, c_end, images, subitems = [], loaded_images_count = 0, closed = false, subelement, uniquenumber, warningclass, i, aspectratio, protocol;
		var preloader = '<img width="30" height="10" title="" alt="" src="data:image/gif;base64,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" />';
		protocol = ('https:' == window.location.protocol ? 'https://' : 'http://');
		presets[ 'default' ] = { 
			customfieldsmargin:"7px", bgcolor:"rgb(254, 254, 254)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(199, 28, 9)",buttoncolor:"rgb(247, 247, 247)",closecolor:"rgb(0, 0, 0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(93, 93, 93)",fontfamily:"Trade Winds",contentfontfamily:"Quattrocento Sans",contentfontsize:"12px",borderradius:"12px",inputborderradius:"0px",fontsize:"20px"
		  };
		presets[ 'business' ] = { 
			customfieldsmargin:"7px", bgcolor:"rgb(254, 254, 254)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(153, 153, 153)",buttoncolor:"rgb(0, 0, 0)",closecolor:"rgb(153, 153, 153)",closefontsize:"11px",color:"rgb(0, 0, 0)",contentcolor:"rgb(153, 153, 153)",fontfamily:"Source Sans Pro",contentfontfamily:"Source Sans Pro",contentfontsize:"12px",borderradius:"0px",inputborderradius:"0px",fontsize:"20px"
		  };	
		presets[ 'baby' ] = { 
			customfieldsmargin:"5px", bgcolor:"rgb(241, 174, 245)",lockbgcolor:"rgb(255, 255, 255)",buttonbgcolor:"rgb(0, 0, 0)",buttoncolor:"rgb(242, 111, 97)",closecolor:"rgb(0, 0, 0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(242, 111, 97)",fontfamily:"Sofia",contentfontfamily:"Sofadi One",contentfontsize:"12px",borderradius:"71px",inputborderradius:"5px",fontsize:"20px"
		  };	
		presets[ 'dating' ] = { 
			customfieldsmargin:"5px", bgcolor:"rgb(144, 26, 34)",lockbgcolor:"rgb(251, 251, 251)",buttonbgcolor:"rgb(0, 0, 0)",buttoncolor:"rgb(255, 255, 255)",closecolor:"rgb(0,0,0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(249, 236, 235)",fontfamily:"Aladin",contentfontfamily:"Sofadi One",contentfontsize:"12px",borderradius:"13px",inputborderradius:"0px",fontsize:"47px"
		  };	
		presets[ 'technology' ] = { 
			customfieldsmargin:"5px", bgcolor:"rgb(84, 168, 192)",lockbgcolor:"rgb(86, 86, 86)",buttonbgcolor:"rgb(198, 198, 198)",buttoncolor:"rgb(0, 0, 0)",closecolor:"rgb(198, 198, 198)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(86, 86, 86)",fontfamily:"Aldrich",contentfontfamily:"Alef",contentfontsize:"11px",borderradius:"0px",inputborderradius:"0px",fontsize:"31px" 
		  };	
		presets[ 'finance' ] = { 
			customfieldsmargin:"5px", bgcolor:"rgb(253, 253, 253)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(0, 0, 0)",buttoncolor:"rgb(227, 242, 97)",closecolor:"rgb(235, 232, 232)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(0, 0, 0)",fontfamily:"Signika",contentfontfamily:"Ubuntu",contentfontsize:"12px",borderradius:"0px",inputborderradius:"20px",fontsize:"20px"
		  };
		var options = this.settings;
		if ( options.disablemobile == true && ( /Android|webOS|MeeGo|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) ) {
			return true;
		}
		if ( ( parseInt( options.timer ) > 0 ) && ( parseInt( options.timer ) < 1000 ) ) {
			options.timer = options.timer * 1000;
		}
		var element = jQuery(this.element);
		var simplesignuppro = "#" + this.element.id;
		options.customfields = JSON.parse( options.customfields );
		if ( options.facebook_appid != '' ) {
			 window.fbAsyncInit = function() {
				FB.init({
				  appId      : options.facebook_appid,
				  autoLogAppEvents : true,
				  xfbml      : true,
				  version    : 'v2.11'
				});
				FB.Event.subscribe( 'auth.statusChange', function( r ) {
					options.facebook_html = jQuery( simplesignuppro + ' .ssp_fblogin' ).html();
					jQuery( simplesignuppro + ' .ssp_fblogin' ).html( preloader );
						if ( r.authResponse ) {
							if ( FBLoginCallback ) {
								FBLoginCallback( r );
							}
						}
					});
			};
			function FBLoginCallback( r ) {
				if ( r.status === 'connected' ) {
					FB.api('/me?fields=id,email,name', function( fbUser ) {
						socialemail = fbUser.email;
						jQuery( simplesignuppro + ' .ssp_email' ).val( socialemail );
						jQuery( simplesignuppro + ' .ssp_fblogin' ).html( options.facebook_html );
						//jQuery( simplesignuppro + ' .mc_embed_signup .subscribe' ).trigger( "click" );
					});
				}
			};
			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		}
		
		if ( options.googleplus_clientid != '' && options.googleplus_apikey != '' ) {
			(function() {
				var po = document.createElement('script'); 
				po.type = 'text/javascript'; 
				po.async = true;
				po.src = 'https://apis.google.com/js/client:platform.js?onload=renderPlusone';
				var s = document.getElementsByTagName('script')[0]; 
				s.parentNode.insertBefore(po, s);
			  } (document));
				   window.renderPlusone = function() {
					   if ( typeof gapi != undefined ) {
							gapi.client.setApiKey( options.googleplus_apikey );
							gapi.client.load( 'plus', 'v1', function() {} );
							gapi.signin.render( jQuery( simplesignuppro + ' .googleplusbtn' ), {
							  'clientid': options.googleplus_clientid,
							  'cookiepolicy': 'single_host_origin',
							  'requestvisibleactions': 'http://schema.org/AddAction',
							  'scope': 'profile email'
							});
							var authorizeButton = jQuery( simplesignuppro + ' .googleplusbtn' );
							authorizeButton.onclick = handleAuthClick;
					  }
				  }
				 window.handleAuthResult = function( authResult )  {
					var authorizeButton = jQuery( simplesignuppro + ' .googleplusbtn' );
					if ( authResult && ! authResult.error ) {
					  makeApiCall();
					 } else {
					  handleAuthClick();
					}
				 }
				jQuery( document ).on( 'click', simplesignuppro + ' .googleplusbtn', function() {
					handleAuthClick();
				})
				 function handleAuthClick(event) {
					jQuery( simplesignuppro + ' .ssp_gplogin' ).html( preloader );
					gapi.auth.authorize({
						client_id: options.googleplus_clientid, 
						scope: 'profile email', 
						cookiepolicy: 'single_host_origin', 
						immediate: false 
						}, handleAuthResult );
					return false;
				};
				function makeApiCall() {
					gapi.client.load('plus', 'v1', function() {
					  var request = gapi.client.plus.people.get({
						'userId': 'me'
					  });
						request.execute(function (resp)
						{
						  var email = '';
							if( resp[ 'emails' ] )
							{
								for(i = 0; i < resp[ 'emails' ].length; i++)
								{
									if( resp[ 'emails' ][ i ][ 'type' ] == 'account' )
									{
										email = resp[ 'emails' ][ i ][ 'value' ];
									}
								}
							}
						   if ( typeof email != "undefined" ) {
								socialemail = email;
								jQuery( simplesignuppro + ' .ssp_email').val( socialemail );
								jQuery( simplesignuppro + ' .mc_embed_signup .subscribe' ).trigger( "click" );
							}
						});
					});
				};
		}
		function isUrlValid( url ) {
			return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
		}
		function set_elem_animations() {
			subitems = [];
				if ( options.elemanimation != "" || options.elemanimation != "disabled" || options.elemanimation != "false" ) {
						subitems.push( jQuery( simplesignuppro + " .inside-form h2" ) );
						subitems.push( jQuery( simplesignuppro + " .mc_embed_close" ) );
						subitems.push( jQuery( simplesignuppro + " .inside-form>p" ) );
						jQuery.each( jQuery( simplesignuppro + " .inside-form .signup" ).children(), function( index, value ) {
							subitems.push( jQuery( value ) );
						} )
							subitems.push( jQuery( simplesignuppro + " .inside-form .ssp_social_login" ) );
							subitems.push( jQuery( simplesignuppro + " .inside-form .ssp-bottom" ) );
						jQuery.each( subitems , function( index, value ) {
							jQuery( value ).addClass( options.elemanimation + "-default" + Math.floor( ( Math.random() * 4 ) + 1 ) );
						} )
						if ( options.elemanimation.indexOf( '-random' ) >= 0 ) shuffle( subitems );
				}
		}
		function set_anim_time( time, delay ) {
			element.css({"-webkit-transition": "all " + time + "s ease-in " + parseInt( delay / 1000 ) + "s","-moz-transition": "all " + time + "s ease-in " + parseInt( delay / 1000 ) + "s", "-o-transition": "all " + time + "s ease-in " + parseInt( delay / 1000 ) + "s", "-ms-transition": "all " + time + "s ease-in " + parseInt( delay / 1000 ) + "s","transition": "all " + time + "s ease-in " + parseInt( delay / 1000 ) + "s",'-webkit-animation-duration': time + "s",'-webkit-animation-timing-function': "linear",'-moz-animation-duration': time + "s",'-ms-animation-duration': time + "s",'-o-animation-duration': time + "s", 'animation-duration': time + "s",'-webkit-animation-delay': parseInt( delay / 1000 ) + "s",'-moz-animation-delay': parseInt( delay / 1000 ) + "s",'-ms-animation-delay': parseInt( delay / 1000 ) + "s",'-o-animation-delay': parseInt( delay / 1000 ) + "s", 'animation-delay': parseInt( delay / 1000 ) + "s"});	
		}
		function open_popup() {
			if ( jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).length > 0 && options.yaplay != '' ) {
				if ( options.yaplay == true ) {
					setTimeout( function() {
						jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "src", jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "src" ).replace( "autoplay=0", "autoplay=1" ) );
					}, parseInt( options.timer ) );
				}
			}
			element.css( "z-index", "99999" );
			element.bind( 'animationstart webkitAnimationStart MSAnimationStart oAnimationStart', function ( e ) {
				if ( options.lock != "" ) {
							jQuery( "#ssp_locker" ).css({ "display": "block", "z-index": "99" });
				}				 
			});
			 element.bind( 'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function ( e ) {
				if ( options.lock != "" ) {
						jQuery( "#ssp_locker" ).css({ "z-index": "99995" });
				}				 
				jQuery.each( subitems , function( index, value ) {
					jQuery( value ).css({
						"-webkit-transition": "all .4s ease-in " + parseInt( index ) * 0.3 + "s",
						"-moz-transition": "all .4s ease-in " + parseInt( index ) * 0.3 + "s",
						"-o-transition": "all .4s ease-in " + parseInt( index ) * 0.3 + "s",
						"-ms-transition": "all .4s ease-in " + parseInt( index ) * 0.3 + "s",
						"transition": "all .4s ease-in " + parseInt( index ) * 0.3 + "s",
						"-webkit-transition-timing-function": "cubic-bezier(0.64, 0.57, 0.67, 1.53)",
						"-ms-transition-timing-function": "cubic-bezier(0.64, 0.57, 0.67, 1.53)",
						"-o-transition-timing-function": "cubic-bezier(0.64, 0.57, 0.67, 1.53)",
						"-moz-transition-timing-function": "cubic-bezier(0.64, 0.57, 0.67, 1.53)",
						"transition-timing-function":  "cubic-bezier(0.64, 0.57, 0.67, 1.53)"
					});
				} )
				jQuery.each( subitems , function( index, value ) {
					jQuery( value ).addClass( options.elemanimation + "-start" );
				})
				setTimeout( function() {
					element.removeClass( options.animation );
					set_anim_time( options.animtime, options.timer );
				}, 100);
				if ( once_opened != true ) {
					set_anim_time( 0, 0 );
				}
				if ( options.animation.indexOf( 'slide' ) >= 0 ) {
					 if ( options.position.indexOf( "right" ) >= 0 ) {
						element.css({
							"opacity": "1",
							"z-index": "99999",
							"right": leftend,
							"top": topend
						});
					 }
					 else {
						element.css({
							"opacity": "1",
							"z-index": "99999",
							"left": leftend,
							"top": topend
						});
					 }
				}
				if ( ( element.height() + parseInt( element.css( "top" ).replace( "px", "" ) ) ) > jQuery( window ).height() && options.embed == "" ) {
					element.css({ "position": "absolute" });
				}
				setTimeout( function() {
					element.unbind( 'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd' );
					element.unbind( 'animationstart webkitAnimationStart MSAnimationStart oAnimationStart' );
				}, 100);
			})
				element.css("opacity", "1");
				if ( side == "left" ) {
					element.css( "left", leftend );
				}
				if ( side == "right" ) {
					element.css( "right", leftend );
				}
					element.css( "top", topend );
			set_anim_time( options.animtime, options.timer );
			element.addClass( options.animation );
			opened = true;
			once_opened = true;
			if ( options.trackform != "" && options.preview == "" ) {
				jQuery( window ).load(function() {
					if ( typeof window.ga != "undefined" ) {
						window.ga('send', 'event', 'MailChimper PRO', options.formid, document.URL);
					}
					else {
						if ( typeof window._gaq != "undefined" ) {
							window._gaq.push( ['_trackEvent', 'MailChimper PRO', options.formid, document.URL] );
						}
					}
				})
			}
			if ( options.once_per_user != "" ) {
				setCookie( 'ssp', '1', options.cookie_days, 'days' );
			}
		}
		function close_popup() {
			if ( opened != true ) {
				return false;
			}
			if ( options.embed != "" ) {
				set_anim_time( options.animtime, 0 );
				element.slideUp( 800 );
				closed = true;
				return;
			}
			if ( options.elemanimation == "" ) {
				set_anim_time( options.animtime, 0 );
				subitems = [];
			}
			setTimeout( function() {
				set_anim_time( options.animtime, 0 );
				if ( options.animation.indexOf( 'slide' ) >= 0 ) {
					if ( options.position.indexOf( "right" ) >= 0 ) {
						element.css({ "right": leftstart, "top": topstart, "opacity": "0" });
					}
					else {
						element.css({ "left": leftstart, "top": topstart, "opacity": "0" });
					}
				}
				element.addClass( options.animation + '-out' );
				if ( options.lock != "" ) {
					jQuery( "#ssp_locker" ).css( "display", "none" );
				}
			}, parseInt( ( subitems.length - 1 ) * 300 ) );
			element.bind( 'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function ( e ) {
				set_anim_time( 0, 0 );
				jQuery.each( subitems , function( index, value ) {
					jQuery( value ).removeClass( options.elemanimation + "-end1 " + options.elemanimation + "-end2 " + options.elemanimation + "-end3 " + options.elemanimation + "-end4 " + options.elemanimation + "-default1 " + options.elemanimation + "-default2 " + options.elemanimation + "-default3 " + options.elemanimation + "-default4 " + options.elemanimation + "-start" );
				} )
				element.css({
					"opacity":"0", "z-index": "-1"
				});
				if ( jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).length > 0 ) {
					jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "src", jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "src" ).replace( "autoplay=1", "autoplay=0" ) );
				}
				if ( options.animation.indexOf( 'slide' ) >= 0 ) {
					if ( options.position.indexOf( "right" ) >= 0 ) {
						element.css({
							"right": leftstart,
							"top": topstart
						});
					 }
					 else {
						element.css({
							"left": leftstart,
							"top": topstart
						});
					 }
				}
				setTimeout( function() {
					element.removeClass( options.animation + '-out' ).unbind( 'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd' );
					set_elem_animations();
				}, 100);
			})				
			jQuery.each( subitems , function( index, value ) {
				jQuery( value ).addClass( options.elemanimation + "-end"+Math.floor((Math.random() * 4) + 1) );
			} )
		}
		function shuffle( array ) {
		  var currentIndex = array.length, temporaryValue, randomIndex ;
		  while ( 0 !== currentIndex ) {
			randomIndex = Math.floor( Math.random() * currentIndex );
			currentIndex -= 1;
			temporaryValue = array[ currentIndex ];
			array[ currentIndex ] = array[ randomIndex ];
			array[ randomIndex ] = temporaryValue;
		  }

		  return array;
		}
	/*						Email Validation Function			*/
		function isValidEmailAddress( emailAddress ) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			return pattern.test( emailAddress );
		};
		function setCookie( c_name, value, dduntil, mode ) {
			if ( mode == 'days' ) {
				exdate = new Date();
				exdate.setDate( exdate.getDate() + parseInt( dduntil ) );
				c_value = escape( value ) + ( ( dduntil == null ) ? "" : "; expires=" + exdate.toUTCString() ) + "; path=/";
				document.cookie = c_name + "=" + c_value;		
			}
			if ( mode == 'minutes' ) {
				now = new Date();
				time = now.getTime();
				time += parseInt( dduntil );
				now.setTime( time );
				c_value = escape( value ) + ( ( dduntil == null ) ? "" : "; expires=" + now.toUTCString() ) + "; path=/";
				document.cookie = c_name + "=" + c_value;
			}
		}
		function getCookie( c_name ) {
			c_value = document.cookie;
			c_start = c_value.indexOf( " " + c_name + "=" );
			if ( c_start == -1 ) {
				c_start = c_value.indexOf( c_name + "=" );
			}
			if ( c_start == -1 ) {
				c_value = null;
			}
			else {
				c_start = c_value.indexOf( "=", c_start ) + 1;
				c_end = c_value.indexOf( ";", c_start );
				if ( c_end == -1 ) {
					c_end = c_value.length;
				}
				c_value = unescape( c_value.substring( c_start, c_end ) );
			}
			return c_value;
		}
		if (typeof presets[ options.preset ] !== 'undefined' ) {
			options = jQuery.extend( {}, options, presets[ options.preset ] ); 
		}
		if ( ( options.lock != "" ) && ( jQuery( "#ssp_locker" ).length == 0 ) ) {
			locker = '<div id="ssp_locker"></div>';
		}
		if ( options.hideclose == "" ) {
			closebutton = '<i class="mc_embed_close fa fa-times"></i>';
		}
		if ( options.fontfamily != '' && options.fontfamily != "undefined" ) {
			fontstoappend = options.fontfamily + ":400,700";
		}
		if ( options.contentfontfamily != '' && options.contentfontfamily != "undefined" ) {
			if ( fontstoappend != "" ) {
				fontstoappend += "|"+options.contentfontfamily+":400,700";
			}
			else {
				fontstoappend = options.contentfontfamily;
			}
		}
		if ( fontstoappend != "" ) {
				if ( !jQuery( "link[href='" + protocol + "fonts.googleapis.com/css?family=" + fontstoappend + "']" ).length ) {
					jQuery( 'head' ).append( '<link rel="stylesheet" href="' + protocol + 'fonts.googleapis.com/css?family=' + fontstoappend + '" type="text/css" />' );
				}
		}
		if ( !jQuery( "link[href='" + protocol + "netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css']" ).length ) {
			jQuery('head').append('<link rel="stylesheet" href="' + protocol + 'netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" type="text/css" />');
		}
		var sspdiv = '<div class="mc_embed_signup"><div class="mc_embed_signup_inner"><form onsubmit="return false;" method="post" class="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate><div class="inside-form"><h2>' + options.title + '</h2><p>' + options.text + '</p><div class="mc-field-group"><div class="signup">';
		var sspdiv2 = "";
		if ( options.customfields != '' ) {
			jQuery.each( options.customfields, function( index, value ) {
				if ( value.type == undefined || value.type == "text" ) sspdiv += '<div><input type="text" value="" name="' + value.id + '" class="' + value.id + ' customfields" placeholder="' + value.name + '"></div>';
				if ( value.type == "select" ) {
					sspdiv += '<div><select name="' + value.id + '" class="' + value.id + ' customfields">';
					jQuery.each( value.name.split( "," ), function( rindex, rvalue ) {
						subelement = rvalue.split( ":" );
						if ( subelement[ 1 ] == undefined ) subelement[ 1 ] = "";
						sspdiv += '<option value="' + subelement[ 1 ] + '">' + subelement[ 0 ] + '</option>';
					});
					sspdiv += '</select></div>';
				}
				if ( value.type == "textarea" ) {
					sspdiv += '<div><textarea name="' + value.id + '" class="' + value.id + ' customfields" placeholder="' + value.name + '"></textarea></div>';
				}
				if ( value.type == "hidden" ) {
					sspdiv += '<div class="dnone"><input type="hidden" name="' + value.id + '" value="' + value.name + '" class="' + value.id + ' customfields"></div>';
				}
				if ( value.type == "radio" ) {
					sspdiv += '<div>';
					jQuery.each( value.name.split( "," ), function( rindex, rvalue ) {
						subelement = rvalue.split( ":" );
						uniquenumber = Math.floor((Math.random() * 10000) + 1);
						sspdiv += '<input type="radio" id="customfields-radio-' + value.id + '-' + uniquenumber + '" value="' + subelement[ 1 ] + '" name="' + value.id + '" class="' + value.id + ' customfields"><label for="customfields-radio-' + value.id + '-' + uniquenumber + '">' + subelement[ 0 ] + '</label>';
					});
					sspdiv += '</div>';
				}
				if ( value.type == "checkbox" ) {
					sspdiv2 += '<div class="custom-checkbox"><label><input type="checkbox" name="' + value.id + '" value="checked" class="' + value.id + ' customfields">' + value.name + '</label></div>';
				}

			});
		}
		if ( options.bottomtitle != '' ) {
			bt = '<p class="ssp-bottom">' + options.bottomtitle + '</p>';
		}
		if ( options.facebook_appid != '' ) {
			sociallogin += '<div class="ssp_fblogin"><fb:login-button scope="email" data-show-faces="false" data-width="200" data-max-rows="1" data-auto-logout-link="false">Sign in with Facebook</fb:login-button></div>';
		}
		if ( options.googleplus_clientid != '' && options.googleplus_apikey != '' ) {
			sociallogin += '<div class="ssp_gplogin"><div class="gSignInWrapper"><div class="googleplusbtn" class="customGPlusSignIn"><span class="icon"></span><span class="buttonText"></span></div></div></div>';
		}
		sociallogin += '</div>';
		sspdiv += '<div class="ssp-email-row"><input type="email" value="" name="ssp_email" class="ssp_email mce-EMAIL" placeholder="' + options.placeholder_text + '">' + sspdiv2 + '<input type="submit" value="' + options.subscribe_text + '" name="subscribe" class="subscribe button"></div></div>' + sociallogin + bt + '</div><div class="clear mce-responses"><div class="response mce-error-response" style="display:none"></div><div class="response mce-success-response" style="display:none"></div></div><div style="position: absolute; left: -5000px;"><input type="text" name="b_59e5bbfbcc749fdb8fe68637a_b9c0fde42d" value=""><img width="1" height="1" title="" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAATSURBVHjaYvj//z8DAAAA//8DAAj8Av7TpXVhAAAAAElFTkSuQmCC" /></div></div></form></div>' + closebutton + '</div>';
		jQuery( "body" ).prepend( locker );
		element.html( sspdiv );
		if ( jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).length > 0 && options.yaplay != '' ) {
			jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "src", jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "src" ).replace( "autoplay=1", "autoplay=0" ) );
		}
		if ( options.embed == "" ) {
			element.prependTo( "body" );
		}
		if ( options.ypos == 4 ) {
			/* YouTube BG Start */
			jQuery( simplesignuppro + ' .ssfproacenter' ).prependTo( simplesignuppro + ' .mc_embed_signup' );
			jQuery( simplesignuppro + ' .mc_embed_signup form' ).css({
				"height": parseInt( jQuery( simplesignuppro + ' .ssfproacenter iframe').attr("height"))-11+"px", "display": "table-cell", "vertical-align" :"bottom"
			});
			jQuery( simplesignuppro + ' .mc_embed_signup_inner').css({
				"height": parseInt( jQuery( ".ssfproacenter iframe" ).attr( "height" ) )+"px", "display":"table"
			});
			jQuery( simplesignuppro + ' .ssfproacenter' ).css({
					"position":"absolute", "width":"100%", "height":"100%", "left":"0px", "top":"0px", "border-radius": options.borderradius, "overflow":"hidden", "zIndex":1
			});
			jQuery( simplesignuppro + ' .inside-form' ).css({
				"position":"relative", "zIndex":2
			});
			jQuery( simplesignuppro + ' .ssfproacenter iframe' ).css({
				"width":"100%", "height":"100%"
			});
			if ( jQuery( simplesignuppro + ' .ssfproacenter iframe' ).length != 0 ) {
				options.bgcolor = "transparent";
			}
			if ( options.yaplay == "1" ) {
				jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).onload = function() {
					open_popup();
				};
			}
			aspectratio = jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "height" ) / jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).attr( "width" );
			element.css( "width", element.height() / aspectratio );
			jQuery( simplesignuppro + ' .mc_embed_signup .ssfproacenter iframe' ).removeAttr('width');
			/* YouTube BG End */
		}
			jQuery( simplesignuppro + ' .ssfproacenter img' ).css( "max-width", jQuery( simplesignuppro + ' .ssfproacenter' ).width() + "px" );
		if ( options.width != "" ) {
			element.css({
					"width":options.width
			});				
		}
		/* Embed Extension */
		if ( options.embed != "" ) {
			element.css({"position": "static", "opacity": "1", "margin": "0 auto"});
			element.wrap("<p></p>")
			if ( options.width != "" ) {
				element.css({"width": options.width});
			}
				jQuery( simplesignuppro + ' .subscribe' ).css({"marginTop": options.customfieldsmargin});
			if ( element.width() <= 600 ) {
				element.addClass( "ssp-small" );
			}
			options.position = "";
			options.elemanimation = "";
			options.animation = "";
			options.timer = 0;
			options.animtime = 0;
			options.lock = "";
			jQuery( simplesignuppro + ' .mc_embed_signup_inner' ).css({"-webkit-box-shadow": "none","-moz-box-shadow": "none","box-shadow": "none"});
			if ( options.visible == "" ) {
				element.hide();
			}
		}
		images = jQuery( simplesignuppro + ' img');
		images.load( function() {
			loaded_images_count++;
			if ( loaded_images_count == images.length ) {
				jQuery( simplesignuppro + ' .customfields').css({
					'marginBottom': options.customfieldsmargin,
					'border-radius': options.inputborderradius,
					"fontSize": options.contentfontsize
				});
				jQuery( simplesignuppro + ' .mc_embed_signup .mc_embed_signup_inner').css({
					"background": options.bgcolor,
					"border-radius": options.borderradius
				});
				jQuery( simplesignuppro + ' .mc_embed_signup form h2').css({
					"color": options.color,
					"fontSize": options.fontsize,
					"font-weight": options.fontweight
				});
				jQuery( simplesignuppro + ' .inside-form>p, ' + simplesignuppro + ' .ssp_email, ' + simplesignuppro + ' .customfields').css({
					"fontSize": options.contentfontsize,
					"color": options.contentcolor,
					"font-weight": options.contentweight
				});
				jQuery( simplesignuppro + ' .ssp_email').css({
					"fontSize": options.contentfontsize
				});
				jQuery( simplesignuppro + ' .ssp-bottom').css({
					"color":options.contentcolor
				});
				jQuery( simplesignuppro + ' .mc_embed_signup .ssp_email, .customfields').css({
					"border-top-left-radius": options.inputborderradius,
					"border-bottom-left-radius": options.inputborderradius
				});
				jQuery( simplesignuppro + ' .mc_embed_signup .subscribe').css({
					"border-top-right-radius": options.inputborderradius,
					"border-bottom-right-radius": options.inputborderradius,
					"background": options.buttonbgcolor,
					"color": options.buttoncolor
				});
				if ( options.lock != "" ) {
					jQuery( "#ssp_locker" ).css( "background-color", options.lockbgcolor );
				}
				jQuery( simplesignuppro + ' .mc_embed_signup .mc_embed_close').css({
					"color": options.closecolor,
					"fontSize": options.closefontsize
				});
				//initialize font families
				if ( options.fontfamily != '' && options.fontfamily != "undefined" ) {
					if ( jQuery( simplesignuppro + ' .mc_embed_signup form h2' ).length != 0 ) {
						jQuery(simplesignuppro + ' .mc_embed_signup form h2' ).css( "fontFamily","'" + options.fontfamily + "', serif" );
					}
				}
				if ( options.contentfontfamily != '' && options.contentfontfamily != "undefined" ) {
					if ( jQuery(simplesignuppro + ' .mc_embed_signup form').length != 0 ) {
						$( "<style type='text/css'> " + simplesignuppro + " .mc_embed_signup form input::-webkit-input-placeholder," + simplesignuppro + " .mc_embed_signup form textarea::-webkit-input-placeholder {\nfont-family: '" + options.contentfontfamily + "', Arial, Helvetica, sans-serif;\n}\n" + simplesignuppro + " .mc_embed_signup form input:-ms-input-placeholder," + simplesignuppro + " .mc_embed_signup form textarea:-ms-input-placeholder {\nfont-family: '" + options.contentfontfamily + "', Arial, Helvetica, sans-serif;\n}\n" + simplesignuppro + " .mc_embed_signup form input::-moz-input-placeholder," + simplesignuppro + " .mc_embed_signup form textarea::-moz-input-placeholder {\nfont-family: '" + options.contentfontfamily + "', Arial, Helvetica, sans-serif;\n}\n" + simplesignuppro + " .mc_embed_signup form input:-moz-input-placeholder," + simplesignuppro + " .mc_embed_signup form textarea:-moz-input-placeholder {\nfont-family: '" + options.contentfontfamily + "', Arial, Helvetica, sans-serif;\n}\n</style>" ).appendTo( "head" );
						jQuery(simplesignuppro + ' .mc_embed_signup form p,' + simplesignuppro + ' .mc_embed_signup form input,' + simplesignuppro + ' .mc_embed_signup form textarea,' + simplesignuppro + ' .mc_embed_signup form select,' + simplesignuppro + ' .mc_embed_signup form label').css( "fontFamily", "'" + options.contentfontfamily + "', serif" );
					}
				}
				if ( options.position == "lefttop" ) {
					side="left";
					leftstart = "-100%";
					leftend = options.hspace.replace( "px", "" ) + "px";
					topstart = "-100%";
					topend = options.vspace.replace( "px", "" ) + "px"
				}
				else if ( options.position == "leftcenter" ) {
					side = "left";
					leftstart = "-100%";
					leftend = options.hspace.replace( "px", "" ) + "px";
					topstart = parseInt( ( jQuery( window ).height() - element.height() ) / 2 ) + "px";
					topend = parseInt( ( jQuery( window ).height() - element.height() ) / 2 ) + "px"
				}
				else if ( options.position == "leftbottom" ) {
					side = "left";
					leftstart = "-100%";
					leftend = options.hspace.replace( "px", "" ) + "px";
					topstart = parseInt( ( jQuery( window ).height() - element.height() ) - options.vspace.replace( "px", "" ) ) + "px";
					topend = parseInt( ( jQuery( window ).height() - element.height() ) - options.vspace.replace( "px", "" ) ) + "px";
				}
				else if ( options.position == "centertop" ) {
					side = "left";
					leftstart = parseInt( ( jQuery( window ).width() - element.width() ) / 2 ) + "px";
					leftend = parseInt( ( jQuery( window ).width() - element.width() ) / 2 ) + "px";
					topstart = "-100%";
					topend = options.vspace.replace( "px", "" ) + "px";
				}
				else if ( options.position == "centercenter" ) {
					side = "left";
					leftstart = parseInt( ( jQuery( window ).width() - element.width() ) / 2 ) + "px";
					leftend = parseInt( ( jQuery( window ).width() - element.width() ) / 2 ) + "px";
					topstart = "-100%";
					topend = parseInt( ( jQuery( window ).height() - element.height() ) / 2 ) + "px";
				}
				else if ( options.position == "centerbottom" ) {
					side = "left";
					leftstart = "-100%";
					leftend = parseInt( ( jQuery( window ).width() - element.width() ) / 2 ) + "px";
					topstart = parseInt( ( jQuery( window ).height() - element.height() ) - options.vspace.replace( "px", "" ) ) + "px";
					topend = parseInt( ( jQuery( window ).height() - element.height() ) - options.vspace.replace( "px", "" ) ) + "px";
				}
				else if ( options.position == "righttop" ) {
					side = "right";
					leftstart = "-" + element.width() + "px";
					leftend = options.hspace.replace( "px", "" ) + "px";
					topstart = "-100%";
					topend = options.vspace.replace( "px", "" ) + "px";
				}
				else if ( options.position == "rightcenter" ) {
					side = "right";
					leftstart = "-" + element.width() + "px";
					leftend = options.hspace.replace( "px", "" ) + "px";
					topstart = parseInt( ( jQuery( window ).height() - element.height() ) / 2 ) + "px";
					topend = parseInt( ( jQuery( window ).height() - element.height() ) / 2 ) + "px";
				}
				else if ( options.position == "rightbottom" ) {
					side = "right";
					leftstart = "-" + element.width() + "px";
					leftend = options.hspace.replace( "px", "" ) + "px";
					topstart = parseInt( jQuery( window ).height() - element.height() - options.vspace.replace( "px", "" ) ) + "px";
					topend = parseInt( jQuery( window ).height() - element.height() - options.vspace.replace( "px", "" ) ) + "px";
				}
				set_elem_animations();
				set_anim_time( options.animtime, options.timer );
				if ( options.embed == "" ) {
					jQuery( simplesignuppro ).css("opacity", "0");
				}
				if ( options.animation.indexOf( 'slide' ) >= 0 ) {
					if ( side == "left" ) {
						jQuery( simplesignuppro ).css( "left", leftstart );
					}
					if ( side == "right" ) {
						jQuery( simplesignuppro ).css( "right", leftstart );
					}
						jQuery( simplesignuppro ).css( "top", topstart );
				}
				else {
					if ( side == "left" ) {
						jQuery( simplesignuppro ).css( "left", leftend );
					}
					if ( side == "right" ) {
						jQuery( simplesignuppro ).css( "right", leftend );
					}
						jQuery( simplesignuppro ).css( "top", topend );
				}
				if ( jQuery( window ).width() < 800 ) {
					element.css({ "width": "100%" });
					jQuery(simplesignuppro + ' .signup input').css({ "width":"100%" });
					leftend = "0px";
					topend = parseInt( jQuery( window ).height() - element.height() ) + "px";
				}
				if ( options.autoopen != "" ) {
					if ( ( options.once_per_user == "" ) || ( options.once_per_user != "" && getCookie( "ssp" ) != '1' ) )	{
						if ( ( ( options.once_per_filled == "" ) || ( options.once_per_filled != "" && getCookie( "ssp_filled" ) != '1' ) ) && once_opened == false ) {
							open_popup();
						}
					}
				}
				if ( options.cdatas1 !== 'undefined' && options.cdatas1 !== '' ) {
					setCookie( 'ssp_form', options.cdatas1, options.cookie_days, 'days' );
				}
				if ( options.openwithlink != "" ) {
					jQuery( document ).on( "click", ".opensspopup-" + options.formid, function( event ) {
						event.preventDefault();
							set_anim_time( options.animtime, 0 );
							options.timer = 0;
							open_popup();
					})
				}
					jQuery( window ).scroll( function() {
						if ( options.embed != "" && element.parent().visible() && closed == false && options.visible == "" ) {
							setTimeout( function() {
								element.slideDown( 800 );
							}, 500);
						}
						if ( options.openbottom != "" ) {
							var st = jQuery( document ).scrollTop();
							if ( options.openbottom != "" ) {
								openpos = 10;
							}
							else {
								openpos = parseInt( 100 - options.openbottom );
							}
							if ( jQuery( window ).scrollTop() + jQuery( window ).height() > jQuery( document ).height() - ( ( jQuery( document ).height() / 100) * openpos ) && st > lastScrollTop && opened == false ) {
								if ( once_opened != true ) {
									if ( ( options.once_per_user == "" ) || ( options.once_per_user != "" && getCookie( "ssp" ) != '1' ) ) {
										opened = true;
										set_anim_time( options.animtime, 0 );
										options.timer = 0;
										open_popup();
									}
								}
							}
							lastScrollTop = st;
						}
					})
				
				if ( options.hideclose == "" ) {
					if( options.closewithlayer != "" ) {
						jQuery( simplesignuppro + ' .mc_embed_close, #ssp_locker' ).click( function() {
							close_popup();
							opened = false;
						})
					}
					else {
						jQuery( simplesignuppro + ' .mc_embed_close' ).click( function() {
							close_popup();
							opened = false;
						})			
					}
				}

				jQuery( simplesignuppro + ' .mc-embedded-subscribe-form' ).submit( function( event ) {
					event.preventDefault();
					return false;
				});

				jQuery( simplesignuppro + ' .ssp_email' ).keydown( function ( event ) {
					if( event.keyCode == 13 ) {
						event.preventDefault();
						jQuery( simplesignuppro + ' .subscribe' ).trigger( "click" );
						return false;
					}
				});
			
			/*						Send Subscription with Ajax			*/
				jQuery( simplesignuppro + ' .subscribe' ).click( function() {
					if ( blocker == 0 && options.preview == "" ) {
						jQuery( simplesignuppro + ' .subscribe' ).css({
							"opacity": "0.2",
							"cursor": "normal"
						});
						blocker = 1;
						if ( isValidEmailAddress( jQuery( simplesignuppro + ' .ssp_email' ).val() ) ) {
							data = {
							action: 'ajax_ssp',
							sspcmd: 'subscription_signup',
							email: jQuery( simplesignuppro + ' .ssp_email' ).val(),
							mode: options.mode,
							double_optin: options.double_optin,
							update_existing: options.update_existing,
							replace_interests: options.replace_interests,
							mailchimp_listid: options.mailchimp_listid,
							send_welcome: options.send_welcome,
							signup_form_id: options.formid
							};
							if ( options.customfields != '' ) {
								customfieldsarray = [];
								jQuery.each( options.customfields, function( index, value ) {
									fieldname = value.id;
									thisdata = new Object;
									if ( value.type == undefined ) value.type = "text";
									if ( value.type == "radio" || value.type == "select" ) {
										value.minlength = 0;
									}
									if ( value.type == "radio" ) {
										warningclass = "warning-icon2";
									}
									else {
										warningclass = "warning-icon";										
									}
									if ( ( value.required == true || value.required == "true" ) && ( ( jQuery( simplesignuppro + " ." + value.id ).val() == '' || jQuery( "." + value.id ).val().length < value.minlength ) || ( value.type == 'radio' && jQuery( simplesignuppro + " ." + value.id + ":checked" ).val() == undefined ) || ( value.type == 'checkbox' && jQuery( simplesignuppro + " ." + value.id ).is(':checked') == false ) ) ) {
										thisval = jQuery( simplesignuppro + ' .' + value.id ).val();
										jQuery( simplesignuppro + ' .' + value.id ).css( "color", "#FC0303" );
										jQuery( simplesignuppro + ' .' + value.id ).parent().addClass( warningclass );
										if ( value.type == "text" || value.type == "textarea" ) {
											jQuery( simplesignuppro + ' .' + value.id ).val( value.warning );
										}
										setTimeout( function() {
											jQuery( simplesignuppro + ' .' + value.id).css( "color", "" );
											if ( value.type == "text" || value.type == "textarea" ) {
												jQuery( simplesignuppro + ' .' + value.id ).val( thisval );
											}
											jQuery( simplesignuppro + ' .' + value.id ).parent().removeClass( warningclass );
											jQuery( simplesignuppro + ' .subscribe').css({
												"opacity": "1",
												"cursor": "pointer"
											});
											blocker = 0;
										}, 2000);
										error = 1;
										return false;
									}
									else {
										if ( value.type == "radio" ) {
											thisdata[ fieldname ] = jQuery( simplesignuppro + ' .' + value.id + ':checked' ).val();
										}
										else {
											thisdata[ fieldname ] = jQuery( simplesignuppro + ' .' + value.id ).val();
										}
										if ( thisdata[ fieldname ] == "undefined" ) {
											thisdata[ fieldname ] = "empty";
										}
										customdatas = jQuery.extend( {}, customdatas, thisdata); 
										customfieldsarray.push( value.id );
										error = 0;
									}
								});
							}
							if ( error == 0 ) {
								customdatas[ 'customfieldsarray' ] = customfieldsarray;
								data = jQuery.extend( {}, data, customdatas );
								jQuery.post( options.path, data, function( response ) {
									if ( response.toLowerCase().indexOf( "success" ) >= 0 ) {
										jQuery( simplesignuppro + ' .signup').html( options.signup_success );
										window.setTimeout( function() {
											close_popup();
											opened = false;
											if ( options.redirecturl != "" ) {
												if ( isUrlValid( options.redirecturl ) ) {
													window.location.href = options.redirecturl;
												}
											}
										}, 2000 );
										blocker = 0;
										jQuery( simplesignuppro + ' .subscribe').css({
											"opacity": "1",
											"cursor": "pointer"
										});
										if ( options.once_per_filled != "" ) {
											setCookie( 'ssp_filled', '1', options.filled_cookie_days, 'days' );
										}
										if ( options.cdatas2 !== 'undefined' && options.cdatas2 !== '' ) {
											setCookie( 'ssp_form', options.cdatas2, options.cookie_days, 'days' );
										}
										jQuery( simplesignuppro + ' .ssp_social_login' ).remove();
									}
									else {
										jQuery( simplesignuppro + ' .ssp_email' ).parent().addClass( warningclass );
										cmail = jQuery( simplesignuppro + ' .ssp_email' ).val();
										jQuery( simplesignuppro + ' .ssp_email' ).css( "color", "#FC0303" );
										jQuery( simplesignuppro + ' .ssp_email' ).val( response );
										setTimeout( function() {
											jQuery( simplesignuppro + ' .ssp_email' ).parent().removeClass( warningclass );
											jQuery( simplesignuppro + ' .ssp_email' ).css( "color", "" );
											jQuery( simplesignuppro + ' .ssp_email').val( cmail );
										}, 2000 );
										blocker = 0;
										jQuery( simplesignuppro + ' .subscribe').css({
											"opacity": "1",
											"cursor": "pointer"
										});
									}
								});
							}
						}
						else {
							warningclass = "warning-icon";										
							cmail = jQuery( simplesignuppro + ' .ssp_email' ).val();
							jQuery( simplesignuppro + ' .ssp_email' ).css( "color", "#FC0303" );
							jQuery( simplesignuppro + ' .ssp_email' ).val( options.invalid_address );
							jQuery( simplesignuppro + ' .ssp_email' ).parent().addClass( warningclass );
							setTimeout( function() {
								jQuery( simplesignuppro + ' .ssp_email' ).parent().removeClass( warningclass );
								jQuery( simplesignuppro + ' .ssp_email' ).css( "color", "" );
								jQuery( simplesignuppro + ' .ssp_email' ).val( cmail );
								jQuery( simplesignuppro + ' .subscribe' ).css({
									"opacity": "1",
									"cursor": "pointer"
								});
								blocker = 0;
							}, 2000 );
						}
					}
				});
			}
		});
		}
	});
 $.fn[pluginName] = function ( options ) {
        var args = arguments;
        if (options === undefined || typeof options === 'object') {
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName)) {
                    $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
                }
            });
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            var returns;

            this.each(function () {
                var instance = $.data(this, 'plugin_' + pluginName);
                if (instance instanceof Plugin && typeof instance[options] === 'function') {
                    returns = instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
                }
                if (options === 'destroy') {
                  $.data(this, 'plugin_' + pluginName, null);
                }
            });
            return returns !== undefined ? returns : this;
        }
    };
})( jQuery, window, document );
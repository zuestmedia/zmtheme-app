/*! ZMTheme.js | ZMTheme.com 2021 !*/

jQuery(document).ready(function($) {

	zmRotateNavToggle($);

	zmIconsMenu($);

	zmNoFullAlignClasstoBody($);

  zmtAjaxPostsLoader($);

});

/**
	* add sidebar class to body
	* used to block alignwide & alignfull style in sidebar layouts
	*/
	function zmNoFullAlignClasstoBody($){

		if ($('.zm-no-full-align')[0]){

			$('body').addClass('no-align-widenfull');

		}

	}

/**
	* rotating offcanvas_toggle
	*/
	function zmRotateNavToggle($){

		if ($('.zmrotate-45')[0]){

			$('.zmrotate-45').click(function(){

				//only if has rotated, rotate back!
					if(!$(this).hasClass('zmrotated-45')){

						$(this).toggleClass('zmrotated-45');

					}

			});

			$('.zmrotate-45').each(function(){
				zmRotateNavToggleBack($, $(this) );//to rotate each back when closed
			});

		}

	}
	//needs to turn back if modal or offcanvas sidebar is closes otherwise!
	//can use zmtargetid see confignavtoggle default
	function zmRotateNavToggleBack($,obj){

		var targetid = obj.parent().attr("zmtargetid");

		UIkit.util.on( targetid, 'hidden', function () {

			obj.removeClass('zmrotated-45');

		});

	}

/**
	* transform social media links to icons
	*
	* !!!!!!!!!!!!! uk-navbar-nav has to change to zmiconsmenu! !!!!!!!!!!
	* ---> add to a href target="_blank" und rel="nofollow"
	* ---> add title or tooltip!!!
	*
	*/
	function zmIconsMenu($){

		//if ($(".zmiconsmenu")[0]){
		if ($(".zmsocialicons")[0]){

			var classes = $(".zmsocialicons")[0].className;
			var ratio = "1";

			classratio = zmGetClassStartsWith(classes,'zmratio-',$);
			if(classratio !== false){
				ratio = classratio.split("-").pop();
			}

			$('.zmsocialicons').children().each(function() {

				zmSocialIcons( $(this), ratio );

			});

		}

	}

	function zmGetClassStartsWith(classes,string,$){
		var r=$.grep(classes.split(" "),function(classes,r){
			return 0===classes.indexOf(string);
		}).join();
		return r||!1;
	}

	function zmSocialIcons(obj, ratio){

		var childrenhrefs = obj.children('a').attr("href");

		if(childrenhrefs.indexOf('facebook.com') >= 0){
			zmSocialIcon(obj,'facebook',ratio);
		} else if(childrenhrefs.indexOf('twitter.com') >= 0){
			zmSocialIcon(obj,'twitter',ratio);
		} else if(childrenhrefs.indexOf('instagram.com') >= 0){
			zmSocialIcon(obj,'instagram',ratio);
		} else if(childrenhrefs.indexOf('wordpress.org') >= 0){
			zmSocialIcon(obj,'wordpress',ratio);
		} else if(childrenhrefs.indexOf('xing.com') >= 0){
			zmSocialIcon(obj,'xing',ratio);
		} else if(childrenhrefs.indexOf('linkedin.com') >= 0){
			zmSocialIcon(obj,'linkedin',ratio);
		} else if(childrenhrefs.indexOf('github.com') >= 0){
			zmSocialIcon(obj,'github',ratio);
		} else {
			zmSocialIcon(obj,'link',ratio);
		}

	}

	function zmSocialIcon(obj,iconclass,ratio){

		//console.log('there is a ' + iconclass + ' menulink to change: uk-icon="icon:' + iconclass + ';"');
		obj.children('a').text('');
		obj.children('a').append('<i uk-icon="icon:' + iconclass + ';ratio:' + ratio + ';"></i>');

	}

	function zmtAjaxPostsLoader($){

    $('.zmt-ajax-posts-load-container').show();

		$(document.body).on('click', '.zmt-ajax-posts-load-button', function(event) {    
			
			event.preventDefault();
      
      $(this).closest('.zmt-ajax-posts-load-container').find('.zmt-ajax-posts-load-button').hide();
      $(this).closest('.zmt-ajax-posts-load-container').find('.zmt-ajax-posts-loading-button').show();
	
			var query_data = {
				query: JSON.stringify($(this).closest('.zmt-ajax-posts-load-container').data('zmt-query')),//important to stringify data, so array datatypes are kept... and clean
				maxpages: $(this).closest('.zmt-ajax-posts-load-container').data('zmt-maxpages'),
				current: $(this).closest('.zmt-ajax-posts-load-container').data('zmt-current'),
				comid: $(this).closest('.zmt-ajax-posts-load-container').data('zmt-comid'),
			}
	
			var ajaxdata = {
				action: 'zmt_ajax_posts_loader',
				query_data: query_data,
				security: zmt_global_vars.ajaxnonce,
			};   
	
			$.ajax({
				url: zmt_global_vars.ajaxurl,
				type: 'POST',
				data: ajaxdata,
				success: function (response) {
						
					if(response.success == true){   

            //makes fade effect wo replaced container
            $('.' + response.data.comid+'-ajax-button-container').replaceWith(function() {
              return $(response.data.html).hide().fadeIn();
            });

            //display container with button
            $('.zmt-ajax-posts-load-container').show(600);

            $('html, body').animate({
              scrollTop: $('#' + response.data.next_post_id ).offset().top
            }, 800);
						
					}
	
				}

			});
	
		});
	
	}
